<?php
namespace App\School\ReadModels;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model {

	public function clients() {
		return $this->hasMany(Client::class);
	}
} 