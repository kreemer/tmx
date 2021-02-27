<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Tests;

use Tmx\Animation;

class AnimationParserTest extends TmxTest
{
    public function testAnimationIsNullIfNotPresent(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('tile-terrain'));

        // then
        self::assertCount(1, $map->getTileSets());
        self::assertNotCount(0, $map->getTileSets()[0]->getTiles());
        foreach ($map->getTileSets()[0]->getTiles() as $tile) {
            self::assertNull($tile->getAnimation());
        }
    }

    public function testAnimationIsParsed(): Animation
    {
        // when
        $map = $this->parser->parse($this->getMapPath('animation'));

        // then
        self::assertCount(1, $map->getTileSets());
        self::assertNotCount(0, $map->getTileSets()[0]->getTiles());
        self::assertCount(1, $map->getTileSets()[0]->getTiles());
        self::assertNotNull($map->getTileSets()[0]->getTiles()[0]->getAnimation());

        return $map->getTileSets()[0]->getTiles()[0]->getAnimation();
    }

    /**
     * @depends testAnimationIsParsed
     */
    public function testAnimationContainsFrames(Animation $animation): Animation
    {
        // then
        self::assertCount(4, $animation->getFrames());

        return $animation;
    }

    /**
     * @depends testAnimationIsParsed
     */
    public function testAnimationFrame1HasTileIdAndDuration(Animation $animation): void
    {
        // when
        $frame = $animation->getFrames()[0];

        // then
        self::assertSame(0, $frame->getTileId());
        self::assertSame(800, $frame->getDuration());
    }

    /**
     * @depends testAnimationIsParsed
     */
    public function testAnimationFrame2HasTileIdAndDuration(Animation $animation): void
    {
        // when
        $frame = $animation->getFrames()[1];

        // then
        self::assertSame(1, $frame->getTileId());
        self::assertSame(300, $frame->getDuration());
    }

    /**
     * @depends testAnimationIsParsed
     */
    public function testAnimationFrame3HasTileIdAndDuration(Animation $animation): void
    {
        // when
        $frame = $animation->getFrames()[2];

        // then
        self::assertSame(2, $frame->getTileId());
        self::assertSame(300, $frame->getDuration());
    }

    /**
     * @depends testAnimationIsParsed
     */
    public function testAnimationFrame4HasTileIdAndDuration(Animation $animation): void
    {
        // when
        $frame = $animation->getFrames()[3];

        // then
        self::assertSame(3, $frame->getTileId());
        self::assertSame(500, $frame->getDuration());
    }
}
