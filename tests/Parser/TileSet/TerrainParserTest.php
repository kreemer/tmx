<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Tests\Parser\TileSet;

use Tmx\Terrain;
use Tmx\Tests\Parser\ParserTest;

class TerrainParserTest extends ParserTest
{
    public function testTerrainFromExample3IsNotPresent(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-3'));

        // then
        self::assertCount(1, $map->getTileSets());
        self::assertNull($map->getTileSets()[0]->getTerrainCollection());
    }

    /**
     * @return array<Terrain>
     */
    public function testParseBasicTerrainInformation(): array
    {
        // when
        $map = $this->parser->parse($this->getMapPath('terrain'));

        // then
        self::assertCount(1, $map->getTileSets());
        self::assertNotNull($map->getTileSets()[0]->getTerrainCollection());
        self::assertCount(2, $map->getTileSets()[0]->getTerrainCollection()->getTerrains());

        return $map->getTileSets()[0]->getTerrainCollection()->getTerrains();
    }

    /**
     * @depends testParseBasicTerrainInformation
     *
     * @param array<Terrain> $terrains
     */
    public function testParseBasicTerrainInformationName(array $terrains): void
    {
        // then
        self::assertEquals('Gras', $terrains[0]->getName());
        self::assertEquals('Sand', $terrains[1]->getName());
    }

    /**
     * @depends testParseBasicTerrainInformation
     *
     * @param array<Terrain> $terrains
     */
    public function testParseBasicTerrainInformationFrontTile(array $terrains): void
    {
        // then
        self::assertIsNumeric($terrains[0]->getTile());
        self::assertIsNumeric($terrains[1]->getTile());
    }
}
