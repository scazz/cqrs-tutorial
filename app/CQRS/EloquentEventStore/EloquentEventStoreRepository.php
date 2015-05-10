<?php
namespace App\CQRS\EloquentEventStore;

use App\CQRS\DomainEventMessage;
use App\CQRS\Serializer\EventSerializer;
use App\CQRS\Serializer\SerializableEvent;
use DateTime;

final class EloquentEventStoreRepository {

	private $eventSerializer;


	public function __construct(EventSerializer $serializer) {
		$this->eventSerializer = $serializer;
	}

	public function append($uuid, SerializableEvent $event, DateTime $recordedAt) {

		$eventStoreMessage = new EloquentEventStoreModel();
		$eventStoreMessage->uuid = $uuid;
		$eventStoreMessage->event_payload = json_encode( $this->eventSerializer->serialize($event) );
		$eventStoreMessage->recorded_at = $recordedAt;
		$eventStoreMessage->save();

	}

	public function load($uuid) {
		$eventMessages = EloquentEventStoreModel::where('uuid', $uuid)->get();
		$events = [];

		foreach($eventMessages as $eventMessage) {
			/* We serialized our event into an event_payload, so we need to deserialize before returning */
			$events[] = $this->eventSerializer->deserialize( json_decode($eventMessage->event_payload));
		}

		return $events;
	}


} 