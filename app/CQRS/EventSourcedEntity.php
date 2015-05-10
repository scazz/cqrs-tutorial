<?php
namespace App\CQRS;

abstract class EventSourcedEntity implements EventSourcedEntityInterface {

	private $uncommittedEvents = array();

	public function apply( $event ) {
		$this->handle( $event );

		$this->uncommittedEvents[] = DomainEventMessage::recordNow( $this->getEntityId(), $event );
	}

	public function initializeState($events) {
		foreach( $events as $event ) {
			$this->handle($event);
		}
	}

	public function getUncommittedDomainEvents()
	{
		return $this->uncommittedEvents;
	}

	private function handle( $event ) {
		$method_name = $this->getApplyMethodName($event);

		if (! method_exists($this, $method_name)) {
			return;
		}

		$this->$method_name($event);
	}

	private function getApplyMethodName($event) {
		$className = get_class($event);

		$classParts = explode('\\', $className);
		$methodName = end($classParts);

		return 'apply'. $methodName;
	}

} 