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
 * Representation of a chunk.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#chunk Documentation
 */
class Chunk implements DataInterface
{
    /**
     * The x coordinate of the chunk in tiles.
     *
     * @see Chunk::getX()
     * @see Chunk::getX()
     */
    private int $x = 0;

    /**
     * The y coordinate of the chunk in tiles.
     *
     * @see Chunk::getY()
     * @see Chunk::getY()
     */
    private int $y = 0;

    /**
     * The width of the chunk in tiles.
     *
     * @see Chunk::getWidth()
     * @see Chunk::setWidth()
     */
    private int $width = 0;

    /**
     * The height of the chunk in tiles.
     *
     * @see Chunk::getHeight()
     * @see Chunk::setHeight()
     */
    private int $height = 0;

    /**
     * The contents of a chunk element is same as that of the data element,
     * except it stores the data of the area specified in the attributes.
     *
     * @see Chunk::getData()
     * @see Chunk::setData()
     */
    private ?string $data = null;

    public function getX(): int
    {
        return $this->x;
    }

    public function setX(int $x): Chunk
    {
        $this->x = $x;

        return $this;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function setY(int $y): Chunk
    {
        $this->y = $y;

        return $this;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setWidth(int $width): Chunk
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(int $height): Chunk
    {
        $this->height = $height;

        return $this;
    }

    public function getData(): ?string
    {
        return $this->data;
    }

    public function setData(?string $data): Chunk
    {
        $this->data = $data;

        return $this;
    }
}
