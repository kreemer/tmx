<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Property;

class StringProperty extends AbstractProperty
{
    private string $value = '';

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): StringProperty
    {
        $this->value = $value;

        return $this;
    }
}
