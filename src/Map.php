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
 * Representation of a map inside a tmx file.
 *
 * This class contains all map related data. It closely represent the map element inside of a tmx file.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#map Documentation
 */
class Map implements GroupContainer, PropertyBagHolder
{
    use PropertyBagTrait;

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

    /**
     * The parsed version of the map.
     *
     * @see Map::getVersion()
     * @see Map::setVersion()
     */
    private ?string $version = null;

    /**
     * The version of tiled, which created the map.
     */
    private ?string $tiledVersion = null;

    /**
     * The internal representation of the orientation of the map.
     *
     * the orientation is internally saved as an integer: 0 (orthogonal), 1 (isometric), 2 (staggered) or 3 (hexagonal)
     *
     * @see Map::getOrientationAsString() Returns orientation as string
     * @see Map::setOrientationAsString() Sets the orientation as string
     * @see Map::getOrientation() Returns the orientation as int
     * @see Map::setOrientation() Sets the orientation as int
     */
    private ?int $orientation = self::ORIENTATION_ORTHOGONAL;

    /**
     * Used rendering order.
     *
     * The rendering order does control how a map will be printed. The value is an integer:  0 (right-down), 1 (right-left), 2 (top-down), 3 (top-left)
     */
    private int $renderOrder = self::RENDER_ORDER_RIGHT_DOWN;

    /**
     * How the compression is used.
     */
    private ?float $compressionLevel = null;

    /**
     * The width (in tiles) of this map.
     */
    private ?int $width = null;

    /**
     * The height (in tiles) of this map.
     */
    private ?int $height = null;

    /**
     * The width of one tile in pixel.
     */
    private ?int $tileWidth = null;

    /**
     * The height of one tile in pixel.
     */
    private ?int $tileHeight = null;

    /**
     * The background color of this map.
     */
    private ?string $backgroundColor = null;

    /**
     * the next id of the layer which will be added.
     *
     * @var ?string
     */
    private ?string $nextLayerId = null;

    /**
     *  The id of the next object which will be added.
     *
     * @var ?string
     */
    private ?string $nextObjectId = null;

    /**
     * If the map is infinite or not.
     */
    private bool $infiniteMap = false;

    /**
     * Array of tileSet objects.
     *
     * @var TileSet[]
     */
    private array $tileSets = [];

    /**
     * Array of layer objects.
     *
     * @var Layer[]
     */
    private array $layers = [];

    /**
     * Array of layer objects.
     *
     * @var ObjectLayer[]
     */
    private array $objectLayers = [];

    /**
     * Array of group objects.
     *
     * @var Group[]
     */
    private array $groups = [];

    /**
     * Array of image layer objects.
     *
     * @var ImageLayer[]
     */
    private array $imageLayers = [];

    /**
     * Get the version of the tmx format.
     *
     * @see Map::$version
     */
    public function getVersion(): ?string
    {
        return $this->version;
    }

    /**
     * Set the version of the tmx format.
     *
     * @param string $version The version as string
     *
     * @see Map::$version
     *
     * @return $this
     */
    public function setVersion(string $version): Map
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get the version of the tiled editor, which saved this map.
     *
     * @see Map::$tiledVersion
     */
    public function getTiledVersion(): ?string
    {
        return $this->tiledVersion;
    }

    /**
     * Set the tiled version.
     *
     * @param ?string $tiledVersion the version as string
     *
     * @see Map::$tiledVersion
     *
     * @return $this
     */
    public function setTiledVersion(?string $tiledVersion): Map
    {
        $this->tiledVersion = $tiledVersion;

        return $this;
    }

    /**
     * Returns the orientation as a string.
     *
     * The orientation can be: orthogonal, isometric, staggered or hexagonal.
     *
     * @see Map::$orientation
     */
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

    /**
     * get orientation as int.
     *
     * @see Map::$orientation
     */
    public function getOrientation(): ?int
    {
        return $this->orientation;
    }

    /**
     * Set the orientation as int.
     *
     * @param int $orientation set the orientation as string, must be between 0-3
     *
     * @see Map::$orientation
     *
     * @return $this
     */
    public function setOrientation(int $orientation): Map
    {
        $this->orientation = $orientation;

        return $this;
    }

