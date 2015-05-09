<?php
namespace App\CQRS;

interface EventSourcedEntityInterface {

	public function getEntityId();
} 