<?php

namespace App\Domain\Utils;


use DateTimeImmutable;
use DateTimeZone;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

abstract class DomainMessage implements Message
{
    /**
     * @var string
     */
    protected $messageName;
    /**
     * @var UuidInterface
     */
    protected $uuid;
    /**
     * @var DateTimeImmutable
     */
    protected $createdAt;
    /**
     * @var array
     */
    protected $metadata = [];

    abstract protected function setPayload(array $payload): void;

    public static function fromArray(array $messageData): DomainMessage
    {
        MessageDataAssertion::assert($messageData);
        $messageRef = new \ReflectionClass(\get_called_class());
        /** @var $message DomainMessage */
        $message = $messageRef->newInstanceWithoutConstructor();
        $message->uuid = Uuid::fromString($messageData['uuid']);
        $message->messageName = $messageData['message_name'];
        $message->metadata = $messageData['metadata'];
        $message->createdAt = $messageData['created_at'];
        $message->setPayload($messageData['payload']);

        return $message;
    }

    protected function init(): void
    {
        if ($this->uuid === null) {
            $this->uuid = Uuid::uuid4();
        }
        if ($this->messageName === null) {
            $this->messageName = \get_class($this);
        }
        if ($this->createdAt === null) {
            $this->createdAt = new DateTimeImmutable('now', new DateTimeZone('UTC'));
        }
    }

    public function uuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function metadata(): array
    {
        return $this->metadata;
    }

    public function toArray(): array
    {
        return [
            'message_name' => $this->messageName,
            'uuid' => $this->uuid->toString(),
            'payload' => $this->payload(),
            'metadata' => $this->metadata,
            'created_at' => $this->createdAt(),
        ];
    }

    public function messageName(): string
    {
        return $this->messageName;
    }

    /**
     * @return static
     */
    public function withMetadata(array $metadata): Message
    {
        $message = clone $this;
        $message->metadata = $metadata;
        return $message;
    }

    /**
     * Returns new instance of message with $key => $value added to metadata
     *
     * Given value must have a scalar type.
     *
     * @return static
     */
    public function withAddedMetadata(string $key, $value): Message
    {
        Assertion::notEmpty($key, 'Invalid key');
        $message = clone $this;
        $message->metadata[$key] = $value;
        return $message;
    }
}