    /**
     * Set the current orientation with a string.
     *
     * @param string $orientation string, either orthogonal, isometric, staggered or hexagonal. Ignored if string is not one of those.
     *
     * @see Map::$orientation
     *
     * @return $this
     */
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

    /**
     * Get the rendering order as a string.
     *
     * The rendering order can either be: right-down, right-left, top-down, top-left
     *
     * @see Map::$renderOrder
     */
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

    /**
     * Get the rendering order as an int.
     *
     * @see Map::$renderOrder
     */
    public function getRenderOrder(): int
    {
        return $this->renderOrder;
    }

    /**
     * Get the rendering order as an int.
     *
     * @param int $renderOrder Rendering order as an int, see {@see Map::$renderOrder}
     *
     * @see Map::$renderOrder
     *
     * @return $this
     */
    public function setRenderOrder(int $renderOrder): Map
    {
        $this->renderOrder = $renderOrder;

        return $this;
    }

    /**
     * Set the rendering order as a string.
     *
     * @param string $renderOrder Rendering order right-down, right-left, top-down, top-left
     *
     * @see Map::$renderOrder
     *
     * @return $this
     */
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

    public function getTileWidth(): ?int
    {
        return $this->tileWidth;
    }

    public function setTileWidth(int $tileWidth): Map
    {
        $this->tileWidth = $tileWidth;

        return $this;
    }

    public function getTileHeight(): ?int
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

    public function getNextLayerId(): ?string
    {
        return $this->nextLayerId;
    }

    public function setNextLayerId(string $nextLayerId): Map
    {
        $this->nextLayerId = $nextLayerId;

        return $this;
    }

    public function getNextObjectId(): ?string
    {
        return $this->nextObjectId;
    }

    public function setNextObjectId(string $nextObjectId): Map
    {
        $this->nextObjectId = $nextObjectId;

        return $this;
    }

    /**
     * @return TileSet[]
     */
    public function getTileSets(): array
    {
        return $this->tileSets;
    }

    public function setTileSets(array $tileSets): Map
    {
        $this->tileSets = $tileSets;

        return $this;
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

    /**
     * @return array<Layer>
     */
    public function getLayers(): array
    {
        return $this->layers;
    }

    public function addLayer(Layer $layer): Map
    {
        $this->layers[] = $layer;
        $layer->setMap($this);

        return $this;
    }

    public function removeLayer(Layer $layer): Map
    {
        if (in_array($layer, $this->layers)) {
            $this->layers = array_diff($this->layers, [$layer]);
        }

        return $this;
    }

    /**
     * @return array<Group>
     */
    public function getGroups(): array
    {
        return $this->groups;
    }

    public function addGroup(Group $group): self
    {
        $this->groups[] = $group;

        return $this;
    }

    public function removeGroup(Group $group): self
    {
        if (in_array($group, $this->groups)) {
            $this->groups = array_diff($this->groups, [$group]);
        }

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

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(int $width): Map
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): Map
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return array<ObjectLayer>
     */
    public function getObjectLayers(): array
    {
        return $this->objectLayers;
    }

    public function addObjectLayer(ObjectLayer $objectLayer): self
    {
        $this->objectLayers[] = $objectLayer;

        return $this;
    }

    public function removeObjectLayer(ObjectLayer $objectLayer): self
    {
        if (in_array($objectLayer, $this->objectLayers)) {
            $this->objectLayers = array_diff($this->objectLayers, [$objectLayer]);
        }

        return $this;
    }

    /**
     * @return array<ImageLayer>
     */
    public function getImageLayers(): array
    {
        return $this->imageLayers;
    }

    public function addImageLayer(ImageLayer $imageLayer): self
    {
        $this->imageLayers[] = $imageLayer;

        return $this;
    }

    public function removeImageLayer(ImageLayer $imageLayer): self
    {
        if (in_array($imageLayer, $this->imageLayers)) {
            $this->imageLayers = array_diff($this->imageLayers, [$imageLayer]);
        }

        return $this;
    }
}
