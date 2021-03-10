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

/**
 * ZLIB compression reader.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#data Documentation
 */
class ZlibCompression implements CompressionInterface
{
    public function unpackData(string $data): string
    {
        if (!function_exists('zlib_decode')) {
            throw new ReaderException('ext-zlib has to be enabled to parse zlib compression');
        }

        return zlib_decode($data);
    }

    public function isResponsible(LayerData $layerData): bool
    {
        return 'zlib' === $layerData->getCompression();
    }
}
