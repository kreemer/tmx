<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

use Intervention\Image\Image as InterventionImage;
use Intervention\Image\ImageManager;

class Printer
{
    private ImageManager $manager;

    /**
     * Printer constructor.
     */
    public function __construct()
    {
        $this->manager = new ImageManager(['driver' => 'imagick']);
    }

    public function render(Map $map): InterventionImage
    {
        if (0 == $map->getWidth() || 0 == $map->getHeight()) {
            return $this->manager->canvas(1, 1, null);
        }

        $widthPixel = $map->getWidth() * $map->getTileWidth();
        $heightPixel = $map->getHeight() * $map->getTileHeight();

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

        foreach ($map->getLayers() as $layer) {
            if (!$layer->isVisible()) {
                continue;
            }
            $layerData = $layer->getLayerData();
            $dataMap = $layerData->getDataMap();

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
                        $tileSource->opacity(intval($layer->getOpacity() * 100));
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

    public function print(Map $map, string $filename): void
    {
        $img = $this->render($map);
        /** @var \Imagick $imagick */
        $imagick = $img->getCore();
        $imagick->setImageDepth(32);
        $imagick->setImageFormat('PNG32');
        @file_put_contents($filename, $imagick->getImageBlob());
    }
}
