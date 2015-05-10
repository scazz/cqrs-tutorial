<?php


namespace App\CQRS\Serializer;


interface SerializableEvent {
	public function serialize();
	public static function deserialize($data);
} 