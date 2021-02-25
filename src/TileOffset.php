<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

class TileOffset
{
    private ?int $x = null;
    private ?int $y = null;

    public function getX(): ?int
    {
        return $this->x;
    }

    public function setX(?int $x): TileOffset
    {
        $this->x = $x;

        return $this;
    }

    public function getY(): ?int
    {
        return $this->y;
    }

    public function setY(?int $y): TileOffset
    {
        $this->y = $y;

        return $this;
    }
}
