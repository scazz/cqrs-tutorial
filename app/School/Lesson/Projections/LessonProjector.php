<?php
namespace App\School\Lesson\Projections;

use App\School\Lesson\Events\LessonWasOpened;
use Illuminate\Events\Dispatcher;

class LessonProjector {

	public function applyLessonWasOpened( LessonWasOpened $event ) {
		$lessonProjection = new LessonProjection();
		$lessonProjection->id = $event->getLessonId();
		$lessonProjection->save();
	}

	public function subscribe(Dispatcher $events) {
		$fullClassName = self::class;
		$events->listen( LessonWasOpened::class, $fullClassName.'@applyLessonWasOpened');
	}
}