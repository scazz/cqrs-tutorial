<?php


namespace App\CQRS\Serializer;


class EventSerializer {

	public function serialize( SerializableEvent $event ) {
		return array(
			'class'   => get_class($event),
			'payload' => $event->serialize()
		);
	}
} 