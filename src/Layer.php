<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

class Layer
{
    private ?int $id;
    private ?string $name;

    private int $x = 0;
    private int $y = 0;

    private ?int $width;
    private ?int $height;

    private ?float $opacity = 1.0;
    private bool $visible = true;

    private ?string $tintColor = null;

    private int $offsetX = 0;
    private int $offsetY = 0;


    private ?LayerData $layerData;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Layer
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Layer
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @param int $x
     * @return Layer
     */
    public function setX(int $x): Layer
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
     * @return Layer
     */
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

    /**
     * @return float|null
     */
    public function getOpacity(): ?float
    {
        return $this->opacity;
    }

    /**
     * @param float|null $opacity
     * @return Layer
     */
    public function setOpacity($opacity): Layer
    {
        $this->opacity = $opacity;
        return $this;
    }

    /**
     * @return bool
     */
    public function isVisible(): bool
    {
        return $this->visible;
    }

    /**
     * @param bool $visible
     * @return Layer
     */
    public function setVisible(bool $visible): Layer
    {
        $this->visible = $visible;
        return $this;
    }


    public function getLayerData(): ?LayerData
    {
        return $this->layerData;
    }

    public function setLayerData(?LayerData $layerData): Layer
    {
        $this->layerData = $layerData;

        return $this;
    }
}
