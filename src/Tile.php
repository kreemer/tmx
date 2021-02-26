<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;


class Tile
{
    private ?int $id = null;
    private ?string $type = null;
    private ?int $topLeftTerrainId = null;
    private ?int $topRightTerrainId = null;
    private ?int $bottomLeftTerrainId = null;
    private ?int $bottomRightTerrainId = null;
    private float $probability = 1.0;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Tile
     */
    public function setId(?int $id): Tile
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return Tile
     */
    public function setType(?string $type): Tile
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getTopLeftTerrainId(): ?int
    {
        return $this->topLeftTerrainId;
    }

    /**
     * @param int|null $topLeftTerrainId
     * @return Tile
     */
    public function setTopLeftTerrainId(?int $topLeftTerrainId): Tile
    {
        $this->topLeftTerrainId = $topLeftTerrainId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getTopRightTerrainId(): ?int
    {
        return $this->topRightTerrainId;
    }

    /**
     * @param int|null $topRightTerrainId
     * @return Tile
     */
    public function setTopRightTerrainId(?int $topRightTerrainId): Tile
    {
        $this->topRightTerrainId = $topRightTerrainId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getBottomLeftTerrainId(): ?int
    {
        return $this->bottomLeftTerrainId;
    }

    /**
     * @param int|null $bottomLeftTerrainId
     * @return Tile
     */
    public function setBottomLeftTerrainId(?int $bottomLeftTerrainId): Tile
    {
        $this->bottomLeftTerrainId = $bottomLeftTerrainId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getBottomRightTerrainId(): ?int
    {
        return $this->bottomRightTerrainId;
    }

    /**
     * @param int|null $bottomRightTerrainId
     * @return Tile
     */
    public function setBottomRightTerrainId(?int $bottomRightTerrainId): Tile
    {
        $this->bottomRightTerrainId = $bottomRightTerrainId;
        return $this;
    }

    /**
     * @return float
     */
    public function getProbability(): float
    {
        return $this->probability;
    }

    /**
     * @param int $probability
     * @return Tile
     */
    public function setProbability(float $probability): Tile
    {
        $this->probability = $probability;
        return $this;
    }


}