<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Tests;

use Tmx\Parser;

class TileOffsetParserTest extends TmxTest
{
    private Parser $parser;

    protected function setUp(): void
    {
        $this->parser = new Parser();
    }

    public function testTileOffsetFromExample3IsNotPresent(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-3'));

        // then
        self::assertCount(1, $map->getTileSets());
        self::assertNull($map->getTileSets()[0]->getTileOffset());
    }

    public function testTileOffsetFromBasicTileOffsetExampleIsPresent(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('tileoffset'));

        // then
        self::assertCount(1, $map->getTileSets());
        self::assertNotNull($map->getTileSets()[0]->getTileOffset());
        self::assertEquals(16, $map->getTileSets()[0]->getTileOffset()->getX());
        self::assertEquals(20, $map->getTileSets()[0]->getTileOffset()->getY());
    }
}
