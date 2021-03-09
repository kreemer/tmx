<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Property;

class FloatProperty extends AbstractProperty
{
    private float $value = 0.0;

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): FloatProperty
    {
        $this->value = $value;

        return $this;
    }
}
