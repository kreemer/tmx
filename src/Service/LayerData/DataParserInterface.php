<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Service\LayerData;

use Tmx\DataInterface;
use Tmx\LayerData;

/**
 * Interface for data parsers.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#data Documentation
 */
interface DataParserInterface
{
    /**
     * Get the data as raw string.
     */
    public function getData(DataInterface $dataInterface): string;

    /**
     * After the compression algorithm decompresses the data, postCompile it.
     *
     * @return array[][]
     */
    public function postCompress(string $data, int $width = null, int $height = null): array;

    /**
     * returns true if this parser is responsible for this layerData object.
     */
    public function isResponsible(LayerData $layerData): bool;
}
