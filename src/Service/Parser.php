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
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\EventDispatcher\EventDispatcher;
use JMS\Serializer\Expression\ExpressionEvaluator;
use JMS\Serializer\Handler\HandlerRegistry;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Tmx\EventSubscriber\DrawObjectSubscriber;
use Tmx\EventSubscriber\LayerEventSubscriber;
use Tmx\EventSubscriber\MapEventSubscriber;
use Tmx\EventSubscriber\PropertyEventSubscriber;
use Tmx\EventSubscriber\TileEventSubscriber;
use Tmx\EventSubscriber\TileSetEventSubscriber;
use Tmx\Handler\BooleanAsIntHandler;
use Tmx\Map;
use Tmx\TileSet;

/**
 * Service class for parsing tmx files.
 *
 * The parser deserialize the tmx file into an object graph
 */
class Parser
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * Parser constructor.
     */
    public function __construct()
    {
        $projectRootPath = ComposerLocator::getPath('kreemer/tmx');
        $configDir = $projectRootPath . DIRECTORY_SEPARATOR . 'config';
        $this->serializer = SerializerBuilder::create()
            ->addMetadataDir($configDir)
            ->configureListeners(function (EventDispatcher $dispatcher) {
                $dispatcher->addSubscriber(new MapEventSubscriber());
                $dispatcher->addSubscriber(new LayerEventSubscriber());
                $dispatcher->addSubscriber(new TileSetEventSubscriber());
                $dispatcher->addSubscriber(new TileEventSubscriber());
                $dispatcher->addSubscriber(new DrawObjectSubscriber());
                $dispatcher->addSubscriber(new PropertyEventSubscriber());
            })
            ->setSerializationContextFactory(function () {
                return SerializationContext::create();
            })
            ->addDefaultHandlers()
            ->configureHandlers(function (HandlerRegistry $registry) {
                $registry->registerSubscribingHandler(new BooleanAsIntHandler());
            })
            ->setExpressionEvaluator(new ExpressionEvaluator(new ExpressionLanguage()))
            ->build();
    }

    /**
     * Parses a file and returns the map object representation.
     *
     * @param string $file Path to the tmx file
     */
    public function parse(string $file): Map
    {
        $directory = dirname($file);
        $fileContents = file_get_contents($file);

        /** @var Map $map */
        $map = $this->serializer->deserialize($fileContents, Map::class, 'xml');

        $refreshTileSet = [];
        foreach ($map->getTileSets() as $tileSet) {
            if (null === $tileSet->getSource()) {
                if (null !== $tileSet->getImage() && null !== $tileSet->getImage()->getSource()) {
                    $tileSet->getImage()->setSource(realpath($directory . DIRECTORY_SEPARATOR . $tileSet->getImage()->getSource()));
                }
                $refreshTileSet[] = $tileSet;
                continue;
            }
            $refreshTileSet[] = $this->parseTileSet($directory . DIRECTORY_SEPARATOR . $tileSet->getSource(), $tileSet);
        }
        $map->setTileSets($refreshTileSet);

        foreach ($map->getImageLayers() as $imageLayer) {
            if (null === $imageLayer->getImage()) {
                continue;
            }
            $imageLayer->getImage()->setSource(realpath($directory . DIRECTORY_SEPARATOR . $imageLayer->getImage()->getSource()));
        }

        return $map;
    }

    /**
     * Parses a tileSet file (tsx) and returns the corresponding element.
     *
     * @param string       $file    the path to the tile set file
     * @param TileSet|null $tileSet TileSet object which will be populated. if null, a new tileset object will be made
     */
    public function parseTileSet(string $file, TileSet $tileSet = null): TileSet
    {
        $directory = dirname($file);
        $fileContents = file_get_contents($file);

        if (null !== $tileSet) {
            $tileSet = $this->serializer->deserialize($fileContents, TileSet::class, 'xml', DeserializationContext::create()->setAttribute('tileSet', $tileSet));
            $tileSet->setSource(realpath($directory . DIRECTORY_SEPARATOR . $tileSet->getSource()));
            $tileSet->getImage()->setSource(realpath($directory . DIRECTORY_SEPARATOR . $tileSet->getImage()->getSource()));

            return $tileSet;
        }
        $tileSet = $this->serializer->deserialize($fileContents, TileSet::class, 'xml');
        $tileSet->setSource(realpath($directory . DIRECTORY_SEPARATOR . $file));
        $tileSet->getImage()->setSource(realpath($directory . DIRECTORY_SEPARATOR . $tileSet->getImage()->getSource()));

        return $tileSet;
    }
}
