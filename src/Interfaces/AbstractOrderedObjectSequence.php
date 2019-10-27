<?php

declare(strict_types=1);

namespace ProjectX\DataStructure\Interfaces;

use ArrayAccess;
use Countable;

abstract class AbstractOrderedObjectSequence implements AbstractOrderedObjectSequenceInterface, ArrayAccess, Countable
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
    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset)) {
            return null;
        }

        return $this->items[$offset];
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value): self
    {
        $this->items[$offset] = $value;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset): self
    {
        unset($this->items[$offset]);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return $this->count;
    }
}
