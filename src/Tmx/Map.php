<?php

/*
 * This file is part of the Tmx package.
 *
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

/**
 * Class Map.
 */
class Map
{
    /**
     * Rendering map from right / down.
     */
    const RENDER_ORDER_RIGHT_DOWN = 1;
    /**
     * Render the map from right / up.
     */
    const RENDER_ORDER_RIGHT_UP = 2;
    /**
     * Render the map from left / down.
     */
    const RENDER_ORDER_LEFT_DOWN = 3;
    /**
     * Render the map from left / up.
     */
    const RENDER_ORDER_LEFT_UP = 4;

    /**
     * Rendering map from right / down.
     */
    const ORIENTATION_ORTHOGONAL = 1;

    /**
     * Isometric orientation.
     */
    const ORIENTATION_ISOMETRIC = 2;

    /**
     * Staggered orientation.
     */
    const ORIENTATION_STAGGERED = 3;

    /**
     * Hexagonal orientation.
     */
    const ORIENTATION_HEXAGONAL = 4;

    private string $version;

    private ?string $tiledVersion;

    private int $orientation;

    private int $renderOrder = self::RENDER_ORDER_RIGHT_DOWN;

    private ?float $compressionLevel;

    private int $width;

    private int $height;

    private int $tileWidth;

    private int $tileHeight;

    private ?string $backgroundColor;

    /**
     * @var string the next id of the layer which will be added
     */
    private string $nextLayerId;

    /**
     * @var string The id of the next object which will be added
     */
    private string $nextObjectId;

    /**
     * @var bool If the map is infinite or not
     */
    private bool $infiniteMap = false;

    /**
     * @var array Array of tileSet objects
     */
    private array $tileSets = [];

    /**
     * @var array Array of layer objects
     */
    private array $layers = [];

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): Map
    {
        $this->version = $version;

        return $this;
    }

    public function getTiledVersion(): ?string
    {
        return $this->tiledVersion;
    }

    public function setTiledVersion(?string $tiledVersion): Map
    {
        $this->tiledVersion = $tiledVersion;

        return $this;
    }

    public function getOrientation(): int
    {
        return $this->orientation;
    }

    public function setOrientation(int $orientation): Map
    {
        $this->orientation = $orientation;

        return $this;
    }

    public function getOrientationAsString(): string
    {
        switch ($this->getOrientation()) {
            case self::ORIENTATION_ORTHOGONAL:
                return 'orthogonal';
            case self::ORIENTATION_ISOMETRIC:
                return 'isometric';
            case self::ORIENTATION_STAGGERED:
                return 'staggered';
            case self::ORIENTATION_HEXAGONAL:
                return 'hexagonal';
        }

        return 'undefined';
    }

    public function setOrientationAsString(string $orientation): Map
    {
        switch ($orientation) {
            case 'orthogonal':
                $this->orientation = self::ORIENTATION_ORTHOGONAL;
                break;
            case 'isometric':
                $this->orientation = self::ORIENTATION_ISOMETRIC;
                break;
            case 'staggered':
                $this->orientation = self::ORIENTATION_STAGGERED;
                break;
            case 'hexagonal':
                $this->orientation = self::ORIENTATION_HEXAGONAL;
                break;
        }

        return $this;
    }

    public function getRenderOrder(): int
    {
        return $this->renderOrder;
    }

    public function setRenderOrder(int $renderOrder): Map
    {
        $this->renderOrder = $renderOrder;

        return $this;
    }

    public function getRenderOrderAsString(): string
    {
        switch ($this->getRenderOrder()) {
            case self::RENDER_ORDER_RIGHT_DOWN:
                return 'right-down';
            case self::RENDER_ORDER_RIGHT_UP:
                return 'right-up';
            case self::RENDER_ORDER_LEFT_DOWN:
                return 'left-down';
            case self::RENDER_ORDER_LEFT_UP:
                return 'left-up';
        }

        return 'undefined';
    }

    public function setRenderOrderAsString(string $renderOrder): Map
    {
        switch ($renderOrder) {
            case 'right-down':
                $this->renderOrder = self::RENDER_ORDER_RIGHT_DOWN;
                break;
            case 'right-up':
                $this->renderOrder = self::RENDER_ORDER_RIGHT_UP;
                break;
            case 'left-down':
                $this->renderOrder = self::RENDER_ORDER_LEFT_DOWN;
                break;
            case 'left-up':
                $this->renderOrder = self::RENDER_ORDER_LEFT_UP;
                break;
        }

        return $this;
    }

    public function getCompressionLevel(): ?float
    {
        return $this->compressionLevel;
    }

    public function setCompressionLevel(?float $compressionLevel): Map
    {
        $this->compressionLevel = $compressionLevel;

        return $this;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setWidth(int $width): Map
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(int $height): Map
    {
        $this->height = $height;

        return $this;
    }

    public function getTileWidth(): int
    {
        return $this->tileWidth;
    }

    public function setTileWidth(int $tileWidth): Map
    {
        $this->tileWidth = $tileWidth;

        return $this;
    }

    public function getTileHeight(): int
    {
        return $this->tileHeight;
    }

    public function setTileHeight(int $tileHeight): Map
    {
        $this->tileHeight = $tileHeight;

        return $this;
    }

    public function getBackgroundColor(): ?string
    {
        return $this->backgroundColor;
    }

    public function setBackgroundColor(?string $backgroundColor): Map
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }

    public function getNextLayerId(): string
    {
        return $this->nextLayerId;
    }

    public function setNextLayerId(string $nextLayerId): Map
    {
        $this->nextLayerId = $nextLayerId;

        return $this;
    }

    public function getNextObjectId(): string
    {
        return $this->nextObjectId;
    }

    public function setNextObjectId(string $nextObjectId): Map
    {
        $this->nextObjectId = $nextObjectId;

        return $this;
    }

    public function isInfiniteMap(): bool
    {
        return $this->infiniteMap;
    }

    public function setInfiniteMap(bool $infiniteMap): Map
    {
        $this->infiniteMap = $infiniteMap;

        return $this;
    }

    public function getTileSets(): array
    {
        return $this->tileSets;
    }

    public function addTileSet(TileSet $tileSet): Map
    {
        $this->tileSets[] = $tileSet;

        return $this;
    }

    public function removeTileSet(TileSet $tileSet): Map
    {
        if (in_array($tileSet, $this->tileSets)) {
            $this->tileSets = array_diff($this->tileSets, [$tileSet]);
        }

        return $this;
    }

    public function getLayers(): array
    {
        return $this->layers;
    }

    public function addLayer(Layer $layer): Map
    {
        $this->layers[] = $layer;

        return $this;
    }

    public function removeLayer(Layer $layer): Map
    {
        if (in_array($layer, $this->layers)) {
            $this->layers = array_diff($this->layers, [$layer]);
        }

        return $this;
    }
}
