<?php

declare(strict_types=1);

namespace ProjectX\DataStructure\Interfaces;

use Countable;

abstract class AbstractOrderObjectList implements OrderObjectListInterface, Countable
{
    protected $items = [];

    protected $count = 0;

    /**
     * @inheritDoc
     */
    public function push($item): OrderObjectListInterface
    {
        $this->items[] = $item;

        ++$this->count;

        return $this;
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
    public function setStackItems(array $items): OrderObjectListInterface
    {
        $this->items = array_merge($this->items, $items);

        $this->count += count($items);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function reverseStack(): OrderObjectListInterface
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
