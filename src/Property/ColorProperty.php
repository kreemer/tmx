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
 * Color type property.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#property Documentation
 */
class ColorProperty extends AbstractProperty
{
    /**
     * The value of the property.
     *
     * @see ColorProperty::getValue()
     * @see ColorProperty::setValue()
     */
    private string $value = '#00000000';

    /**
     * @see ColorProperty::$value
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @see ColorProperty::$value
     */
    public function setValue(string $value): ColorProperty
    {
        $this->value = $value;

        return $this;
    }
}
