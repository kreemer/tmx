<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Service;

use ComposerLocator;
use JMS\Serializer\EventDispatcher\EventDispatcher;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use Tmx\EventSubscriber\LayerEventSubscriber;
use Tmx\EventSubscriber\MapEventSubscriber;
use Tmx\EventSubscriber\TileEventSubscriber;
use Tmx\EventSubscriber\TileSetEventSubscriber;
use Tmx\Map;

class Writer
{
    /**
     * @var \JMS\Serializer\Serializer
     */
    private $serializer;

    /**
     * Parser constructor.
     */
    public function __construct()
    {
        $projectRootPath = ComposerLocator::getRootPath();
        $configDir = $projectRootPath . DIRECTORY_SEPARATOR . 'config';
        $this->serializer = SerializerBuilder::create()
            ->addMetadataDir($configDir)
            ->configureListeners(function (EventDispatcher $dispatcher) {
                $dispatcher->addSubscriber(new MapEventSubscriber());
                $dispatcher->addSubscriber(new LayerEventSubscriber());
                $dispatcher->addSubscriber(new TileSetEventSubscriber());
                $dispatcher->addSubscriber(new TileEventSubscriber());
            })
            ->setSerializationContextFactory(function () {
                return SerializationContext::create();
            })
            ->build();
    }

    public function write(Map $map, string $filename): void
    {
        $xml = $this->serializer->serialize($map, 'xml');
        file_put_contents($filename, $xml);
    }
}