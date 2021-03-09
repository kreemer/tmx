<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

class Tile implements PropertyBagHolder
{
    use PropertyBagTrait;

    private ?int $id = null;
    private ?string $type = null;
    private ?int $topLeftTerrainId = null;
    private ?int $topRightTerrainId = null;
    private ?int $bottomLeftTerrainId = null;
    private ?int $bottomRightTerrainId = null;
    private float $probability = 1.0;

    private ?Animation $animation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Tile
    {
        $this->id = $id;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): Tile
    {
        $this->type = $type;

        return $this;
    }

    public function getTopLeftTerrainId(): ?int
    {
        return $this->topLeftTerrainId;
    }

    public function setTopLeftTerrainId(?int $topLeftTerrainId): Tile
    {
        $this->topLeftTerrainId = $topLeftTerrainId;

        return $this;
    }

    public function getTopRightTerrainId(): ?int
    {
        return $this->topRightTerrainId;
    }

    public function setTopRightTerrainId(?int $topRightTerrainId): Tile
    {
        $this->topRightTerrainId = $topRightTerrainId;

        return $this;
    }

    public function getBottomLeftTerrainId(): ?int
    {
        return $this->bottomLeftTerrainId;
    }

    public function setBottomLeftTerrainId(?int $bottomLeftTerrainId): Tile
    {
        $this->bottomLeftTerrainId = $bottomLeftTerrainId;

        return $this;
    }

    public function getBottomRightTerrainId(): ?int
    {
        return $this->bottomRightTerrainId;
    }

    public function setBottomRightTerrainId(?int $bottomRightTerrainId): Tile
    {
        $this->bottomRightTerrainId = $bottomRightTerrainId;

        return $this;
    }

    public function getProbability(): float
    {
        return $this->probability;
    }

    public function setProbability(float $probability): Tile
    {
        $this->probability = $probability;

        return $this;
    }

    public function getAnimation(): ?Animation
    {
        return $this->animation;
    }

    public function setAnimation(?Animation $animation): Tile
    {
        $this->animation = $animation;

        return $this;
    }
}
