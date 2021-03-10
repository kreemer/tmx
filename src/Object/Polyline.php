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
 * Representation of a polyline inside a object layer.
 *
 * This class represents a polyline inside an object layer
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#polyline Documentation
 */
class Polyline extends DrawObject
{
    /**
     * A list of x,y coordinates in pixels.
     *
     * @see Polyline::getPoints()
     * @see Polyline::setPoints()
     */
    private ?string $points = null;

    /**
     * @see Polyline::$points
     */
    public function getPoints(): ?string
    {
        return $this->points;
    }

    /**
     * @return $this
     *
     * @see Polyline::$points
     */
    public function setPoints(?string $points): Polyline
    {
        $this->points = $points;

        return $this;
    }
}
