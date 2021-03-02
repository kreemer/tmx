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

interface DataParserInterface
{
    public function getData(DataInterface $dataInterface): string;
    public function postCompress(string $data, int $width = null, int $height = null): array;
    public function isResponsible(LayerData $layerData): bool;
}