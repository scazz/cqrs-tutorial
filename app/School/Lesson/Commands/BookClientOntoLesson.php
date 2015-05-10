<?php


namespace App\School\Lesson\Commands;


use App\Commands\Command;
use App\School\Lesson\Lesson;
use App\School\Lesson\LessonId;
use App\School\Lesson\LessonRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class BookClientOntoLesson extends Command implements SelfHandling {

	/** @var LessonId  */
	private $lessonId;
	private $clientName;

	public function __construct(LessonId $lessonId, $clientName)
	{
		$this->lessonId = $lessonId;
		$this->clientName = $clientName;
	}

	public function handle(LessonRepository $repository) {
		/** @var Lesson $lesson */
		$lesson = $repository->load($this->lessonId);
		$lesson->bookClient($this->clientName);
		$repository->save($lesson);
	}
}