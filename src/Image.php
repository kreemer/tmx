<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

class Image
{
    private ?string $format = null;
    private ?string $source;
    private ?int $width;
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
