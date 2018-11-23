<?php

namespace App\Domain\Task\Event;


use Ramsey\Uuid\UuidInterface;

class TaskCreatedEvent implements TaskEvent
{
    /**
     * @var UuidInterface
     */
    private $uuid;

    /**
     * @var string
     */
    private $intend;

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
        $this->uuid = $uuid;
        $this->intend = $intend;
        $this->dateTime = new \DateTime();
    }

    public function getTaskUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function getIntend(): string
    {
        return $this->intend;
    }

    public function getDateTime(): \DateTimeInterface
    {
        return $this->dateTime;
    }
}