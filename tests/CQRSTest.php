<?php

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

		$this->assertEquals( Lesson::find($testLessonId)->clientName, $clientName );
	}
}
