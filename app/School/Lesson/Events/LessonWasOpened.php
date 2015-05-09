<?php
namespace App\School\Lesson\Events;

use App\CQRS\Serializer\SerializableEvent;
use App\School\Lesson\LessonId;

class LessonWasOpened implements SerializableEvent {
	/**
	 * @var LessonId
	 */
	private $lessonId;

	public function __construct(LessonId $lessonId) {
		$this->lessonId = $lessonId;
	}

	/**
	 * @return LessonId
	 */
	public function getLessonId()
	{
		return $this->lessonId;
	}

	public function serialize()
	{
		return array( 'lessonId'=> $this->getLessonId() );
	}
}