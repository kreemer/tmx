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
 * File type property.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#property Documentation
 */
class FileProperty extends AbstractProperty
{
    /**
     * The value of the property.
     *
     * @see FileProperty::getValue()
     * @see FileProperty::setValue()
     */
    private string $value = '.';

    /**
     * @see FileProperty::$value
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @see FileProperty::$value
     */
    public function setValue(string $value): FileProperty
    {
        $this->value = $value;

        return $this;
    }
}
