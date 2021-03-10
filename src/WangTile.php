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
 * WangSet object.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#wangtile Documentation
 */
class WangTile
{
    /**
     * The tile ID.
     *
     * @see WangTile::getTileId()
     * @see WangTile::setTileId()
     */
    private ?int $tileId = null;

    /**
     * The Wang ID.
     *
     * A 32-bit unsigned integer stored in the format 0xCECECECE
     * (where each C is a corner color and each E is an edge color,
     * from right to left clockwise, starting with the top edge)
     *
     * @see WangTile::getWangId()
     * @see WangTile::setWangId()
     */
    private ?string $wangId = null;

    public function getTileId(): ?int
    {
        return $this->tileId;
    }

    public function setTileId(?int $tileId): WangTile
    {
        $this->tileId = $tileId;

        return $this;
    }

    public function getWangId(): ?string
    {
        return $this->wangId;
    }

    public function setWangId(?string $wangId): WangTile
    {
        $this->wangId = $wangId;

        return $this;
    }
}
