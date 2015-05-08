<?php
namespace App\School\Lesson;

use Assert\Assertion as Assert;

class LessonId {

	private $lessonId;

	public function __construct($lessonId) {
		Assert::string( $lessonId );
		Assert::uuid( $lessonId );

		$this->lessonId = $lessonId;
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		return $this->lessonId;
	}
} 