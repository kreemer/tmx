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
 * Abstract class which are used by wangCornerColor and wangEdgeColor.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#wangcornercolor Documentation
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#wangedgecolor Documentation
 */
abstract class WangColor
{
    /**
     * The name of this color.
     *
     * @see WangColor::getName()
     * @see WangColor::setName()
     */
    private ?string $name = null;

    /**
     * The color in #RRGGBB format.
     *
     * @see WangColor::getColor()
     * @see WangColor::setColor()
     */
    private ?string $color = null;

    /**
     * The tile ID of the tile representing this color.
     *
     * @see WangColor::getTileId()
     * @see WangColor::setTileId()
     */
    private ?int $tileId = null;

    /**
     * The relative probability that this color is chosen over others in case of multiple options.
     *
     * @see WangColor::getProbability()
     * @see WangColor::setProbability()
     */
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
