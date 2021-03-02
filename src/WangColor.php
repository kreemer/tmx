<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

abstract class WangColor
{
    private ?string $name = null;
    private ?string $color = null;
    private ?int $tileId = null;
    private float $probability = 1.0;

    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return WangColor
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @return WangColor
     */
    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getTileId(): ?int
    {
        return $this->tileId;
    }

    /**
     * @return WangColor
     */
    public function setTileId(?int $tileId): self
    {
        $this->tileId = $tileId;

        return $this;
    }

    public function getProbability(): float
    {
        return $this->probability;
    }

    /**
     * @return WangColor
     */
    public function setProbability(float $probability): self
    {
        $this->probability = $probability;

        return $this;
    }
}
