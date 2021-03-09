<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

abstract class TileLayer
{
    private ?int $id = null;
    private ?string $name = null;

    private ?float $opacity = 1.0;
    private bool $visible = true;
    private ?string $tintColor = null;

    private float $offsetX = 0.0;
    private float $offsetY = 0.0;

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
