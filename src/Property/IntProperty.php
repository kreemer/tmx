<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Property;

class IntProperty extends AbstractProperty
{
    private int $value = 0;

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): IntProperty
    {
        $this->value = $value;

        return $this;
    }
}
