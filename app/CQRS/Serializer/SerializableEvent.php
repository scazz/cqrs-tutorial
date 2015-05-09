<?php


namespace App\CQRS\Serializer;


interface SerializableEvent {
	public function serialize();
} 