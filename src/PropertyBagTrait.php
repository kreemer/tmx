<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

trait PropertyBagTrait
{
    private ?PropertyBag $propertyBag = null;

    public function getPropertyBag(): ?PropertyBag
    {
        return $this->propertyBag;
    }

    public function setPropertyBag(?PropertyBag $propertyBag): self
    {
        $this->propertyBag = $propertyBag;

        return $this;
    }
}
