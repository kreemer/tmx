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
use Tmx\WangSet;

abstract class WangSetTest extends ParserTest
{
    /**
     * @return ?array<WangSet>
     */
    protected function extractWangSet(TileSet $tileSet): ?array
    {
        if (null === $tileSet->getWangCollection()) {
            return null;
        }

        return $tileSet->getWangCollection()->getWangSets();
    }
}
