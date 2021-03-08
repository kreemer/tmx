<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Tests\Parser;

use Tmx\Service\LayerData\Base64DataParser;
use Tmx\Service\LayerData\CsvDataParser;
use Tmx\Service\LayerData\PlainCompression;
use Tmx\Service\LayerData\ZlibCompression;
use Tmx\Service\LayerData\ZstdCompression;
use Tmx\Service\LayerDataReader;
use Tmx\Service\Parser;
use Tmx\Tests\TmxTest;

abstract class ParserTest extends TmxTest
{
    protected Parser $parser;
    protected LayerDataReader $layerDataReader;

    protected function setUp(): void
    {
        $this->parser = new Parser();
        $this->layerDataReader = new LayerDataReader(
            [new CsvDataParser(), new Base64DataParser()],
            [new PlainCompression(), new ZlibCompression(), new ZstdCompression()]
        );
    }
}
