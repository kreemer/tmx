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
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\XmlFileLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Tmx\Map;
use Tmx\Normalizer\TileNormalizer;
use Tmx\TileSet;

class Parser
{
    private ClassMetadataFactory $classMetadataFactory;
    private MetadataAwareNameConverter $metadataAwareNameConverter;
    private Serializer $serializer;

    /**
     * Parser constructor.
     */
    public function __construct()
    {
        $projectRootPath = ComposerLocator::getRootPath();
        $configFile = $projectRootPath . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'parserDefinition.xml';
        $this->classMetadataFactory = new ClassMetadataFactory(new XmlFileLoader($configFile));
        $this->metadataAwareNameConverter = new MetadataAwareNameConverter($this->classMetadataFactory);

        $normalizer = new ObjectNormalizer($this->classMetadataFactory, $this->metadataAwareNameConverter, null, new ReflectionExtractor());

        $tileNormalizer = new TileNormalizer();

        $this->serializer = new Serializer(
            [$tileNormalizer, $normalizer, new ArrayDenormalizer()],
            ['xml' => new XmlEncoder()]
        );
    }

    public function parse(string $file): Map
    {
        $directory = dirname($file);
        $fileContents = file_get_contents($file);

        /** @var Map $map */
        $map = $this->serializer->deserialize($fileContents, Map::class, 'xml', [
            ObjectNormalizer::DISABLE_TYPE_ENFORCEMENT => true,
            'groups' => 'tmx'
        ]);

        foreach ($map->getTileSets() as $tileSet) {
            $this->parseTileSet($directory . DIRECTORY_SEPARATOR . $tileSet->getSource(), $tileSet);
        }

        return $map;
    }

    public function parseTileSet(string $file, TileSet $tileSet = null): TileSet
    {
        $directory = dirname($file);
        $fileContents = file_get_contents($file);

        if (null !== $tileSet) {
            $tileSet = $this->serializer->deserialize($fileContents, TileSet::class, 'xml', [
                AbstractNormalizer::OBJECT_TO_POPULATE => $tileSet,
                'groups' => 'tmx'
            ]);

            $tileSet->setSource(realpath($directory . DIRECTORY_SEPARATOR . $tileSet->getSource()));
            $tileSet->getImage()->setSource(realpath($directory . DIRECTORY_SEPARATOR . $tileSet->getImage()->getSource()));

            return $tileSet;
        }

        $tileSet = $this->serializer->deserialize($fileContents, TileSet::class, 'xml', [
            ObjectNormalizer::DISABLE_TYPE_ENFORCEMENT => true,
            'groups' => 'tmx'
        ]);

        $tileSet->setSource(realpath($directory . DIRECTORY_SEPARATOR . $file));
        $tileSet->getImage()->setSource(realpath($directory . DIRECTORY_SEPARATOR . $tileSet->getImage()->getSource()));

        return $tileSet;
    }
}
