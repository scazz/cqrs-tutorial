<?php


namespace App\School\Lesson;

use App\CQRS\EventSourcedEntity;
use App\School\Lesson\Events\ClientBookedOntoLesson;
use App\School\Lesson\Events\LessonWasOpened;
use App\School\Lesson\Exceptions\TooManyClientsAddedToLesson;

class Lesson extends EventSourcedEntity {

	protected $lessonId;
	private $numberOfClients;

	public function getEntityId()
	{
		return $this->lessonId;
	}

	public static function bookClientOntoNewLesson(LessonId $lessonId, $clientName) {
		$lesson = new Lesson();
		$lesson->openLesson( $lessonId );
		$lesson->bookClient( $clientName );
		return $lesson;
	}

	public function openLesson( LessonId $lessonId ) {
		/* here we would check any invarients - but we don't have any to protect, so we can just generate the events */
		$this->apply(
			new LessonWasOpened( $lessonId)
		);
	}

	protected function applyLessonWasOpened( LessonWasOpened $event ) {
		$this->lessonId = $event->getLessonId();
		$this->numberOfClients = 0;
	}

	public function bookClient( $clientName ) {
		if ($this->numberOfClients >= 3) {
			throw new TooManyClientsAddedToLesson();
		}

		$this->apply(
			new ClientBookedOntoLesson( $this->lessonId, $clientName)
		);
	}

	/*
	 * Here, we only keep track of the number of clients -
	 * this is the only thing the write model cares about
	 *
	 * If a domain rules was "no clients can have the same name",
	 * we would need to keep a track of client names.
	 */

	protected function applyClientBookedOntoLesson( ClientBookedOntoLesson $event ) {
		$this->numberOfClients++;
	}


}