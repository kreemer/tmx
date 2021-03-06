<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Service;

use Tmx\GroupContainer;
use Tmx\Map;

/**
 * Service class for maps.
 *
 * This Service class provides different methods to process map objects
 *
 * @see Map
 */
class MapService
{
    /**
     * Find all layers within the container as ordered array.
     *
     * @param GroupContainer $container Container which can hold a layer
     *
     * @return array Ordered array of layers
     */
    public static function findLayers(GroupContainer $container): array
    {
        $layers = [];
        foreach ($container->getLayers() as $layer) {
            $layers[$layer->getOrder()] = $layer;
        }

        foreach ($container->getGroups() as $group) {
            $layers = array_merge($layers, self::findLayers($group));
        }

        return $layers;
    }

    /**
     * calculate the total height of a map in tiles.
     */
    public static function getCalculatedHeight(Map $instance): ?int
    {
        if ($instance->isInfiniteMap()) {
            $min = $max = null;
            foreach (self::findLayers($instance) as $layer) {
                foreach ($layer->getLayerData()->getChunks() as $chunk) {
                    $min = $chunk->getY() < $min || null === $min ? $chunk->getY() : $min;
                    $max = $chunk->getY() + $chunk->getHeight() > $max || null === $max ? $chunk->getY() + $chunk->getHeight() : $max;
                }
            }

            return $max - $min;
        }

        return $instance->getHeight();
    }

    /**
     * Calculate the width of a map in tiles.
     */
    public static function getCalculatedWidth(Map $instance): ?int
    {
        if ($instance->isInfiniteMap()) {
            $min = $max = null;
            foreach (self::findLayers($instance) as $layer) {
                foreach ($layer->getLayerData()->getChunks() as $chunk) {
                    $min = $chunk->getX() < $min || null === $min ? $chunk->getX() : $min;
                    $max = $chunk->getX() + $chunk->getWidth() > $max || null === $max ? $chunk->getX() + $chunk->getWidth() : $max;
                }
            }

            return $max - $min;
        }

        return $instance->getWidth();
    }

    /**
     * get the offset x of an infinite map.
     */
    public static function getInfiniteMapOffsetX(Map $instance): ?int
    {
        if ($instance->isInfiniteMap()) {
            $min = null;
            foreach (self::findLayers($instance) as $layer) {
                foreach ($layer->getLayerData()->getChunks() as $chunk) {
                    $min = $chunk->getX() < $min || null === $min ? $chunk->getX() : $min;
                }
            }

            return abs($min);
        }

        return 0;
    }

    /**
     * get the total offset y of an infinite map.
     */
    public static function getInfiniteMapOffsetY(Map $instance): ?int
    {
        if ($instance->isInfiniteMap()) {
            $min = null;
            foreach (self::findLayers($instance) as $layer) {
                foreach ($layer->getLayerData()->getChunks() as $chunk) {
                    $min = $chunk->getY() < $min || null === $min ? $chunk->getY() : $min;
                }
            }

            return abs($min);
        }

        return 0;
    }

    /**
     * Get the largest offset x of an map from all layers.
     */
    public static function getMapOffsetX(Map $instance): int
    {
        $maxPixel = 0;
        foreach ($instance->getLayers() as $layer) {
            $maxPixel = $maxPixel < $layer->getOffsetX() ? $layer->getOffsetX() : $maxPixel;
        }

        foreach ($instance->getImageLayers() as $layer) {
            $maxPixel = $maxPixel < $layer->getOffsetX() ? $layer->getOffsetX() : $maxPixel;
        }

        return (int) round($maxPixel);
    }

    /**
     * Get the largest offset y of an map from all layers.
     */
    public static function getMapOffsetY(Map $instance): int
    {
        $maxPixel = 0;
        foreach ($instance->getLayers() as $layer) {
            $maxPixel = $maxPixel < $layer->getOffsetY() ? $layer->getOffsetY() : $maxPixel;
        }

        foreach ($instance->getImageLayers() as $layer) {
            $maxPixel = $maxPixel < $layer->getOffsetY() ? $layer->getOffsetY() : $maxPixel;
        }

        return (int) round($maxPixel);
    }
}
