<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Property;

class ObjectProperty extends AbstractProperty
{
    private ?int $value = null;

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(?int $value): ObjectProperty
    {
        $this->value = $value;

        return $this;
    }
}
