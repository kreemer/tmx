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
 * Represents the tileOffset object.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#tileset Documentation
 */
class TileSet implements PropertyBagHolder
{
    use PropertyBagTrait;

    /**
     * The first global tile ID of this tileset (this global ID maps to the first tile in this tileset).
     *
     * @see TileSet::getFirstGid()
     * @see TileSet::setFirstGid()
     */
    private ?int $firstGid = null;

    /**
     * If this tileset is stored in an external TSX (Tile Set XML) file, this attribute refers to that file.
     *
     * @see TileSet::getSource()
     * @see TileSet::setSource()
     */
    private ?string $source = null;

    /**
     * The name of this tileset.
     *
     * @see TileSet::getName()
     * @see TileSet::setName()
     */
    private ?string $name = null;

    /**
     *  The (maximum) width of the tiles in this tileset.
     *
     * @see TileSet::getTileWidth()
     * @see TileSet::setTileWidth()
     */
    private ?int $tileWidth = null;

    /**
     * The (maximum) height of the tiles in this tileset.
     *
     * @see TileSet::getTileHeight()
     * @see TileSet::setTileHeight()
     */
    private ?int $tileHeight = null;

    /**
     * The spacing in pixels between the tiles in this tileset.
     *
     * @see TileSet::getSpacing()
     * @see TileSet::setSpacing()
     */
    private ?int $spacing = null;

    /**
     * The margin around the tiles in this tileset.
     *
     * @see TileSet::getMargin()
     * @see TileSet::setMargin()
     */
    private ?int $margin = null;

    /**
     * The number of tiles in this tileset.
     *
     * @see TileSet::getTileCount()
     * @see TileSet::setTileCount()
     */
    private ?int $tileCount = null;

    /**
     * The number of tile columns in the tileset.
     * For image collection tilesets it is editable and is used when displaying the tileset.
     *
     * @see TileSet::getColumns()
     * @see TileSet::setColumns()
     */
    private ?int $columns = null;

    /**
     * Controls the alignment for tile objects.
     *
     * @see TileSet::getObjectAlignment()
     * @see TileSet::setObjectAlignment()
     */
    private ?string $objectAlignment = null;

    /**
     * @see TileSet::getImage()
     * @see TileSet::setImage()
     */
    private ?Image $image = null;

    /**
     * @see TileSet::getTileOffset()
     * @see TileSet::setTileOffset()
     */
    private ?TileOffset $tileOffset = null;

    /**
     * @see TileSet::getTerrainCollection()
     * @see TileSet::setTerrainCollection()
     */
    private ?TerrainCollection $terrainCollection = null;

    /**
     * @see TileSet::getWangCollection()
     * @see TileSet::setWangCollection()
     */
    private ?WangCollection $wangCollection = null;

    /**
     * @var Tile[]
     *
     * @see TileSet::getTiles()
     * @see TileSet::addTile()
     * @see TileSet::removeTile()
     */
    private array $tiles = [];

    public function getFirstGid(): ?int
    {
        return $this->firstGid;
    }

    public function setFirstGid(?int $firstGid): TileSet
    {
        $this->firstGid = $firstGid;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(?string $source): TileSet
    {
        $this->source = $source;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): TileSet
    {
        $this->name = $name;

        return $this;
    }

    public function getTileWidth(): ?int
    {
        return $this->tileWidth;
    }

    public function setTileWidth(?int $tileWidth): TileSet
    {
        $this->tileWidth = $tileWidth;

        return $this;
    }

    public function getTileHeight(): ?int
    {
        return $this->tileHeight;
    }

    public function setTileHeight(?int $tileHeight): TileSet
    {
        $this->tileHeight = $tileHeight;

        return $this;
    }

    public function getSpacing(): ?int
    {
        return $this->spacing;
    }

    public function setSpacing(?int $spacing): TileSet
    {
        $this->spacing = $spacing;

        return $this;
    }

    public function getMargin(): ?int
    {
        return $this->margin;
    }

    public function setMargin(?int $margin): TileSet
    {
        $this->margin = $margin;

        return $this;
    }

    public function getTileCount(): ?int
    {
        return $this->tileCount;
    }

    public function setTileCount(?int $tileCount): TileSet
    {
        $this->tileCount = $tileCount;

        return $this;
    }

    public function getColumns(): ?int
    {
        return $this->columns;
    }

    public function setColumns(?int $columns): TileSet
    {
        $this->columns = $columns;

        return $this;
    }

    public function getObjectAlignment(): ?string
    {
        return $this->objectAlignment;
    }

    public function setObjectAlignment(?string $objectAlignment): TileSet
    {
        $this->objectAlignment = $objectAlignment;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): TileSet
    {
        $this->image = $image;

        return $this;
    }

    public function getTileOffset(): ?TileOffset
    {
        return $this->tileOffset;
    }

    public function setTileOffset(?TileOffset $tileOffset): TileSet
    {
        $this->tileOffset = $tileOffset;

        return $this;
    }

    public function getTerrainCollection(): ?TerrainCollection
    {
        return $this->terrainCollection;
    }

    public function setTerrainCollection(?TerrainCollection $terrainCollection): TileSet
    {
        $this->terrainCollection = $terrainCollection;

        return $this;
    }

    /**
     * @return Tile[]
     */
    public function getTiles(): array
    {
        return $this->tiles;
    }

    public function addTile(Tile $tile): self
    {
        $this->tiles[] = $tile;

        return $this;
    }

    public function removeTile(Tile $tile): self
    {
        if (in_array($tile, $this->tiles)) {
            $this->tiles = array_diff($this->tiles, [$tile]);
        }

        return $this;
    }

    public function getWangCollection(): ?WangCollection
    {
        return $this->wangCollection;
    }

    public function setWangCollection(?WangCollection $wangCollection): TileSet
    {
        $this->wangCollection = $wangCollection;

        return $this;
    }
}
