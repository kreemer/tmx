<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

class ImageLayer extends TileLayer implements PropertyBagHolder
{
    use PropertyBagTrait;

    private int $order = 0;

    private ?Image $image = null;

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * @param int $order
     * @return ImageLayer
     */
    public function setOrder(int $order): ImageLayer
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return Image|null
     */
    public function getImage(): ?Image
    {
        return $this->image;
    }

    /**
     * @param Image|null $image
     * @return ImageLayer
     */
    public function setImage(?Image $image): ImageLayer
    {
        $this->image = $image;
        return $this;
    }
}
