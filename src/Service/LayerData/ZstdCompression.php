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
use Tmx\Service\ReaderException;

class ZstdCompression implements CompressionInterface
{
    public function unpackData(string $data): string
    {
        if (!function_exists('zstd_uncompress')) {
            throw new ReaderException('ext-zstd has to be enabled to parse zstd compression');
        }

        return zstd_uncompress($data);
    }

    public function isResponsible(LayerData $layerData): bool
    {
        return $layerData->getCompression() === 'zstd';
    }

}