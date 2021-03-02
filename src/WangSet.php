<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

class WangSet
{
    private ?string $name = null;
    private ?int $tileId = null;

    private array $wangEdgeColors = [];
    private array $wangCornerColors = [];
    private array $wangTiles = [];

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): WangSet
    {
        $this->name = $name;

        return $this;
    }

    public function getTileId(): ?int
    {
        return $this->tileId;
    }

    public function setTileId(?int $tileId): WangSet
    {
        $this->tileId = $tileId;

        return $this;
    }

    /**
     * @return array<WangEdgeColor>
     */
    public function getWangEdgeColors(): array
    {
        return $this->wangEdgeColors;
    }

    public function addWangEdgeColor(WangEdgeColor $wangEdgeColor): self
    {
        $this->wangEdgeColors[] = $wangEdgeColor;

        return $this;
    }

    public function removeWangEdgeColor(WangEdgeColor $wangEdgeColor): self
    {
        if (in_array($wangEdgeColor, $this->wangEdgeColors)) {
            $this->wangEdgeColors = array_diff($this->wangEdgeColors, [$wangEdgeColor]);
        }

        return $this;
    }

    /**
     * @return array<WangCornerColor>
     */
    public function getWangCornerColors(): array
    {
        return $this->wangCornerColors;
    }

    public function addWangCornerColor(WangCornerColor $wangCornerColor): self
    {
        $this->wangCornerColors[] = $wangCornerColor;

        return $this;
    }

    public function removeWangCornerColor(WangCornerColor $wangCornerColor): self
    {
        if (in_array($wangCornerColor, $this->wangCornerColors)) {
            $this->wangCornerColors = array_diff($this->wangCornerColors, [$wangCornerColor]);
        }

        return $this;
    }

    /**
     * @return array<WangTile>
     */
    public function getWangTiles(): array
    {
        return $this->wangTiles;
    }

    public function addWangTile(WangTile $wangTile): self
    {
        $this->wangTiles[] = $wangTile;

        return $this;
    }

    public function removeWangTile(WangTile $wangTile): self
    {
        if (in_array($wangTile, $this->wangTiles)) {
            $this->wangTiles = array_diff($this->wangTiles, [$wangTile]);
        }

        return $this;
    }
}
