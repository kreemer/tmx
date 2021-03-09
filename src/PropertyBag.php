<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

use Tmx\Property\AbstractProperty;

class PropertyBag
{
    /**
     * @var array<AbstractProperty>
     */
    private array $properties = [];

    /**
     * @return array<AbstractProperty>
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    public function addProperty(AbstractProperty $property): self
    {
        $this->properties[] = $property;

        return $this;
    }

    public function removeProperty(AbstractProperty $property): self
    {
        if (in_array($property, $this->properties)) {
            $this->properties = array_diff($this->properties, [$property]);
        }

        return $this;
    }
}
