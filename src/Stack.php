<?php

declare(strict_types=1);

namespace ProjectX\DataStructure;

use Generator;
use ProjectX\DataStructure\Interfaces\StackInterface;

/**
 * Data Structure: Stack
 *
 * Pros:
 *      Stacks are great for programs where reversing things are needed.
 *      Stacks are great for keeping track of state as things are pushed on and popped off the stacks.
 *      Add/Remove a lot from the end of the data structure, stacks are great option, as pushing, peeking & popping takes
 *          very little time, often O(1) constant time.
 *      Stacks are advantageous for last in, first out (LIFO) policy.
 *
 * @package ProjectX\DataStructure
 */
class Stack implements StackInterface
{
    private $items = [];

    private $count = 0;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function __toString()
    {
        return implode(', ', $this->items);
    }

    /**
     * @inheritDoc
     */
    public function push($item): StackInterface
    {
        $this->items[] = $item;

        ++$this->count;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function pop()
    {
        if ($this->isEmpty()) {
            return null;
        }

        --$this->count;

        return array_pop($this->items);
    }

    /**
     * @inheritDoc
     */
    public function peek()
    {
        if ($this->isEmpty()) {
            return null;
        }

        return $this->items[$this->getCount() - 1];
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
    public function setStackItems(array $items): StackInterface
    {
        $this->items = array_merge($this->items, $items);

        $this->count += count($items);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function reverseStack(): StackInterface
    {
        $this->items = array_reverse($this->items);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function lifoGenerator(): Generator
    {
        foreach ($this->reverseStack()->getStackItems() as $item) {
            yield $item;
        }
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
    public function getCount(): int
    {
        return $this->count;
    }
}
