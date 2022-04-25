<?php

namespace Core\Shared\Domain;

abstract class Collection implements \IteratorAggregate, \Countable
{
    protected array $items;

    public function __construct(array $items)
    {
        // Assert::arrayOf($this->type(), $items);
        $this->items = $items;
    }

    protected function items(): array
    {
        return $this->items;
    }

    // abstract protected function type(): string;

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->items());
    }

    public function count(): int
    {
        return count($this->items());
    }
}
