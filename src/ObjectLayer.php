<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

class ObjectLayer extends TileLayer implements Printable, PropertyBagHolder
{
    use PropertyBagTrait;

    private int $order = 0;

    private ?string $color = null;

    private int $x = 0;
    private int $y = 0;

    private ?int $width;
    private ?int $height;

    private string $drawOrder = 'topdown';

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
