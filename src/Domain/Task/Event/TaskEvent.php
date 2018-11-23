<?php

namespace App\Domain\Task\Event;

use Ramsey\Uuid\UuidInterface;

interface TaskEvent
{
    public function getTaskUuid(): UuidInterface;

    public function getDateTime(): \DateTimeInterface;

    public function getIntend(): string;
}