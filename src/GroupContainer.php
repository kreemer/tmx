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
 * A group container provides different data holder objects.
 */
interface GroupContainer
{
    /**
     * @return Group[]
     */
    public function getGroups(): array;

    /**
     * @return Layer[]
     */
    public function getLayers(): array;

    /**
     * @return ObjectLayer[]
     */
    public function getObjectLayers(): array;

    /**
     * @return ImageLayer[]
     */
    public function getImageLayers(): array;
}
