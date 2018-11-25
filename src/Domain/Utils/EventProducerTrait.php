<?php

namespace App\Domain\Utils;


trait EventProducerTrait
{
    /**
     * Current version
     *
     * @var int
     */
    protected $version = 0;

    /**
     * List of events that are not committed to the EventStore
     *
     * @var AggregateChanged[]
     */
    protected $recordedEvents = [];

    /**
     * Get pending events and reset stack
     *
     * @return AggregateChanged[]
     */
    protected function popRecordedEvents(): array
    {
        $pendingEvents = $this->recordedEvents;
        $this->recordedEvents = [];
        return $pendingEvents;
    }

    /**
     * Record an aggregate changed event
     */
    protected function recordThat(AggregateChanged $event): void
    {
        $this->version += 1;
        $this->recordedEvents[] = $event->withVersion($this->version);
        $this->apply($event);
    }
    abstract protected function aggregateId(): string;

    abstract protected function apply(AggregateChanged $event): void;
}