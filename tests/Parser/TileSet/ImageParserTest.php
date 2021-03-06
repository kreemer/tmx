<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Tests\Parser\TileSet;

use Tmx\Image;
use Tmx\Tests\Parser\ParserTest;

class ImageParserTest extends ParserTest
{
    public function testImageFromTileSetTestNotNull(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-3'));

        // then
        self::assertCount(1, $map->getTileSets());
        self::assertNotNull($map->getTileSets()[0]->getImage());
    }

    public function testImageSourceFromTileSetTest(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-3'));

        // then
        self::assertCount(1, $map->getTileSets());
        self::assertNotNull($map->getTileSets()[0]->getImage());
        /** @var Image $image */
        $image = $map->getTileSets()[0]->getImage();
        self::assertStringEndsWith('Serene_Village_32x32.png', $image->getSource());
    }

    public function testImageWidthFromTileSetTest(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-3'));

        // then
        self::assertCount(1, $map->getTileSets());
        self::assertNotNull($map->getTileSets()[0]->getImage());
        $image = $map->getTileSets()[0]->getImage();
        self::assertEquals(608, $image->getWidth());
    }

    public function testImageHeightTileSetTest(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-3'));

        // then
        self::assertCount(1, $map->getTileSets());
        self::assertNotNull($map->getTileSets()[0]->getImage());
        $image = $map->getTileSets()[0]->getImage();
        self::assertEquals(1440, $image->getHeight());
    }
}
