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
