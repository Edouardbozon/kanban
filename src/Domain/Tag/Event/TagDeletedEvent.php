<?php

namespace App\Domain\Tag\Event;


use Ramsey\Uuid\UuidInterface;

class TagDeletedEvent implements TagEvent
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

    public function __construct(UuidInterface $uuid)
    {
        $this->uuid = $uuid;
        $this->name = '';
        $this->color = '';
        $this->dateTime = new \DateTime();
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