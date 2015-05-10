<?php

use App\School\Lesson\Commands\BookLesson;
use App\School\Lesson\LessonId;
use App\School\ReadModels\Lesson;
use Illuminate\Foundation\Bus\DispatchesCommands;

class CQRSTest extends TestCase {

	use DispatchesCommands;

	/**
	 * Assert the BookLesson Command creates a lesson in our read projection
	 * @return void
	 */
	public function testFiringEventUpdatesReadModel()
	{
		$testLessonId = '123e4567-e89b-12d3-a456-426655440000';
		$clientName = "George";
		$lessonId = new LessonId($testLessonId);

		$command = new BookLesson($lessonId, $clientName);
		$this->dispatch($command);

		$lesson =  Lesson::find($testLessonId);
		$this->assertEquals( $lesson->id, $testLessonId );

		$client = $lesson->clients()->first();
		$this->assertEquals($client->name, $clientName);
	}
}
