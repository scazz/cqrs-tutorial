<?php
namespace App\School\ReadModels;

use App\CQRS\ReadModel\ImmutableModel;

class Lesson extends ImmutableModel {

	public function clients() {
		return $this->hasMany(Client::class);
	}
} 