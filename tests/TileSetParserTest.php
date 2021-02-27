<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Tests;

class TileSetParserTest extends TmxTest
{
    public function testTileSetFromExample1IsNotPresent(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-1'));

        // then
        self::assertCount(0, $map->getTileSets());
    }

    public function testFirstGidFromExample3IsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-3'));

        // then
        self::assertCount(1, $map->getTileSets());
        self::assertEquals(1, $map->getTileSets()[0]->getFirstGid());
    }

    public function testSourceFromExample3ReferencesCorrectTileSetFile(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-3'));

        // then
        self::assertCount(1, $map->getTileSets());
        self::assertStringEndsWith('map-3.tsx', $map->getTileSets()[0]->getSource());
    }

    public function testTileSetWillBeLoadedFromSource(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-3'));

        // then
        self::assertCount(1, $map->getTileSets());
        self::assertEquals('Serene', $map->getTileSets()[0]->getName());
    }

    public function testTileWidthWillBeLoaded(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-3'));

        // then
        self::assertCount(1, $map->getTileSets());
        self::assertEquals(32, $map->getTileSets()[0]->getTileWidth());
    }

    public function testTileHeightWillBeLoaded(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-3'));

        // then
        self::assertCount(1, $map->getTileSets());
        self::assertEquals(32, $map->getTileSets()[0]->getTileHeight());
    }

    public function testTileCountWillBeLoaded(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-3'));

        // then
        self::assertCount(1, $map->getTileSets());
        self::assertEquals(855, $map->getTileSets()[0]->getTileCount());
    }

    public function testColumnWillBeLoaded(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-3'));

        // then
        self::assertCount(1, $map->getTileSets());
        self::assertEquals(19, $map->getTileSets()[0]->getColumns());
    }
}
