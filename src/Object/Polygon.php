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

/**
 * Representation of a polygon inside a object layer.
 *
 * This class represents a polygon inside an object layer
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#polygon Documentation
 */
class Polygon extends DrawObject
{
    /**
     * A list of x,y coordinates in pixels.
     *
     * @see Polygon::getPoints()
     * @see Polygon::setPoints()
     */
    private ?string $points = null;

    /**
     * @see Polygon::$points
     */
    public function getPoints(): ?string
    {
        return $this->points;
    }

    /**
     * @return $this
     *
     * @see Polygon::$points
     */
    public function setPoints(?string $points): Polygon
    {
        $this->points = $points;

        return $this;
    }
}
