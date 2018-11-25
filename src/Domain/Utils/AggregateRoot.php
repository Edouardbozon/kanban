<?php

namespace App\Domain\Utils;

abstract class AggregateRoot
{
    use EventProducerTrait;
    use EventSourcedTrait;

    /**
     * We do not allow public access to __construct, this way we make sure that an aggregate root can only
     * be constructed by static factories
     */
    protected function __construct()
    {

    }
}