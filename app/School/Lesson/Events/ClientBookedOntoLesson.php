<?php
namespace App\School\Lesson\Events;

use App\School\Lesson\LessonId;

class ClientBookedOntoLesson {
	/**
	 * @var LessonId
	 */
	private $lessonId;
	private $clientName;

	public function __construct(LessonId $lessonId, $clientName) {
		$this->lessonId = $lessonId;
		$this->clientName = $clientName;
	}
} 