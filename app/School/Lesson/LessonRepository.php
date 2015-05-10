<?php
namespace App\School\Lesson;

use App\CQRS\DomainEventMessage;
use App\CQRS\EloquentEventStore\EloquentEventStoreRepository;
use App\CQRS\Serializer\EventSerializer;
use Event;

class LessonRepository {

	public function __construct() {
		$this->eventStoreRepository = new EloquentEventStoreRepository( new EventSerializer() );
	}

	public function save(Lesson $lesson) {

		/** @var DomainEventMessage $domainEventMessage */
		foreach( $lesson->getUncommittedDomainEvents() as $domainEventMessage ) {
			$this->eventStoreRepository->append( $domainEventMessage->getId(), $domainEventMessage->getEvent(), $domainEventMessage->getRecordedAt() );
			Event::fire($domainEventMessage->getEvent());
		}
	}

	public function load(LessonId $id) {
		$events = $this->eventStoreRepository->load($id);
		$lesson = new Lesson();
		$lesson->initializeState($events);
		return $lesson;
	}
}