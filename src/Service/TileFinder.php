<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Service;

use Tmx\Property\StringProperty;
use Tmx\TileSet;

/**
 * Service class to find {@see Tile} objects inside {@see TileSet}.
 */
class TileFinder
{
    /**
     * Find tiles by string property by name and value.
     *
     * @param TileSet $tileSet  The TileSet to search
     * @param array   $criteria An associative array to search tiles.
     *                          The key is the property name, while the value is the string value.
     *
     * @return array an array of found tiles
     */
    public static function findTileByProperty(TileSet $tileSet, array $criteria): array
    {
        $tiles = [];

        $keys = array_keys($criteria);
        foreach ($tileSet->getTiles() as $tile) {
            $check = false;
            if (null === $tile->getPropertyBag()) {
                continue;
            }
            foreach ($tile->getPropertyBag()->getProperties() as $property) {
                if ($check) {
                    continue;
                }
                $check = $property instanceof StringProperty &&
                    false !== in_array($property->getName(), $keys) &&
                    $property->getValue() === $criteria[$property->getName()];
            }
            if ($check) {
                $tiles[] = $tile;
            }
        }

        return $tiles;
    }
}
