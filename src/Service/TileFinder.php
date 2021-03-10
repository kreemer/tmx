<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Service;


use Tmx\Map;
use Tmx\Property\AbstractProperty;
use Tmx\Property\StringProperty;
use Tmx\Tile;
use Tmx\TileSet;

class TileFinder
{

    public static function findTileByProperty(TileSet $tileSet, array $criteria): array
    {
        $tiles = [];

        $keys = array_keys($criteria);
        foreach ($tileSet->getTiles() as $tile) {
            $check = false;
            if ($tile->getPropertyBag() === null) {
                continue;
            }
            foreach ($tile->getPropertyBag()->getProperties() as $property) {
                if ($check) {
                    continue;
                }
                $check = $property instanceof StringProperty &&
                    in_array($property->getName(), $keys) !== false &&
                    $property->getValue() === $criteria[$property->getName()];
            }
            if ($check) {
                $tiles[] = $tile;
            }
        }

        return $tiles;
    }

}