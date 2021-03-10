<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Handler;

use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\XmlDeserializationVisitor;
use JMS\Serializer\XmlSerializationVisitor;

/**
 * @internal
 */
class BooleanAsIntHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods(): array
    {
        return [
            [
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'format' => 'xml',
                'type' => 'booleanAsInt',
                'method' => 'serializeBooleanToInt',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => 'booleanAsInt',
                'method' => 'deserializeIntToBoolean',
            ],
        ];
    }

    /**
     * serialize the boolean and write either '1' or '0'.
     */
    public function serializeBooleanToInt(XmlSerializationVisitor $visitor, $value, array $type, Context $context)
    {
        $data = $visitor->visitBoolean($value, $type);
        $data->data = $value ? '1' : '0';

        return $data;
    }

    /**
     * returns either true or false if the value is 1 or 0.
     */
    public function deserializeIntToBoolean(XmlDeserializationVisitor $visitor, $value, array $type, Context $context)
    {
        return $visitor->visitBoolean($value, $type);
    }
}
