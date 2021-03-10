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
 * Float type property.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#property Documentation
 */
class FloatProperty extends AbstractProperty
{
    /**
     * The value of the property.
     *
     * @see FloatProperty::getValue()
     * @see FloatProperty::setValue()
     */
    private float $value = 0.0;

    /**
     * @see FloatProperty::$value
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @see FloatProperty::$value
     */
    public function setValue(float $value): FloatProperty
    {
        $this->value = $value;

        return $this;
    }
}
