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
 * Int type property.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#property Documentation
 */
class IntProperty extends AbstractProperty
{
    /**
     * The value of the property.
     *
     * @see IntProperty::getValue()
     * @see IntProperty::setValue()
     */
    private int $value = 0;

    /**
     * @see IntProperty::$value
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @see IntProperty::$value
     */
    public function setValue(int $value): IntProperty
    {
        $this->value = $value;

        return $this;
    }
}
