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

class LayerParserTest extends TestCase
{
    private Parser $parser;
    private string $resourceFolder = __DIR__.'/../resources';

    protected function setUp(): void
    {
        $this->parser = new Parser();
    }

    public function testSimpleEmptyLayerExists(): void
    {
        // when
        $map = $this->parser->parse($this->resourceFolder.'/example1.tmx');

        // then
        self::assertEquals(1, count($map->getLayers()));
    }

    public function testIdOfLayer(): void
    {
        // when
        $map = $this->parser->parse($this->resourceFolder.'/example1.tmx');

        // then
        self::assertEquals(1, count($map->getLayers()));

        /** @var Layer $layer */
        $layer = $map->getLayers()[0];
        self::assertEquals(1, $layer->getId());
    }

    public function testNameOfLayer(): void
    {
        // when
        $map = $this->parser->parse($this->resourceFolder.'/example1.tmx');

        // then
        self::assertEquals(1, count($map->getLayers()));

        /** @var Layer $layer */
        $layer = $map->getLayers()[0];
        self::assertEquals('Tile Layer 1', $layer->getName());
    }

    public function testWidthOfLayer(): void
    {
        // when
        $map = $this->parser->parse($this->resourceFolder.'/example1.tmx');

        // then
        self::assertEquals(1, count($map->getLayers()));

        /** @var Layer $layer */
        $layer = $map->getLayers()[0];
        self::assertEquals(100, $layer->getWidth());
    }

    public function testHeightOfLayer(): void
    {
        // when
        $map = $this->parser->parse($this->resourceFolder.'/example1.tmx');

        // then
        self::assertEquals(1, count($map->getLayers()));

        /** @var Layer $layer */
        $layer = $map->getLayers()[0];
        self::assertEquals(100, $layer->getHeight());
    }
}
