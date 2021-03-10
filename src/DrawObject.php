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
 * Representation of an object.
 *
 * This class represents one object on a object layer
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#object Documentation
 */
abstract class DrawObject implements PropertyBagHolder
{
    use PropertyBagTrait;

    /**
     * Unique ID of the object.
     *
     * @see DrawObject::getId()
     * @see DrawObject::setId()
     */
    private ?int $id = null;

    /**
     * The name of the object.
     *
     * @see DrawObject::getName()
     * @see DrawObject::setName()
     */
    private ?string $name = null;

    /**
     * The type of the object.
     *
     * @see DrawObject::getType()
     * @see DrawObject::setType()
     */
    private ?string $type = null;

    /**
     * The x coordinate of the object in pixels.
     *
     * @see DrawObject::getX()
     * @see DrawObject::setX()
     */
    private float $x = 0.0;

    /**
     * The y coordinate of the object in pixels.
     *
     * @see DrawObject::getY()
     * @see DrawObject::setY()
     */
    private float $y = 0.0;

    /**
     * The width of the object in pixels.
     *
     * @see DrawObject::getWidth()
     * @see DrawObject::setWidth()
     */
    private float $width = 0.0;

    /**
     * The height of the object in pixels.
     *
     * @see DrawObject::getHeight()
     * @see DrawObject::setHeight()
     */
    private float $height = 0.0;

    /**
     * The rotation of the object in degrees clockwise around (x, y).
     *
     * @see DrawObject::getRotation()
     * @see DrawObject::setRotation()
     */
    private string $rotation = '0';

    /**
     * A reference to a tile.
     *
     * @see DrawObject::getGid()
     * @see DrawObject::setGid()
     */
    private ?int $gid = null;

    /**
     * Whether the object is shown (1) or hidden (0).
     *
     * @see DrawObject::isVisible()
     * @see DrawObject::setVisible()
     */
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
