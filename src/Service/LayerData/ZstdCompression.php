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
 * Zstd compression reader.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#data Documentation
 */
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
        return 'zstd' === $layerData->getCompression();
    }
}
