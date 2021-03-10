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
 * String type property.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#property Documentation
 */
class StringProperty extends AbstractProperty
{
    /**
     * The value of the property.
     *
     * @see StringProperty::getValue()
     * @see StringProperty::setValue()
     */
    private string $value = '';

    /**
     * @see StringProperty::$value
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @see StringProperty::$value
     */
    public function setValue(string $value): StringProperty
    {
        $this->value = $value;

        return $this;
    }
}
