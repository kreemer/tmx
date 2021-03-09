<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Property;

class BoolProperty extends AbstractProperty
{
    private bool $value = false;

    public function isValue(): bool
    {
        return $this->value;
    }

    public function setValue(bool $value): BoolProperty
    {
        $this->value = $value;

        return $this;
    }
}
