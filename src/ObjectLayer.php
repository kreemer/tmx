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
 * Represents an object group.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#objectgroup Documentation
 */
class ObjectLayer extends TileLayer implements Printable, PropertyBagHolder
{
    use PropertyBagTrait;

    /**
     * Which order in the map should this tileLayer be rendered.
     *
     * @see ObjectLayer::getOrder()
     * @see ObjectLayer::setOrder()
     */
    private int $order = 0;

    /**
     * The color used to display the objects in this group.
     *
     * @see ObjectLayer::getColor()
     * @see ObjectLayer::setColor()
     */
    private ?string $color = null;

    /**
     * The x coordinate of the layer in tiles.
     *
     * @see ObjectLayer::getX()
     * @see ObjectLayer::setX()
     */
    private int $x = 0;

    /**
     * The y coordinate of the layer in tiles.
     *
     * @see ObjectLayer::getY()
     * @see ObjectLayer::setY()
     */
    private int $y = 0;

    /**
     * The width of the layer in tiles. Always the same as the map width for fixed-size maps.
     *
     * @see ObjectLayer::getWidth()
     * @see ObjectLayer::setWidth()
     */
    private ?int $width;

    /**
     * The height of the layer in tiles. Always the same as the map height for fixed-size maps.
     *
     * @see ObjectLayer::getHeight()
     * @see ObjectLayer::setHeight()
     */
    private ?int $height;

    /**
     * With which algorithm should the objects be drawn?
     *
     * @see ObjectLayer::getDrawOrder()
     * @see ObjectLayer::setDrawOrder()
     */
    private string $drawOrder = 'topdown';

    /**
     * All the objects in this layer.
     *
     * @var DrawObject[]
     *
     * @see ObjectLayer::getDrawObjects()
     * @see ObjectLayer::addDrawObject()
     * @see ObjectLayer::removeDrawObject()
     */
    private array $drawObjects = [];

    public function getOrder(): int
    {
        return $this->order;
    }

    public function setOrder(int $order): ObjectLayer
    {
        $this->order = $order;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): ObjectLayer
    {
        $this->color = $color;

        return $this;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function setX(int $x): ObjectLayer
    {
        $this->x = $x;

        return $this;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function setY(int $y): ObjectLayer
    {
        $this->y = $y;

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(?int $width): ObjectLayer
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): ObjectLayer
    {
        $this->height = $height;

        return $this;
    }

    public function getDrawOrder(): string
    {
        return $this->drawOrder;
    }

    public function setDrawOrder(string $drawOrder): ObjectLayer
    {
        $this->drawOrder = $drawOrder;

        return $this;
    }

    /**
     * @return array<DrawObject>
     */
    public function getDrawObjects(): array
    {
        return $this->drawObjects;
    }

    public function addDrawObject(DrawObject $drawObject): self
    {
        $this->drawObjects[] = $drawObject;

        return $this;
    }

    public function removeDrawObject(DrawObject $drawObject): self
    {
        if (in_array($drawObject, $this->drawObjects)) {
            $this->drawObjects = array_diff($this->drawObjects, [$drawObject]);
        }

        return $this;
    }
}
