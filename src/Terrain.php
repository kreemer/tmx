<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

class Terrain
{
    private ?string $name = null;
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
