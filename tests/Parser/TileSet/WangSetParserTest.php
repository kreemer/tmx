<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Tests\Parser\TileSet;

use Tmx\WangSet;

class WangSetParserTest extends WangSetTest
{
    public function testNoWangSetIfThereIsNone(): void
    {
        // when
        $tileSet = $this->parser->parseTileSet($this->getTileSetPath('map-3'));

        // then
        self::assertNull($this->extractWangSet($tileSet));
    }

    public function testWangSetHasCorrectAmount(): ?array
    {
        // when
        $tileSet = $this->parser->parseTileSet($this->getTileSetPath('wangSet'));

        // then
        self::assertCount(3, $this->extractWangSet($tileSet));

        return $this->extractWangSet($tileSet);
    }

    /**
     * @param array<WangSet> $wangSet
     * @depends testWangSetHasCorrectAmount
     */
    public function testWangSetHasCorrectNameAndId(?array $wangSet): void
    {
        // then
        self::assertEquals('TestWangSet1', $wangSet[0]->getName());
        self::assertSame(1, $wangSet[0]->getTileId());

        self::assertEquals('TestWangSet2', $wangSet[1]->getName());
        self::assertSame(-1, $wangSet[1]->getTileId());

        self::assertEquals('TestWangSet3', $wangSet[2]->getName());
        self::assertSame(-1, $wangSet[2]->getTileId());
    }
}
