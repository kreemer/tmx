<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Object;

use Tmx\DrawObject;

class Polygon extends DrawObject
{
    private ?string $points = null;

    public function getPoints(): ?string
    {
        return $this->points;
    }

    public function setPoints(?string $points): Polygon
    {
        $this->points = $points;

        return $this;
    }
}
