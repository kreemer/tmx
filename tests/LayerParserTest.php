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

class LayerParserTest extends TmxTest
{
    private Parser $parser;

    protected function setUp(): void
    {
        $this->parser = new Parser();
    }

    public function testSimpleEmptyLayerExists(): void
    {
        // when
        $map = $this->parser->parse($this->getResourceFolder() . 'example1.tmx');

        // then
        self::assertCount(1, $map->getLayers());
    }

    public function testIdOfLayer(): void
    {
        // when
        $map = $this->parser->parse($this->getResourceFolder() . 'example1.tmx');

        // then
        self::assertCount(1, $map->getLayers());

        $layer = $map->getLayers()[0];
        self::assertEquals(1, $layer->getId());
    }

    public function testNameOfLayer(): void
    {
        // when
        $map = $this->parser->parse($this->getResourceFolder() . 'example1.tmx');

        // then
        self::assertCount(1, $map->getLayers());

        $layer = $map->getLayers()[0];
        self::assertEquals('Tile Layer 1', $layer->getName());
    }

    public function testWidthOfLayer(): void
    {
        // when
        $map = $this->parser->parse($this->getResourceFolder() . 'example1.tmx');

        // then
        self::assertCount(1, $map->getLayers());

        $layer = $map->getLayers()[0];
        self::assertEquals(100, $layer->getWidth());
    }

    public function testHeightOfLayer(): void
    {
        // when
        $map = $this->parser->parse($this->getResourceFolder() . 'example1.tmx');

        // then
        self::assertCount(1, $map->getLayers());

        $layer = $map->getLayers()[0];
        self::assertEquals(100, $layer->getHeight());
    }
}