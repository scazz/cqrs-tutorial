<?php
namespace App\CQRS;

use DateTime;

class DomainEventMessage {

	private $id;
	private $event;
	/**
	 * @var DateTime
	 */
	private $dateTime;

	public function __construct($id, $event, DateTime $dateTime) {
		$this->id = $id;
		$this->event = $event;
		$this->dateTime = $dateTime;
	}

	public static function recordNow($id, $event ) {
		return new DomainEventMessage($id, $event, new DateTime());
	}

	/**
	 * @return DateTime
	 */
	public function getRecordedAt()
	{
		return $this->dateTime;
	}

	/**
	 * @return mixed
	 */
	public function getEvent()
	{
		return $this->event;
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}
}