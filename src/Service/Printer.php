<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Service;

use Intervention\Image\Image as InterventionImage;
use Intervention\Image\ImageManager;
use Tmx\GroupContainer;
use Tmx\Map;
use Tmx\Service\LayerData\Base64DataParser;
use Tmx\Service\LayerData\CsvDataParser;
use Tmx\Service\LayerData\PlainCompression;
use Tmx\Service\LayerData\ZlibCompression;
use Tmx\Service\LayerData\ZstdCompression;
use Tmx\TileSet;

class Printer
{
    private ImageManager $manager;
    private LayerDataReader $layerDataReader;

    /**
     * Printer constructor.
     */
    public function __construct()
    {
        $this->manager = new ImageManager(['driver' => 'imagick']);
        $this->layerDataReader = new LayerDataReader(
            [new CsvDataParser(), new Base64DataParser()],
            [new PlainCompression(), new ZlibCompression(), new ZstdCompression()]
        );
    }

    public function print(Map $map, string $filename): void
    {
        $img = $this->render($map);
        /** @var \Imagick $imagick */
        $imagick = $img->getCore();
        $imagick->setImageDepth(32);
        $imagick->setImageFormat('PNG32');
        @file_put_contents($filename, $imagick->getImageBlob());
    }

    public function render(Map $map): InterventionImage
    {
        if (0 == $map->getWidth() || 0 == $map->getHeight()) {
            return $this->manager->canvas(1, 1, null);
        }

        $widthPixel = MapService::getCalculatedWidth($map) * $map->getTileWidth();
        $heightPixel = MapService::getCalculatedHeight($map) * $map->getTileHeight();

        $img = $this->manager->canvas($widthPixel, $heightPixel, $map->getBackgroundColor());

        $cacheArray = [];
        $tileSetImage = [];
        foreach ($map->getTileSets() as $tileSet) {
            if (0 != $tileSet->getImage()->getWidth() % $tileSet->getTileWidth()) {
                // ERROR
            }
            if (0 != $tileSet->getImage()->getHeight() % $tileSet->getTileHeight()) {
                // ERROR
            }

            $tileSetImage[$tileSet->getImage()->getSource()] = $this->manager->make($tileSet->getImage()->getSource());

            $index = $tileSet->getFirstGid();
            for ($i = 0; $i < ($tileSet->getImage()->getHeight() / $tileSet->getTileHeight()); ++$i) {
                for ($u = 0; $u < ($tileSet->getImage()->getWidth() / $tileSet->getTileWidth()); ++$u) {
                    if (isset($cacheArray[$index])) {
                        // Error
                        exit('test');
                    }
                    $cacheArray[$index] = [
                        'x' => $u * $tileSet->getTileWidth(),
                        'y' => $i * $tileSet->getTileHeight(),
                        'width' => $tileSet->getTileWidth(),
                        'height' => $tileSet->getTileHeight(),
                        'tileSet' => $tileSet,
                        'source' => $tileSet->getImage()->getSource(),
                    ];
                    ++$index;
                }
            }
        }

        $layerArray = $this->extractLayersInOrder($map);
        foreach ($layerArray as $layerRow) {
            $layer = $layerRow['layer'];
            if (!$layerRow['visible']) {
                continue;
            }
            $layerData = $layer->getLayerData();
            $dataMap = $this->layerDataReader->readLayerData($layerData);
            foreach ($dataMap as $keyLine => $line) {
                foreach ($line as $keyTile => $tile) {
                    if (!isset($cacheArray[$tile])) {
                        // ERROR
                        continue;
                    }
                    $tileSource = $tileSetImage[$cacheArray[$tile]['source']];
                    $id = uniqid();
                    $tileSource->backup($id);
                    $tileSource->crop(
                        $cacheArray[$tile]['width'],
                        $cacheArray[$tile]['height'],
                        $cacheArray[$tile]['x'],
                        $cacheArray[$tile]['y']
                    );

                    /** @var TileSet $tileSet */
                    $tileSet = $cacheArray[$tile]['tileSet'];
                    $offsetX = null !== $tileSet->getTileOffset() && null !== $tileSet->getTileOffset()->getX() ?
                        $tileSet->getTileOffset()->getX() :
                        0;
                    $offsetY = null !== $tileSet->getTileOffset() && null !== $tileSet->getTileOffset()->getY() ?
                        $tileSet->getTileOffset()->getY() :
                        0;

                    if (null !== $layer->getOpacity()) {
                        $tileSource->opacity(intval($layerRow['opacity'] * 100));
                    }

                    $img->insert(
                        $tileSource, 'top-left', $keyTile * $map->getTileWidth() + $offsetX, $keyLine * $map->getTileHeight() + $offsetY
                    );

                    $tileSource->reset($id);
                }
            }
        }

        return $img;
    }

    private function extractLayersInOrder(GroupContainer $container, $context = []): array
    {
        $layers = [];
        foreach ($container->getLayers() as $layer) {
            $layers[$layer->getOrder()] =
                [
                    'layer' => $layer,
                    'visible' => $context['visible'] ?? $layer->isVisible(),
                    'opacity' => $context['opacity'] ?? $layer->getOpacity(),
                ];
        }

        foreach ($container->getGroups() as $group) {
            $currentContext = $context;

            if (!isset($context['visible']) && !$group->isVisible()) {
                $currentContext['visible'] = $group->isVisible();
            }
            if (!isset($context['opacity']) && 1.0 !== $group->getOpacity()) {
                $currentContext['opacity'] = $group->getOpacity();
            }
            $layers = array_merge($layers, $this->extractLayersInOrder($group, $currentContext));
        }

        return $layers;
    }
}
