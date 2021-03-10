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
 * Representation of an animation.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#animation Documentation
 */
class Animation
{
    /**
     * All frames within this animation.
     *
     * @var Frame[]
     *
     * @see Animation::getFrames()
     * @see Animation::addFrame()
     * @see Animation::removeFrame()
     */
    private array $frames = [];

    /**
     * @return Frame[]
     */
    public function getFrames(): array
    {
        return $this->frames;
    }

    public function addFrame(Frame $frame): self
    {
        $this->frames[] = $frame;

        return $this;
    }

    public function removeFrame(Frame $frame): self
    {
        if (in_array($frame, $this->frames)) {
            $this->frames = array_diff($this->frames, [$frame]);
        }

        return $this;
    }
}
