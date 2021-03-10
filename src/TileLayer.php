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
 * This class represents an abstract layer of an map.
 */
abstract class TileLayer
{
    /**
     * Unique ID of the layer.
     *
     * @see TileLayer::getId()
     * @see TileLayer::setId()
     */
    private ?int $id = null;

    /**
     * The name of the layer.
     *
     * @see TileLayer::getName()
     * @see TileLayer::setName()
     */
    private ?string $name = null;

    /**
     * The opacity of the layer as a value from 0 to 1.
     *
     * @see TileLayer::getOpacity()
     * @see TileLayer::setOpacity()
     */
    private ?float $opacity = 1.0;

    /**
     * Whether the layer is shown (1) or hidden (0).
     *
     * @see TileLayer::isVisible()
     * @see TileLayer::setVisible()
     */
    private bool $visible = true;

    /**
     * A color that is multiplied with any tiles drawn by this layer in #AARRGGBB or #RRGGBB format.
     *
     * @see TileLayer::getTintColor()
     * @see TileLayer::setTintColor()
     */
    private ?string $tintColor = null;

    /**
     * Horizontal offset for this layer in pixels. Defaults to 0.
     *
     * @see TileLayer::getOffsetX()
     * @see TileLayer::setOffsetX()
     */
    private float $offsetX = 0.0;

    /**
     * Vertical offset for this layer in pixels. Defaults to 0.
     *
     * @see TileLayer::getOffsetY()
     * @see TileLayer::setOffsetY()
     */
    private float $offsetY = 0.0;

    /**
     * The map object, which holds this layer.
     *
     * @see TileLayer::getMap()
     * @see TileLayer::setMap()
     */
    private ?Map $map;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): TileLayer
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): TileLayer
    {
        $this->name = $name;

        return $this;
    }

    public function getOpacity(): ?float
    {
        return $this->opacity;
    }

    public function setOpacity(?float $opacity): TileLayer
    {
        $this->opacity = $opacity;

        return $this;
    }

    public function isVisible(): bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): TileLayer
    {
        $this->visible = $visible;

        return $this;
    }

    public function getTintColor(): ?string
    {
        return $this->tintColor;
    }

    public function setTintColor(?string $tintColor): TileLayer
    {
        $this->tintColor = $tintColor;

        return $this;
    }

    public function getOffsetX(): float
    {
        return $this->offsetX;
    }

    public function setOffsetX(float $offsetX): TileLayer
    {
        $this->offsetX = $offsetX;

        return $this;
    }

    public function getOffsetY(): float
    {
        return $this->offsetY;
    }

    public function setOffsetY(float $offsetY): TileLayer
    {
        $this->offsetY = $offsetY;

        return $this;
    }

    public function getMap(): ?Map
    {
        return $this->map;
    }

    public function setMap(?Map $map): TileLayer
    {
        $this->map = $map;

        return $this;
    }
}
