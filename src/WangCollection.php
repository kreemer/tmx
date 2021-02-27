<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

class WangCollection
{
    private array $wangSets = [];

    /**
     * @return array<WangSet>
     */
    public function getWangSets(): array
    {
        return $this->wangSets;
    }

    public function addWangSet(WangSet $wangSet): self
    {
        $this->wangSets[] = $wangSet;

        return $this;
    }

    public function removeWangSet(WangSet $wangSet): self
    {
        if (in_array($wangSet, $this->wangSets)) {
            $this->wangSets = array_diff($this->wangSets, [$wangSet]);
        }

        return $this;
    }
}
