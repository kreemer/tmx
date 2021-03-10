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
 * Represents an image layer.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#imagelayer Documentation
 */
class ImageLayer extends TileLayer implements PropertyBagHolder
{
    use PropertyBagTrait;

    /**
     * Which order in the map should this tileLayer be rendered.
     *
     * @see ImageLayer::getOrder()
     * @see ImageLayer::setOrder()
     */
    private int $order = 0;

    /**
     * An image object to draw.
     *
     * @see ImageLayer::setImage()
     * @see ImageLayer::getImage()
     */
    private ?Image $image = null;

    public function getOrder(): int
    {
        return $this->order;
    }

    public function setOrder(int $order): ImageLayer
    {
        $this->order = $order;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): ImageLayer
    {
        $this->image = $image;

        return $this;
    }
}
