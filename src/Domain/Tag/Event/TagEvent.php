<?php

namespace App\Domain\Tag\Event;


use Ramsey\Uuid\UuidInterface;

interface TagEvent
{
    public function getTagUuid(): UuidInterface;

    public function getDateTime(): \DateTimeInterface;

    public function getName(): string;

    public function getColor(): string;
}