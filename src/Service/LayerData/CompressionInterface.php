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

/**
 * Interface for data compression readers.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#data Documentation
 */
interface CompressionInterface
{
    /**
     * Unpack the compressed data and return it as string.
     */
    public function unpackData(string $data): string;

    /**
     * returns true if this compression reader is responsible for this layerData object.
     */
    public function isResponsible(LayerData $layerData): bool;
}
