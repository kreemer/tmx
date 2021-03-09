<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

class Layer extends TileLayer implements Printable, PropertyBagHolder
{
    use PropertyBagTrait;

    private int $order = 0;

    private int $x = 0;
    private int $y = 0;

    private ?int $width;
    private ?int $height;

    private ?LayerData $layerData;

    public function getOrder(): int
    {
        return $this->order;
    }

    public function setOrder(int $order): Layer
    {
        $this->order = $order;

        return $this;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function setX(int $x): Layer
    {
        $this->x = $x;

        return $this;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function setY(int $y): Layer
    {
        $this->y = $y;

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(?int $width): Layer
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): Layer
    {
        $this->height = $height;

        return $this;
    }

    public function getLayerData(): ?LayerData
    {
        return $this->layerData;
    }

    public function setLayerData(?LayerData $layerData): Layer
    {
        $layerData->setLayer($this);
        $this->layerData = $layerData;

        return $this;
    }
}
