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
 * Represents tiles in a tileSet.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#terrain Documentation
 */
class Tile implements PropertyBagHolder
{
    use PropertyBagTrait;

    /**
     * The local tile ID within its tile set.
     *
     * @see Tile::getId()
     * @see Tile::setId()
     */
    private ?int $id = null;

    /**
     * The type of the tile. Refers to an object type and is used by tile objects.
     *
     * @see Tile::getType()
     * @see Tile::setType()
     */
    private ?string $type = null;

    /**
     * Defines the terrain type of top left corner of the tile.
     *
     * @see Tile::getTopLeftTerrainId()
     * @see Tile::setTopLeftTerrainId()
     */
    private ?int $topLeftTerrainId = null;

    /**
     * Defines the terrain type of top right corner of the tile.
     *
     * @see Tile::getTopRightTerrainId()
     * @see Tile::setTopRightTerrainId()
     */
    private ?int $topRightTerrainId = null;

    /**
     * Defines the terrain type of bottom left corner of the tile.
     *
     * @see Tile::getBottomLeftTerrainId()
     * @see Tile::setBottomLeftTerrainId()
     */
    private ?int $bottomLeftTerrainId = null;

    /**
     * Defines the terrain type of bottom right corner of the tile.
     *
     * @see Tile::getBottomRightTerrainId()
     * @see Tile::setBottomRightTerrainId()
     */
    private ?int $bottomRightTerrainId = null;

    /**
     * A percentage indicating the probability that this tile is chosen when it competes
     * with others while editing with the terrain tool.
     *
     * @see Tile::getProbability()
     * @see Tile::setProbability()
     */
    private float $probability = 1.0;

    private ?Animation $animation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Tile
    {
        $this->id = $id;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): Tile
    {
        $this->type = $type;

        return $this;
    }

    public function getTopLeftTerrainId(): ?int
    {
        return $this->topLeftTerrainId;
    }

    public function setTopLeftTerrainId(?int $topLeftTerrainId): Tile
    {
        $this->topLeftTerrainId = $topLeftTerrainId;

        return $this;
    }

    public function getTopRightTerrainId(): ?int
    {
        return $this->topRightTerrainId;
    }

    public function setTopRightTerrainId(?int $topRightTerrainId): Tile
    {
        $this->topRightTerrainId = $topRightTerrainId;

        return $this;
    }

    public function getBottomLeftTerrainId(): ?int
    {
        return $this->bottomLeftTerrainId;
    }

    public function setBottomLeftTerrainId(?int $bottomLeftTerrainId): Tile
    {
        $this->bottomLeftTerrainId = $bottomLeftTerrainId;

        return $this;
    }

    public function getBottomRightTerrainId(): ?int
    {
        return $this->bottomRightTerrainId;
    }

    public function setBottomRightTerrainId(?int $bottomRightTerrainId): Tile
    {
        $this->bottomRightTerrainId = $bottomRightTerrainId;

        return $this;
    }

    public function getProbability(): float
    {
        return $this->probability;
    }

    public function setProbability(float $probability): Tile
    {
        $this->probability = $probability;

        return $this;
    }

    public function getAnimation(): ?Animation
    {
        return $this->animation;
    }

    public function setAnimation(?Animation $animation): Tile
    {
        $this->animation = $animation;

        return $this;
    }
}
