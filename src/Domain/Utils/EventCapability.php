<?php

namespace App\Domain\Utils;


trait EventCapability
{
    private $events = [];

    protected function raise($event): void
    {
        $this->events[] = $event;
    }

    protected function raisedEvents(): array {
        return $this->events;
    }
}