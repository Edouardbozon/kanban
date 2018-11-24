<?php

namespace App\Domain\Tag\Event;


use Ramsey\Uuid\UuidInterface;

class TagCreatedEvent implements TagEvent
{
    /**
     * @var UuidInterface
     */
    private $uuid;

    /**
     * @var \DateTimeInterface
     */
    private $dateTime;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $color;

    public function __construct(UuidInterface $uuid, string $name)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->dateTime = new \DateTime();
        $this->color = 'transparent';
    }

    public function getTagUuid(): UuidInterface
    {
       return $this->uuid;
    }

    public function getDateTime(): \DateTimeInterface
    {
        return $this->dateTime;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getColor(): string
    {
        return $this->color;
    }
}