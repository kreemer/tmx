<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

class TileSet
{
    private ?int $firstGid;
    private ?string $source;
    private ?string $name;

    private ?int $tileWidth;
    private ?int $tileHeight;

    private ?int $spacing;
    private ?int $margin;
    private ?int $tileCount;
    private ?int $columns;
    private ?string $objectAlignment;

    private ?Image $image;

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
}
