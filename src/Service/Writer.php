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

class Writer
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

    public function write(Map $map, string $filename): void
    {
        $xml = $this->serializer->serialize($map, 'xml', [
            'xml_format_output' => true,
            'xml_encoding' => 'utf-8',
            'xml_root_node_name' => 'map',
            'groups' => 'tmx'
        ]);
        file_put_contents($filename, $xml);
    }
}
