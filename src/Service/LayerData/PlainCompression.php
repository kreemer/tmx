<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Service\LayerData;

use Tmx\LayerData;

class PlainCompression implements CompressionInterface
{
    public function unpackData(string $data): string
    {
        return $data;
    }

    public function isResponsible(LayerData $layerData): bool
    {
        return null === $layerData->getCompression() || '' === $layerData->getCompression();
    }
}
