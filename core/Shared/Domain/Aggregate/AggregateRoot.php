<?php

namespace Core\Shared\Domain\Aggregate;

abstract class AggregateRoot
{
    // private array $domainEvents = [];

    /*
    final public function pullDomainEvents(): array
    {
        $domainEvents       = $this->domainEvents;
        $this->domainEvents = [];

        return $domainEvents;
    }

    final protected function record(DomainEvent $domainEvent): void
    {
        $this->domainEvents[] = $domainEvent;
    }
    */
}
