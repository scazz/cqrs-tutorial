<?php
namespace App\School\Lesson\Projections;

use Illuminate\Database\Eloquent\Model;

class LessonProjection extends Model {
	public $timestamps = false;
	protected $table = "lessons";
} 