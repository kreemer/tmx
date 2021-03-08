<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

class Group extends TileLayer implements GroupContainer
{
    /**
     * @var array<Layer> Array of layer objects
     */
    private array $layers = [];

    /**
     * @var array<Group> Array of group objects
     */
    private array $groups = [];

    /**
     * @return array<Layer>
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
}
