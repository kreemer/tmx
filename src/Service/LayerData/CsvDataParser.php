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
use Tmx\Layer;
use Tmx\LayerData;

class CsvDataParser implements DataParserInterface
{
    public function getData(DataInterface $dataInterface): string
    {
        return $dataInterface->getData();
    }

    public function postCompress(string $data, int $width = null, int $height = null): array
    {
        $returnArray = [];
        $lines = explode(PHP_EOL, $data);
        foreach ($lines as $key => $line) {
            if (empty($line)) {
                continue;
            }
            $lineData = preg_split('@,@', $line, 0, PREG_SPLIT_NO_EMPTY);
            $returnArray[] = $lineData;
        }

        return $returnArray;
    }

    public function isResponsible(LayerData $layerData): bool
    {
        return $layerData->getEncoding() === 'csv';
    }

}