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
 * Bool type property.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#property Documentation
 */
class BoolProperty extends AbstractProperty
{
    /**
     * The value of the property.
     *
     * @see BoolProperty::isValue()
     * @see BoolProperty::setValue()
     */
    private bool $value = false;

    /**
     * @see BoolProperty::$value
     */
    public function isValue(): bool
    {
        return $this->value;
    }

    /**
     * @see BoolProperty::$value
     */
    public function setValue(bool $value): BoolProperty
    {
        $this->value = $value;

        return $this;
    }
}
