<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Tests\Parser;

use Tmx\Parser;
use Tmx\Tests\TmxTest;

abstract class ParserTest extends TmxTest
{
    protected Parser $parser;

    protected function setUp(): void
    {
        $this->parser = new Parser();
    }
}
