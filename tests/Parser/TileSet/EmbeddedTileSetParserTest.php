<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Tests\Parser\TileSet;

use Tmx\Tests\Parser\ParserTest;
use Tmx\TileSet;

class EmbeddedTileSetParserTest extends ParserTest
{
    public function testTileSetFromEmbeddedCanBeRead(): TileSet
    {
        // when
        $map = $this->parser->parse($this->getMapPath('embedded-tileset'));

        // then
        self::assertCount(1, $map->getTileSets());

        return $map->getTileSets()[0];
    }

    /**
     * @depends testTileSetFromEmbeddedCanBeRead
     */
    public function testTileSetFromEmbeddedHasNoSource(TileSet $tileSet): void
    {
        // then
        self::assertNull($tileSet->getSource());
    }

    /**
     * @depends testTileSetFromEmbeddedCanBeRead
     */
    public function testTileSetImagePathWillBeUpdatedToRealpath(TileSet $tileSet): void
    {
        // then
        self::assertSame(realpath($this->getResourceFolder() . '_tileSet/Serene_Village_32x32.png'), $tileSet->getImage()->getSource());
    }
}
