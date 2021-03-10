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
 * A group layer, used to organize the layers of the map in a hierarchy.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#group Documentation
 */
class Group extends TileLayer implements GroupContainer, PropertyBagHolder
{
    use PropertyBagTrait;

    /**
     * @var Layer[] Array of layer objects
     */
    private array $layers = [];

    /**
     * @var Group[] Array of group objects
     */
    private array $groups = [];

    /**
     * @var ObjectLayer[] Array of object layer objects
     */
    private array $objectLayers = [];

    /**
     * @var ImageLayer[] Array of image layer objects
     */
    private array $imageLayers = [];

    /**
     * @return Layer[]
     */
    public function getLayers(): array
    {
        return $this->layers;
    }

    public function addLayer(Layer $layer): self
    {
        $this->layers[] = $layer;

        return $this;
    }

    public function removeLayer(Layer $layer): self
    {
        if (in_array($layer, $this->layers)) {
            $this->layers = array_diff($this->layers, [$layer]);
        }

        return $this;
    }

    /**
     * @return Group[]
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

    /**
     * @return ObjectLayer[]
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
     * @return ImageLayer[]
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
