<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

abstract class DrawObject implements PropertyBagHolder
{
    use PropertyBagTrait;

    private ?int $id = null;
    private ?string $name = null;
    private ?string $type = null;
    private float $x = 0.0;
    private float $y = 0.0;
    private float $width = 0.0;
    private float $height = 0.0;
    private string $rotation = '0';
    private ?int $gid = null;
    private bool $visible = true;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): DrawObject
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): DrawObject
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): DrawObject
    {
        $this->type = $type;

        return $this;
    }

    public function getX(): float
    {
        return $this->x;
    }

    public function setX(float $x): DrawObject
    {
        $this->x = $x;

        return $this;
    }

    public function getY(): float
    {
        return $this->y;
    }

    public function setY(float $y): DrawObject
    {
        $this->y = $y;

        return $this;
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function setWidth(float $width): DrawObject
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function setHeight(float $height): DrawObject
    {
        $this->height = $height;

        return $this;
    }

    public function getRotation(): string
    {
        return $this->rotation;
    }

    public function setRotation(string $rotation): DrawObject
    {
        $this->rotation = $rotation;

        return $this;
    }

    public function getGid(): ?int
    {
        return $this->gid;
    }

    public function setGid(?int $gid): DrawObject
    {
        $this->gid = $gid;

        return $this;
    }

    public function isVisible(): bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): DrawObject
    {
        $this->visible = $visible;

        return $this;
    }
}
