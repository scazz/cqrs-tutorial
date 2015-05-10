<?php
namespace App\School\Client\Projections;

use Illuminate\Database\Eloquent\Model;

class ClientProjection extends Model {
	public $timestamps = false;
	protected $table = "clients";
} 