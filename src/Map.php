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
     *
     * @see Map::getTiledVersion()
     * @see Map::setTiledVersion()
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
     *
     * @see Map::getRenderOrder()
     * @see Map::setRenderOrder()
     * @see Map::getRenderOrderAsString()
     * @see Map::setRenderOrderAsString()
     */
    private int $renderOrder = self::RENDER_ORDER_RIGHT_DOWN;

    /**
     * The compression level to use for tile layer data (defaults to -1, which means to use the algorithm default.
     *
     * @see Map::getCompressionLevel()
     * @see Map::setCompressionLevel()
     */
    private ?float $compressionLevel = null;

    /**
     * The width (in tiles) of this map.
     *
     * @see Map::getWidth()
     * @see Map::setWidth()
     */
    private ?int $width = null;

    /**
     * The height (in tiles) of this map.
     *
     * @see Map::getHeight()
     * @see Map::setHeight()
     */
    private ?int $height = null;

    /**
     * The width of one tile in pixel.
     *
     * @see Map::getTileWidth()
     * @see Map::setTileWidth()
     */
    private ?int $tileWidth = null;

    /**
     * The height of one tile in pixel.
     *
     * @see Map::getTileHeight()
     * @see Map::setTileHeight()
     */
    private ?int $tileHeight = null;

    /**
     * The background color of this map.
     *
     * The background color is in the rgb hexadecimal format (like #000000)
     *
     * @see Map::getBackgroundColor()
     * @see Map::setBackgroundColor()
     */
    private ?string $backgroundColor = null;

    /**
     * the next id of the layer which will be added.
     *
     * @var ?string
     *
     * @see Map::getNextLayerId()
     * @see Map::setNextLayerId()
     */
    private ?string $nextLayerId = null;

    /**
     *  The id of the next object which will be added.
     *
     * @var ?string
     *
     * @see Map::getNextObjectId()
     * @see Map::setNextObjectId()
     */
    private ?string $nextObjectId = null;

    /**
     * If the map is infinite or not.
     *
     * @see Map::isInfiniteMap()
     * @see Map::setInfiniteMap()
     */
    private bool $infiniteMap = false;

    /**
     * Array of tileSet objects.
     *
     * @var TileSet[]
     *
     * @see Map::addTileSet()
     * @see Map::removeTileSet()
     * @see Map::getTileSets()
     * @see Map::setTileSets()
     */
    private array $tileSets = [];

    /**
     * Array of layer objects.
     *
     * @var Layer[]
     *
     * @see Map::addLayer()
     * @see Map::removeLayer()
     * @see Map::getLayers()
     */
    private array $layers = [];

    /**
     * Array of layer objects.
     *
     * @var ObjectLayer[]
     *
     * @see Map::addObjectLayer()
     * @see Map::removeObjectLayer()
     * @see Map::getObjectLayers()
     */
    private array $objectLayers = [];

    /**
     * Array of group objects.
     *
     * @var Group[]
     *
     * @see Map::addGroup()
     * @see Map::removeGroup()
     * @see Map::getGroups()
     */
    private array $groups = [];

    /**
     * Array of image layer objects.
     *
     * @var ImageLayer[]
     *
     * @see Map::addImageLayer()
     * @see Map::removeImageLayer()
     * @see Map::getImageLayers()
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
     * @return $this
     *
     * @see Map::$renderOrder
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
     * @return $this
     *
     * @see Map::$renderOrder
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

    /**
     * get the compression level.
     *
     * @see Map::$compressionLevel
     */
    public function getCompressionLevel(): ?float
    {
        return $this->compressionLevel;
    }

    /**
     * set the compression level.
     *
     * @return $this
     *
     * @see Map::$compressionLevel
     */
    public function setCompressionLevel(?float $compressionLevel): Map
    {
        $this->compressionLevel = $compressionLevel;

        return $this;
    }

    /**
     * get the tiles width in pixel.
     *
     * @see Map::$tileWidth
     */
    public function getTileWidth(): ?int
    {
        return $this->tileWidth;
    }

    /**
     * set the tile width in pixel.
     *
     * @param int $tileWidth integer pixel
     *
     * @return $this
     *
     * @see Map::$tileWidth
     */
    public function setTileWidth(int $tileWidth): Map
    {
        $this->tileWidth = $tileWidth;

        return $this;
    }

    /**
     * get the tile height in pixel.
     *
     * @see Map::$tileHeight
     */
    public function getTileHeight(): ?int
    {
        return $this->tileHeight;
    }

    /**
     * set the tile height in pixel.
     *
     * @param int $tileHeight integer pixel
     *
     * @return $this
     *
     * @see Map::$tileHeight
     */
    public function setTileHeight(int $tileHeight): Map
    {
        $this->tileHeight = $tileHeight;

        return $this;
    }

    /**
     * get the background color in the format #000000.
     *
     * @see Map::$backgroundColor
     */
    public function getBackgroundColor(): ?string
    {
        return $this->backgroundColor;
    }

    /**
     * set the background color in the format #000000.
     *
     * @return string|null
     *
     * @see Map::$backgroundColor
     */
    public function setBackgroundColor(?string $backgroundColor): Map
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }

    /**
     * get the next layer id.
     *
     * @see Map::$nextLayerId
     */
    public function getNextLayerId(): ?string
    {
        return $this->nextLayerId;
    }

    /**
     * set the next layer id as string.
     *
     * @param string $nextLayerId The next layerId as string
     *
     * @see Map::$nextLayerId
     */
    public function setNextLayerId(string $nextLayerId): Map
    {
        $this->nextLayerId = $nextLayerId;

        return $this;
    }

    /**
     * Get the next objectId.
     *
     * @see Map::$nextObjectId
     */
    public function getNextObjectId(): ?string
    {
        return $this->nextObjectId;
    }

    /**
     * set the next object id.
     *
     * @param string $nextObjectId the next object id as string
     *
     * @return $this
     *
     * @see Map::$nextObjectId
     */
    public function setNextObjectId(string $nextObjectId): Map
    {
        $this->nextObjectId = $nextObjectId;

        return $this;
    }

    /**
     * get all tileSets as array.
     *
     * @return TileSet[]
     *
     * @see Map::$tileSets
     */
    public function getTileSets(): array
    {
        return $this->tileSets;
    }

    /**
     * Set the tileSet.
     *
     * @param array $tileSets the tileSets as an array
     *
     * @return $this
     *
     * @see Map::$tileSets
     */
    public function setTileSets(array $tileSets): Map
    {
        $this->tileSets = $tileSets;

        return $this;
    }

    /**
     * Add a tileSet to this map.
     *
     * @param TileSet $tileSet TileSet which will be added
     *
     * @return $this
     *
     * @see Map::$tileSets
     */
    public function addTileSet(TileSet $tileSet): Map
    {
        $this->tileSets[] = $tileSet;

        return $this;
    }

    /**
     * Remove a tileSet from this map.
     *
     * @param TileSet $tileSet TileSet which will be removed
     *
     * @return $this
     *
     * @see Map::$tileSets
     */
    public function removeTileSet(TileSet $tileSet): Map
    {
        if (in_array($tileSet, $this->tileSets)) {
            $this->tileSets = array_diff($this->tileSets, [$tileSet]);
        }

        return $this;
    }

    /**
     * get all map layers of this map.
     *
     * @return array<Layer>
     *
     * @see Map::$layers
     */
    public function getLayers(): array
    {
        return $this->layers;
    }

    /**
     * Add a layer to this map.
     *
     * @param Layer $layer layer which will be added
     *
     * @return $this
     *
     * @see Map::$layers
     */
    public function addLayer(Layer $layer): Map
    {
        $this->layers[] = $layer;
        $layer->setMap($this);

        return $this;
    }

    /**
     * Remove a layer from this map.
     *
     * @param Layer $layer layer which should be removed
     *
     * @return $this
     *
     * @see Map::$layers
     */
    public function removeLayer(Layer $layer): Map
    {
        if (in_array($layer, $this->layers)) {
            $this->layers = array_diff($this->layers, [$layer]);
        }

        return $this;
    }

    /**
     * get all groups.
     *
     * @return array<Group>
     *
     * @see Map::$groups
     */
    public function getGroups(): array
    {
        return $this->groups;
    }

    /**
     * Add a group to this map.
     *
     * @param Group $group Group which should be added
     *
     * @return $this
     *
     * @see Map::$groups
     */
    public function addGroup(Group $group): self
    {
        $this->groups[] = $group;

        return $this;
    }

    /**
     * Remove a group from this map.
     *
     * @param Group $group Group which should be removed
     *
     * @return $this
     *
     * @see Map::$groups
     */
    public function removeGroup(Group $group): self
    {
        if (in_array($group, $this->groups)) {
            $this->groups = array_diff($this->groups, [$group]);
        }

        return $this;
    }

    /**
     * Returns true if the map is infinite.
     *
     * @see Map::$infiniteMap
     */
    public function isInfiniteMap(): bool
    {
        return $this->infiniteMap;
    }

    /**
     * Set if this map is infinite.
     *
     * @return $this
     *
     * @see Map::$infiniteMap
     */
    public function setInfiniteMap(bool $infiniteMap): Map
    {
        $this->infiniteMap = $infiniteMap;

        return $this;
    }

    /**
     * get the width (in tiles) of this map.
     *
     * @see Map::$width
     */
    public function getWidth(): ?int
    {
        return $this->width;
    }

    /**
     * set the width in amount of tiles.
     *
     * @param int $width amount of tiles in the x-axis
     *
     * @return $this
     *
     * @see Map::$width
     */
    public function setWidth(int $width): Map
    {
        $this->width = $width;

        return $this;
    }

    /**
     * get the height in amount of tiles.
     *
     * @see Map::$height
     */
    public function getHeight(): ?int
    {
        return $this->height;
    }

    /**
     * set the height in amount of tiles.
     *
     * @param int $height amount of tiles in the y-axis
     *
     * @return $this
     *
     * @see Map::$height
     */
    public function setHeight(int $height): Map
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get all object layers as an array.
     *
     * @return array<ObjectLayer>
     *
     * @see Map::$objectLayers
     */
    public function getObjectLayers(): array
    {
        return $this->objectLayers;
    }

    /**
     * Add an object layer to this map.
     *
     * @param ObjectLayer $objectLayer ObjectLayer which should be added
     *
     * @return $this
     */
    public function addObjectLayer(ObjectLayer $objectLayer): self
    {
        $this->objectLayers[] = $objectLayer;

        return $this;
    }

    /**
     * Remove an object layer from this map.
     *
     * @param ObjectLayer $objectLayer ObjectLayer which should be removed
     *
     * @return $this
     *
     * @see Map::$objectLayers
     */
    public function removeObjectLayer(ObjectLayer $objectLayer): self
    {
        if (in_array($objectLayer, $this->objectLayers)) {
            $this->objectLayers = array_diff($this->objectLayers, [$objectLayer]);
        }

        return $this;
    }

    /**
     * get the image layers.
     *
     * @return array<ImageLayer>
     *
     * @see Map::$imageLayers
     */
    public function getImageLayers(): array
    {
        return $this->imageLayers;
    }

    /**
     * Add an image layer to this map.
     *
     * @param ImageLayer $imageLayer Image layer which will be added
     *
     * @return $this
     *
     * @see Map::$imageLayers
     */
    public function addImageLayer(ImageLayer $imageLayer): self
    {
        $this->imageLayers[] = $imageLayer;

        return $this;
    }

    /**
     * Remove an image layer from this map.
     *
     * @param ImageLayer $imageLayer Image layer which should be removed
     *
     * @return $this
     *
     * @see Map::$imageLayers
     */
    public function removeImageLayer(ImageLayer $imageLayer): self
    {
        if (in_array($imageLayer, $this->imageLayers)) {
            $this->imageLayers = array_diff($this->imageLayers, [$imageLayer]);
        }

        return $this;
    }
}
