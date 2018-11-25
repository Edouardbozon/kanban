<?php

namespace App\Domain\Utils;


abstract class DomainEvent extends DomainMessage
{
    public function messageType(): string
    {
        return self::TYPE_EVENT;
    }
}