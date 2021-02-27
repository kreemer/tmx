<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

class WangTile
{
    private ?int $tileId = null;
    private ?string $wangId = null;

    private bool $hFlip = false;
    private bool $vFlip = false;
    private bool $dFlip = false;
}
