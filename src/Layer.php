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
 * Represents a layer.
 *
 * A layer contains different tiles which can be printed
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#layer Documentation
 */
class Layer extends TileLayer implements Printable, PropertyBagHolder
{
    use PropertyBagTrait;

    /**
     * Which order in the map should this tileLayer be rendered.
     *
     * @see Layer::setOrder()
     * @see Layer::setOrder()
     */
    private int $order = 0;

    /**
     * The x coordinate of the layer in tiles.
     *
     * @see Layer::getX()
     * @see Layer::setX()
     */
    private int $x = 0;

    /**
     * The y coordinate of the layer in tiles.
     *
     * @see Layer::getY()
     * @see Layer::setY()
     */
    private int $y = 0;

    /**
     * The width of the layer in tiles. Always the same as the map width for fixed-size maps.
     *
     * @see Layer::getWidth()
     * @see Layer::setWidth()
     */
    private ?int $width;

    /**
     * The height of the layer in tiles. Always the same as the map height for fixed-size maps.
     *
     * @see Layer::getHeight()
     * @see Layer::setHeight()
     */
    private ?int $height;

    /**
     * Data which are under this layer.
     *
     * @see Layer::getLayerData()
     * @see Layer::setLayerData()
     */
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
