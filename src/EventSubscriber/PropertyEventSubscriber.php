<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\EventSubscriber;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\PreDeserializeEvent;

/**
 * @internal
 */
class PropertyEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            [
                'event' => 'serializer.pre_deserialize',
                'method' => 'onPreDeserialize',
                'class' => 'Tmx\\Property\\AbstractProperty',
                'format' => 'xml',
            ],
        ];
    }

    /**
     * Add the missing type property if the property is string.
     */
    public function onPreDeserialize(PreDeserializeEvent $event): void
    {
        /** @var \SimpleXMLElement $data */
        $data = $event->getData();

        $typeFound = false;
        foreach ($data->attributes() as $attribute) {
            if ('type' === $attribute->getName()) {
                $typeFound = true;
            }
        }

        if (!$typeFound) {
            $data->addAttribute('type', 'string');
        }
    }
}
