<?php


namespace App\CQRS\Serializer;


class EventSerializer {

	public function serialize( SerializableEvent $event ) {
		return array(
			'class'   => get_class($event),
			'payload' => $event->serialize()
		);
	}

	public function deserialize( $serializedEvent ) {
		$eventClass = $serializedEvent->class;
		$eventPayload = $serializedEvent->payload;

		return $eventClass::deserialize($eventPayload);
	}
} 