<?php
namespace App\School\Lesson\Events;

use App\CQRS\Serializer\SerializableEvent;
use App\School\Lesson\LessonId;

class ClientBookedOntoLesson implements SerializableEvent {
	/**
	 * @var LessonId
	 */
	private $lessonId;
	private $clientName;

	public function __construct(LessonId $lessonId, $clientName) {
		$this->lessonId = $lessonId;
		$this->clientName = $clientName;
	}

	public function serialize()
	{
		return array(
			'clientName' => $this->clientName
		);
	}
}