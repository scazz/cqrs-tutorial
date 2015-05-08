<?php


namespace App\School\Lesson;

class Lesson {

	private $lessonId;
	private $numberOfClients;
	private $uncommittedEvents = [];

	public static function bookClientOntoNewLesson(LessonId $lessonId, $clientName) {
		$lesson = new Lesson();
		$lesson->openLesson( $lessonId );
		$lesson->bookClient( $clientName );
		return $lesson;
	}


	private function openLesson( LessonId $lessonId ) {
		/* here we would check any invarients - but we don't have any to protect, so we can just generate the events */
		$event = new LessonWasOpened( $lessonId);
		$this->applyLessonWasOpened($event);
		$this->uncommittedEvents[] = DomainEventMessage::recordNow( $this->lessonId, $event );
	}

	private function applyLessonWasOpened( $event ) {
		$this->lessonId = $event->lessonId;
		$this->numberOfClients = 0;
	}

	public function bookClient( $clientName ) {
		if ($this->numberOfClients >= 3) {
			throw new Exception("Too many clients");
		}

		$event = new ClientBookedOntoLesson( $this->lessonId, $clientName);
		$this->applyClientBookedOntoLesson( $event );
		$this->uncommittedEvents[] = DomainEventMessage::recordNow( $this->lessonId, $event );
	}

	/*
	 * Here, we only keep track of the number of clients -
	 * this is the only thing the write model cares about
	 *
	 * If a domain rules was "no clients can have the same name",
	 * we would need to keep a track of client names.
	 */

	private function applyClientBookedOntoLesson( $event ) {
		$this->numberOfClients++;
	}
} 