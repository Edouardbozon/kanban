<?php

namespace App\Domain\Task;


use App\Domain\Task\Event\TaskCreatedEvent;
use App\Domain\Task\Event\TaskIntendUpdatedEvent;
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
     * Represent the task message
     *
     * @var string
     */
    private $intend;

    public function __construct()
    {

    }

    /**
     * Create task
     *
     * @param Uuid   $uuid
     * @param string $intend
     * @return Task
     */
    public static function create(Uuid $uuid, string $intend): self
    {
        $createdTask = new TaskCreatedEvent($uuid, $intend);
        $event = Task::fromEvents([$createdTask]);
        $event->raise($createdTask);

        return $event;
    }

    public static function fromEvents(array $tasks): self
    {
        $task = new self();

        foreach ($tasks as $task) {
            $task->apply($task);
        }

        return $task;
    }

    protected function apply(TaskCreatedEvent $event): void
    {
        if ($event instanceof TaskCreatedEvent) {
            $this->uuid = $event->getTaskUuid();
            $this->intend = $event->getIntend();
        }
        if ($event instanceof TaskIntendUpdatedEvent) {
            $this->intend = $event->getIntend();
        }
    }
}