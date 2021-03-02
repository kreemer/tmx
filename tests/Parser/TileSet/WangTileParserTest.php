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

class WangTileParserTest extends WangSetTest
{
    public function testNoWangSetIfThereIsNone(): void
    {
        // when
        $tileSet = $this->parser->parseTileSet($this->getTileSetPath('map-3'));

        // then
        self::assertNull($this->extractWangSet($tileSet));
    }

    public function testWangSetHasCorrectAmount(): array
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
    public function testWangTileIsNotNull(array $wangSet): array
    {
        // then
        self::assertNotNull($wangSet[0]->getWangTiles());
        self::assertNotNull($wangSet[1]->getWangTiles());
        self::assertNotNull($wangSet[2]->getWangTiles());

        return $wangSet;
    }

    /**
     * @param array<WangSet> $wangSet
     * @depends testWangTileIsNotNull
     */
    public function testWangTileHasCorrectAmount(array $wangSet): array
    {
        // then
        self::assertCount(7, $wangSet[0]->getWangTiles());

        return $wangSet;
    }

    /**
     * @param array<WangSet> $wangSet
     * @depends testWangTileHasCorrectAmount
     */
    public function testWangTileHasCorrectTileId(?array $wangSet): void
    {
        // then
        self::assertEquals('121', $wangSet[0]->getWangTiles()[0]->getTileId());
        self::assertEquals('122', $wangSet[0]->getWangTiles()[1]->getTileId());
        self::assertEquals('123', $wangSet[0]->getWangTiles()[2]->getTileId());
        self::assertEquals('141', $wangSet[0]->getWangTiles()[3]->getTileId());
        self::assertEquals('142', $wangSet[0]->getWangTiles()[4]->getTileId());
        self::assertEquals('160', $wangSet[0]->getWangTiles()[5]->getTileId());
        self::assertEquals('161', $wangSet[0]->getWangTiles()[6]->getTileId());
    }

    /**
     * @param array<WangSet> $wangSet
     * @depends testWangTileHasCorrectAmount
     */
    public function testWangTileHasCorrectWangId(?array $wangSet): void
    {
        // then
        self::assertEquals('0x2030102', $wangSet[0]->getWangTiles()[0]->getWangId());
        self::assertEquals('0x1010101', $wangSet[0]->getWangTiles()[1]->getWangId());
        self::assertEquals('0x1010102', $wangSet[0]->getWangTiles()[2]->getWangId());
        self::assertEquals('0x1010103', $wangSet[0]->getWangTiles()[3]->getWangId());
        self::assertEquals('0x1010201', $wangSet[0]->getWangTiles()[4]->getWangId());
        self::assertEquals('0x1030302', $wangSet[0]->getWangTiles()[5]->getWangId());
        self::assertEquals('0x1020301', $wangSet[0]->getWangTiles()[6]->getWangId());
    }
}
