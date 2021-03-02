<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;


class Chunk implements DataInterface
{
    private int $x = 0;
    private int $y = 0;
    private int $width = 0;
    private int $height = 0;
    private ?string $data = null;

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @param int $x
     * @return Chunk
     */
    public function setX(int $x): Chunk
    {
        $this->x = $x;
        return $this;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @param int $y
     * @return Chunk
     */
    public function setY(int $y): Chunk
    {
        $this->y = $y;
        return $this;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return Chunk
     */
    public function setWidth(int $width): Chunk
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return Chunk
     */
    public function setHeight(int $height): Chunk
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getData(): ?string
    {
        return $this->data;
    }

    /**
     * @param string|null $data
     * @return Chunk
     */
    public function setData(?string $data): Chunk
    {
        $this->data = $data;
        return $this;
    }
}