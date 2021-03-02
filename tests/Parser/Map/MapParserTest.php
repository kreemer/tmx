<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Tests\Parser\Map;

use Tmx\Map;
use Tmx\Tests\Parser\ParserTest;

class MapParserTest extends ParserTest
{
    public function testVersionFromExample1IsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-1'));

        // then
        self::assertEquals(1.4, $map->getVersion());
    }

    public function testTiledVersionFromExample1IsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-1'));

        // then
        self::assertEquals('1.4.3', $map->getTiledVersion());
    }

    public function testOrientationFromExample1IsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-1'));

        // then
        self::assertEquals(Map::ORIENTATION_ORTHOGONAL, $map->getOrientation());
    }

    public function testRenderOrderFromExample1IsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-1'));

        // then
        self::assertEquals(Map::RENDER_ORDER_RIGHT_DOWN, $map->getRenderOrder());
    }

    public function testWidthFromExample1IsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-1'));

        // then
        self::assertEquals(100, $map->getWidth());
    }

    public function testHeightFromExample1IsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-1'));

        // then
        self::assertEquals(100, $map->getHeight());
    }

    public function testTileWidthFromExample1IsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-1'));

        // then
        self::assertEquals(32, $map->getTileWidth());
    }

    public function testTileHeightFromExample1IsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-1'));

        // then
        self::assertEquals(32, $map->getTileHeight());
    }

    public function testInfiniteFromExample1IsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-1'));

        // then
        self::assertEquals(false, $map->isInfiniteMap());
    }

    public function testNextLayerIdFromExample1IsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-1'));

        // then
        self::assertEquals(2, $map->getNextLayerId());
    }

    public function testNextObjectIdFromExample1IsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-1'));

        // then
        self::assertEquals(1, $map->getNextObjectId());
    }

    public function testVersionFromExample2IsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-2'));

        // then
        self::assertEquals(1.4, $map->getVersion());
    }

    public function testTiledVersionFromExample2IsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-2'));

        // then
        self::assertEquals('1.4.2', $map->getTiledVersion());
    }

    public function testOrientationFromExample2IsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-2'));

        // then
        self::assertEquals(Map::ORIENTATION_ORTHOGONAL, $map->getOrientation());
    }

    public function testRenderOrderFromExample2IsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-2'));

        // then
        self::assertEquals(Map::RENDER_ORDER_RIGHT_UP, $map->getRenderOrder());
    }

    public function testWidthFromExample2IsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-2'));

        // then
        self::assertEquals(400, $map->getWidth());
    }

    public function testHeightFromExample2IsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-2'));

        // then
        self::assertEquals(200, $map->getHeight());
    }

    public function testTileWidthFromExample2IsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-2'));

        // then
        self::assertEquals(16, $map->getTileWidth());
    }

    public function testTileHeightFromExample2IsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-2'));

        // then
        self::assertEquals(16, $map->getTileHeight());
    }

    public function testInfiniteFromExample2IsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-2'));

        // then
        self::assertEquals(false, $map->isInfiniteMap());
    }

    public function testNextLayerIdFromExample2IsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-2'));

        // then
        self::assertEquals(2, $map->getNextLayerId());
    }

    public function testNextObjectIdFromExample2IsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-2'));

        // then
        self::assertEquals(1, $map->getNextObjectId());
    }

    public function testBackgroundColorIsNullWhenNotSet(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-2'));

        // then
        self::assertNull($map->getBackgroundColor());
    }

    public function testBackgroundColorIsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('background'));

        // then
        self::assertNotNull($map->getBackgroundColor());
        self::assertEquals('#849600', $map->getBackgroundColor());
    }
}
