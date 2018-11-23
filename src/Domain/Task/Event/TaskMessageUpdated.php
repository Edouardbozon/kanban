<?php

namespace App\Domain\Task\Event;


use Ramsey\Uuid\UuidInterface;

class TaskMessageUpdatedEvent implements TaskEvent
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
     * TaskCreatedEvent constructor.
     * @param UuidInterface $uuid
     * @param string        $intend
     */
    public function __construct(UuidInterface $uuid, string $intend)
    {
        $this->uuid     = $uuid;
        $this->message  = $intend;
        $this->dateTime = new \DateTime();
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
}