<?php

declare(strict_types=1);

namespace ProjectX\DataStructure;

use ArrayAccess;
use Countable;
use ProjectX\DataStructure\Interfaces\AbstractOrderedObjectSequenceInterface;

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
        return $this->items[$this->count - 1] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getSequenceItems(): array
    {
        return $this->items;
    }

    /**
     * @inheritDoc
     */
    public function setSequenceItems(array $items): AbstractOrderedObjectSequenceInterface
    {
        $this->items = array_merge($this->items, $items);

        $this->count += count($items);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function reverseSequence(): AbstractOrderedObjectSequenceInterface
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
        return $this->items[$offset] ?? null;
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
