<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

/**
 * Represents terrain types.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#terraintypes Documentation
 */
class TerrainCollection
{
    /**
     * @var Terrain[]
     *
     * @see TerrainCollection::getTerrains()
     * @see TerrainCollection::addTerrain()
     * @see TerrainCollection::removeTerrain()
     */
    private array $terrains = [];

    /**
     * @return Terrain[]
     */
    public function getTerrains(): array
    {
        return $this->terrains;
    }

    public function addTerrain(Terrain $terrain): TerrainCollection
    {
        $this->terrains[] = $terrain;

        return $this;
    }

    public function removeTerrain(Terrain $terrain): TerrainCollection
    {
        if (in_array($terrain, $this->terrains)) {
            $this->terrains = array_diff($this->terrains, [$terrain]);
        }

        return $this;
    }
}
