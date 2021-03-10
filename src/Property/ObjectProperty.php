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
 * Object type property.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#property Documentation
 */
class ObjectProperty extends AbstractProperty
{
    /**
     * The value of the property.
     *
     * @see ObjectProperty::getValue()
     * @see ObjectProperty::setValue()
     */
    private ?int $value = null;

    /**
     * @see ObjectProperty::$value
     */
    public function getValue(): ?int
    {
        return $this->value;
    }

    /**
     * @see ObjectProperty::$value
     */
    public function setValue(?int $value): ObjectProperty
    {
        $this->value = $value;

        return $this;
    }
}
