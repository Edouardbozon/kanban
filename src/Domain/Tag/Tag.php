<?php

namespace App\Domain\Tag;


use App\Domain\Tag\Event\TagCreatedEvent;
use App\Domain\Tag\Event\TagEvent;
use App\Domain\Utils\EventCapability;
use Ramsey\Uuid\Uuid;

final class Tag
{
    use EventCapability;

    /**
     * @var Uuid;
     */
    private $uuid;

    /**
     * @var string;
     */
    private $name;

    /**
     * @var string;
     */
    private $color;

    public static function create(Uuid $uuid, string $name): self
    {
        $createdTag = new TagCreatedEvent($uuid, $name);
        $event = Tag::fromEvents([$createdTag]);
        $event->raise($createdTag);

        return $event;
    }

    /**
     * @param array $events
     * @return Tag
     */
    public static function fromEvents(array $events): self
    {
        $task = new self();

        foreach ($events as $event) {
            $task->apply($event);
        }

        return $task;
    }

    /**
     * @param TagEvent $event
     */
    protected function apply(TagEvent $event): void
    {
        if ($event instanceof TagCreatedEvent) {
            $this->uuid  = $event->getTagUuid();
            $this->name  = $event->getName();
            $this->color = $event->getColor();
        }
    }
}