<?php
namespace App\School\Lesson\Events;

use App\School\Lesson\LessonId;

class LessonWasOpened {
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
} 