<?php
namespace App\School\Lesson\Commands;

use App\Commands\Command;
use App\School\Lesson\Lesson;
use App\School\Lesson\LessonId;
use App\School\Lesson\LessonRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class BookLesson extends Command implements SelfHandling {

	/** @var LessonId  */
	private $lessonId;

	public function __construct(LessonId $lessonId)
	{
		$this->lessonId = $lessonId;
	}

	/**
	 * @return LessonId
	 */
	public function getLessonId()
	{
		return $this->lessonId;
	}

	public function handle(LessonRepository $lessonRepository)
	{
		$lesson = Lesson::bookClientOntoNewLesson($this->lessonId, "");

		$lessonRepository->save($lesson);
	}
}