<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

class WangTile
{
    private ?int $tileId = null;
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
