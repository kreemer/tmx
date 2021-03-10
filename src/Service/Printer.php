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
use Tmx\ImageLayer;
use Tmx\Layer;
use Tmx\Map;
use Tmx\Service\Context\PrintContext;
use Tmx\Service\LayerData\Base64DataParser;
use Tmx\Service\LayerData\CsvDataParser;
use Tmx\Service\LayerData\PlainCompression;
use Tmx\Service\LayerData\ZlibCompression;
use Tmx\Service\LayerData\ZstdCompression;
use Tmx\TileLayer;
use Tmx\TileSet;

/**
 * Service class printer prints a map to an image file.
 *
 * The printer processes a map object and saves the map as image output.
 */
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
        $this->layerDataReader = LayerDataReader::getDefaultLayerDataReader();
    }

    /**
     * Process a map and save its output to an image file.
     */
    public function print(Map $map, string $filename): void
    {
        $img = $this->render($map);
        /** @var \Imagick $imagick */
        $imagick = $img->getCore();
        $imagick->setImageDepth(32);
        $imagick->setImageFormat('PNG32');
        @file_put_contents($filename, $imagick->getImageBlob());
    }

    /**
     * Processes a map object and returns the image as InterventionImage object.
     *
     * @see http://image.intervention.io Documentation
     */
    public function render(Map $map): InterventionImage
    {
        if (0 == $map->getWidth() || 0 == $map->getHeight()) {
            return $this->manager->canvas(1, 1, null);
        }

        $widthPixel = MapService::getCalculatedWidth($map) * $map->getTileWidth() + MapService::getMapOffsetX($map);
        $heightPixel = MapService::getCalculatedHeight($map) * $map->getTileHeight() + MapService::getMapOffsetX($map);

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
            /** @var TileLayer $layer */
            $layer = $layerRow['layer'];

            /** @var PrintContext $context */
            $context = $layerRow['context'];
            if (false === $context->isVisible()) {
                continue;
            }

            if ($layer instanceof Layer) {
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

                        if (null !== $context->getOpacity()) {
                            $tileSource->opacity(intval($context->getOpacity() * 100));
                        }

                        if (null !== $context->getTintColor()) {
                            $tileSource->colorize(
                                (hexdec(substr($context->getTintColor(), 1, 2)) / 255 * 200) - 100,
                                (hexdec(substr($context->getTintColor(), 3, 2)) / 255 * 200) - 100,
                                (hexdec(substr($context->getTintColor(), 5, 2)) / 255 * 200) - 100
                            );
                        }

                        $img->insert(
                            $tileSource, 'top-left', $keyTile * $map->getTileWidth() + $offsetX, $keyLine * $map->getTileHeight() + $offsetY
                        );

                        $tileSource->reset($id);
                    }
                }
            } elseif ($layer instanceof ImageLayer) {
                /** @var ImageLayer $layer */
                if (null === $layer->getImage()) {
                    continue;
                }
                $imageLayerImage = $this->manager->make($layer->getImage()->getSource());

                $img->insert(
                    $imageLayerImage,
                    'top-left',
                    (int) round($layer->getOffsetX()),
                    (int) round($layer->getOffsetY())
                );
            }
        }

        return $img;
    }

    private function extractLayersInOrder(GroupContainer $container, $context = null): array
    {
        $layers = [];
        if (null === $context) {
            $context = new PrintContext();
        }
        foreach ($container->getLayers() as $layer) {
            $currentContext = $this->initializeContext($context, $layer);
            $layers[$layer->getOrder()] =
                [
                    'layer' => $layer,
                    'context' => $currentContext,
                ];
        }

        foreach ($container->getImageLayers() as $imageLayer) {
            $currentContext = $this->initializeContext($context, $imageLayer);
            $layers[$imageLayer->getOrder()] =
                [
                    'layer' => $imageLayer,
                    'context' => $currentContext,
                ];
        }

        foreach ($container->getGroups() as $group) {
            $currentContext = clone $context;

            if (null === $currentContext->isVisible() && !$group->isVisible()) {
                $currentContext->setVisible($group->isVisible());
            }
            if (null === $currentContext->getOpacity() && 1.0 !== $group->getOpacity()) {
                $currentContext->setOpacity($group->getOpacity());
            }
            if (null === $currentContext->getTintColor() && '' !== $group->getTintColor() && null !== $group->getTintColor()) {
                $currentContext->setOpacity($group->getOpacity());
            }
            $layers = array_merge($layers, $this->extractLayersInOrder($group, $currentContext));
        }

        return $layers;
    }

    private function initializeContext(?PrintContext $context, TileLayer $layer): PrintContext
    {
        $currentContext = clone $context;
        if (null === $currentContext->isVisible()) {
            $currentContext->setVisible($layer->isVisible());
        }
        if (null === $currentContext->getOpacity()) {
            $currentContext->setOpacity($layer->getOpacity());
        }
        if (null === $currentContext->getTintColor()) {
            $currentContext->setTintColor($layer->getTintColor());
        }

        return $currentContext;
    }
}
