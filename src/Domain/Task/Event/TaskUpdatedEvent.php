<?php

namespace App\Domain\Task\Event;


use Ramsey\Uuid\UuidInterface;

class TaskUpdatedEvent implements TaskEvent
{
    /**
     * @var UuidInterface
     */
    private $uuid;

    /**
     * @var string
     */
    private $message;

    /**
     * @var \DateTime
     */
    private $dateTime;

    /**
     * @var string
     */
    private $position;

    /**
     * @var array
     */
    private $tags;

    /**
     * TaskCreatedEvent constructor.
     * @param UuidInterface $uuid
     * @param string        $message
     */
    public function __construct(UuidInterface $uuid, string $message)
    {
        $this->uuid     = $uuid;
        $this->message  = $message;
        $this->dateTime = new \DateTime();
        $this->tags     = [];
    }

    public function getTaskUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getDateTime(): \DateTimeInterface
    {
        return $this->dateTime;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function getTags(): array
    {
        return $this->tags;
    }
}