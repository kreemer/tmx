<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Tests;

use PHPUnit\Framework\TestCase;
use Tmx\Parser;

abstract class TmxTest extends TestCase
{
    protected Parser $parser;

    protected function setUp(): void
    {
        $this->parser = new Parser();
    }

    protected function getMapPath(string $name): string
    {
        return $this->getResourceFolder() . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR . $name . '.tmx';
    }

    protected function getImgPath(string $name): string
    {
        return $this->getResourceFolder() . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR . $name . '.png';
    }

    protected function getResourceFolder(): string
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR;
    }
}
