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
 * Represents terrains.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#terrain Documentation
 */
class Terrain implements PropertyBagHolder
{
    use PropertyBagTrait;

    /**
     * The name of the terrain type.
     *
     * @see Terrain::getName()
     * @see Terrain::setName()
     */
    private ?string $name = null;

    /**
     * The local tile-id of the tile that represents the terrain visually.
     *
     * @see Terrain::setTile()
     * @see Terrain::getTile()
     */
    private ?int $tile = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Terrain
    {
        $this->name = $name;

        return $this;
    }

    public function getTile(): ?int
    {
        return $this->tile;
    }

    public function setTile(?int $tile): Terrain
    {
        $this->tile = $tile;

        return $this;
    }
}
