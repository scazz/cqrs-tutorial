<?php
namespace App\CQRS\ReadModel;

use Illuminate\Database\Eloquent\Model;

class ImmutableModel extends  Model {

	public function save(array $options = array())
	{
		throw new SavingImmutableModel(
			"Generate events in order to change this model!"
		);
	}
} 