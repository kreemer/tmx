<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

use PHPUnit\Framework\TestCase;

class ImageParserTest extends TestCase
{
    private Parser $parser;
    private string $resourceFolder = __DIR__.'/../resources';

    protected function setUp(): void
    {
        $this->parser = new Parser();
    }

    public function testImageFromTileSetTestNotNull(): void
    {
        // when
        $map = $this->parser->parse($this->resourceFolder.'/example3.tmx');

        // then
        self::assertEquals(1, count($map->getTileSets()));
        self::assertNotNull($map->getTileSets()[0]->getImage());
    }

    public function testImageSourceFromTileSetTest(): void
    {
        // when
        $map = $this->parser->parse($this->resourceFolder.'/example3.tmx');

        // then
        self::assertEquals(1, count($map->getTileSets()));
        self::assertNotNull($map->getTileSets()[0]->getImage());
        /** @var Image $image */
        $image = $map->getTileSets()[0]->getImage();
        self::assertEquals('Serene_Village_32x32.png', $image->getSource());
    }

    public function testImageWidthFromTileSetTest(): void
    {
        // when
        $map = $this->parser->parse($this->resourceFolder.'/example3.tmx');

        // then
        self::assertEquals(1, count($map->getTileSets()));
        self::assertNotNull($map->getTileSets()[0]->getImage());
        /** @var Image $image */
        $image = $map->getTileSets()[0]->getImage();
        self::assertEquals(608, $image->getWidth());
    }

    public function testImageHeightTileSetTest(): void
    {
        // when
        $map = $this->parser->parse($this->resourceFolder.'/example3.tmx');

        // then
        self::assertEquals(1, count($map->getTileSets()));
        self::assertNotNull($map->getTileSets()[0]->getImage());
        /** @var Image $image */
        $image = $map->getTileSets()[0]->getImage();
        self::assertEquals(1440, $image->getHeight());
    }
}
