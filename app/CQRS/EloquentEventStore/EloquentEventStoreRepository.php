<?php
namespace App\CQRS\EloquentEventStore;

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


} 