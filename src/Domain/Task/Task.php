<?php

namespace App\Domain\Task;


use App\Domain\Task\Event\TaskCreatedEvent;
use App\Domain\Task\Event\TaskEvent;
use App\Domain\Task\Event\TaskMovedEvent;
use App\Domain\Task\Event\TaskUpdatedEvent;
use App\Domain\Utils\EventCapability;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class Task
{
    use EventCapability;

    /**
     * @var UuidInterface
     */
    private $uuid;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $position;

    /**
     * @var array
     */
    private $tags;

    /**
     * Create Task
     *
     * @param Uuid   $uuid
     * @param string $message
     * @return Task
     */
    public static function create(Uuid $uuid, string $message): self
    {
        $createdTask = new TaskCreatedEvent($uuid, $message, TaskPosition::TODO);
        $event = Task::fromEvents([$createdTask]);
        $event->raise($createdTask);

        return $event;
    }

    /**
     * Create Task by applying all events
     *
     * @param array $events
     * @return Task
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
     * Mutate Task following given event
     *
     * @param TaskEvent $event
     */
    protected function apply(TaskEvent $event): void
    {
        if ($event instanceof TaskCreatedEvent) {
            $this->uuid     = $event->getTaskUuid();
            $this->message  = $event->getMessage();
            $this->position = $event->getPosition();
            $this->tags     = $event->getTags();
        } else if ($event instanceof TaskUpdatedEvent) {
            $this->message  = $event->getMessage();
            $this->tags     = $event->getTags();
        } else if ($event instanceof TaskMovedEvent) {
            $this->position = $event->getPosition();
        }
    }
}