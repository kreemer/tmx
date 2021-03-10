<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

/**
 * Representation of a frame.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#frame Documentation
 */
class Frame
{
    /**
     * The local ID of a tile within the parent {@see TileSet}.
     *
     * @see Frame::getTileId()
     * @see Frame::setTileId()
     */
    private ?int $tileId = null;

    /**
     * How long (in milliseconds) this frame should be displayed before advancing to the next frame.
     *
     * @see Frame::getDuration()
     * @see Frame::setDuration()
     */
    private ?int $duration = null;

    public function getTileId(): ?int
    {
        return $this->tileId;
    }

    public function setTileId(?int $tileId): Frame
    {
        $this->tileId = $tileId;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): Frame
    {
        $this->duration = $duration;

        return $this;
    }
}
