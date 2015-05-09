<?php
namespace App\CQRS\EloquentEventStore;

use Illuminate\Database\Eloquent\Model;

class EloquentEventStoreModel extends Model {

	protected $table = "domain_events";
	public $timestamps = false;

} 