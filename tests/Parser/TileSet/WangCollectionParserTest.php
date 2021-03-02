<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Tests\Parser\TileSet;

use Tmx\WangCollection;

class WangCollectionParserTest extends WangSetTest
{
    public function testReturnsNullIfNoWangSetCollection(): void
    {
        // when
        $tileSet = $this->parser->parseTileSet($this->getTileSetPath('map-3'));

        // then
        self::assertNotNull($tileSet);
        self::assertNull($tileSet->getWangCollection());
    }

    public function testReturnsNotNullIfNoWangSetCollection(): WangCollection
    {
        // when
        $tileSet = $this->parser->parseTileSet($this->getTileSetPath('wangSet'));

        // then
        self::assertNotNull($tileSet);
        self::assertNotNull($tileSet->getWangCollection());

        return $tileSet->getWangCollection();
    }

    /**
     * @depends testReturnsNotNullIfNoWangSetCollection
     */
    public function testWangCollectionContainsCorrectAmountOfWangSet(WangCollection $wangCollection): void
    {
        // then
        self::assertCount(3, $wangCollection->getWangSets());
    }
}
