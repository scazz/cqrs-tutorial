<?php
namespace App\School\Client\Projections;

use App\School\Lesson\Events\ClientBookedOntoLesson;
use Illuminate\Events\Dispatcher;

class ClientProjector {

	public function applyClientBookedOntoLesson( ClientBookedOntoLesson $event ) {
		$clientProjection = new ClientProjection();
		$clientProjection->lesson_id = $event->getLessonId();
		$clientProjection->name = $event->getClientName();
		$clientProjection->save();
	}

	public function subscribe(Dispatcher $events) {
		$fullClassName = self::class;
		$events->listen( ClientBookedOntoLesson::class, $fullClassName.'@applyClientBookedOntoLesson');
	}
}