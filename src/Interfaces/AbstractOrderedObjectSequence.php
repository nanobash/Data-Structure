<?php

declare(strict_types=1);

namespace ProjectX\DataStructure\Interfaces;

use Countable;

abstract class AbstractOrderedObjectSequence implements AbstractOrderedObjectSequenceInterface, Countable
{
    protected $items = [];

    protected $count = 0;

    public function __construct(array $items = [])
    {
        $this->items = $items;

        $this->count = count($items);
    }

    /**
     * @inheritDoc
     */
    public function peek()
    {
        if ($this->isEmpty()) {
            return null;
        }

        return $this->items[$this->count - 1];
    }

    /**
     * @inheritDoc
     */
    public function getStackItems(): array
    {
        return $this->items;
    }

    /**
     * @inheritDoc
     */
    public function setStackItems(array $items): AbstractOrderedObjectSequenceInterface
    {
        $this->items = array_merge($this->items, $items);

        $this->count += count($items);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function reverseStack(): AbstractOrderedObjectSequenceInterface
    {
        $this->items = array_reverse($this->items);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isEmpty(): bool
    {
        return [] === $this->items;
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return $this->count;
    }
}
