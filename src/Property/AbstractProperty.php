<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Property;

/**
 * Base class for all properties.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#property Documentation
 */
abstract class AbstractProperty
{
    /**
     * The name of the property.
     *
     * @see AbstractProperty::getName()
     * @see AbstractProperty::setName()
     */
    private ?string $name = null;

    /**
     * @see AbstractProperty::name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @see AbstractProperty::name
     */
    public function setName(?string $name): AbstractProperty
    {
        $this->name = $name;

        return $this;
    }
}
