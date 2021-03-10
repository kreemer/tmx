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
 * Interface for all elements, which contains properties.
 */
interface PropertyBagHolder
{
    /**
     * get the property bag.
     */
    public function getPropertyBag(): ?PropertyBag;
}
