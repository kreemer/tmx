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
 * Represents an image.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#image Documentation
 */
class Image
{
    /**
     * Used for embedded images, in combination with a data child element.
     * Valid values are file extensions like png, gif, jpg, bmp, etc.
     *
     * @see Image::getFormat()
     * @see Image::setFormat()
     */
    private ?string $format = null;

    /**
     * The reference to the tileset image file (Tiled supports most common image formats).
     * Only used if the image is not embedded.
     *
     * @see Image::getSource()
     * @see Image::setSource()
     */
    private ?string $source;

    /**
     * The image width in pixels (optional).
     *
     * @see Image::getWidth()
     * @see Image::setWidth()
     */
    private ?int $width;

    /**
     * The image height in pixels (optional).
     *
     * @see Image::getHeight()
     * @see Image::setHeight()
     */
    private ?int $height;

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(?string $format): Image
    {
        $this->format = $format;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(?string $source): Image
    {
        $this->source = $source;

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(?int $width): Image
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): Image
    {
        $this->height = $height;

        return $this;
    }
}
