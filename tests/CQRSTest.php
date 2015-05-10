<?php

use App\School\Lesson\Commands\BookClientOntoLesson;
use App\School\Lesson\Commands\BookLesson;
use App\School\Lesson\Exceptions\TooManyClientsAddedToLesson;
use App\School\Lesson\LessonId;
use App\School\ReadModels\Lesson;
use Illuminate\Database\Eloquent\Collection;
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

	public function testLoadingWriteModel()
	{
		$testLessonId = '123e4567-e89b-12d3-a456-426655440001';
		$lessonId = new LessonId($testLessonId);
		$clientName_1 = "George";
		$clientName_2 = "Fred";

		$command = new BookLesson($lessonId, $clientName_1);
		$this->dispatch($command);

		$command = new BookClientOntoLesson($lessonId, $clientName_2);
		$this->dispatch($command);

		$lesson =  Lesson::find($testLessonId);
		$this->assertClientCollectionContains($lesson->clients, $clientName_1);
		$this->assertClientCollectionContains($lesson->clients, $clientName_2);
	}

	private function assertClientCollectionContains(Collection $clients, $nameToFind)
	{
		$attributeArray = [];
		foreach( $clients as $object ) {
			$attributeArray[] = $object->name;
		}

		$this->assertTrue( in_array($nameToFind, $attributeArray), "Could not find client named: ${nameToFind}" );
	}

	public function testMoreThan3ClientsCannotBeAddedToALesson() {
		$testLessonId = '123e4567-e89b-12d3-a456-426655440002';
		$lessonId = new LessonId($testLessonId);
		$this->dispatch( new BookLesson($lessonId, "bob") );
		$this->dispatch( new BookClientOntoLesson($lessonId, "george") );
		$this->dispatch( new BookClientOntoLesson($lessonId, "fred") );

		$this->setExpectedException( TooManyClientsAddedToLesson::class );
		$this->dispatch( new BookClientOntoLesson($lessonId, "emma") );
	}
}
