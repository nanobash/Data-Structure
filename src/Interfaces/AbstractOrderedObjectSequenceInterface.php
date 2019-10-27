<?php

declare(strict_types=1);

namespace ProjectX\DataStructure\Interfaces;

interface AbstractOrderedObjectSequenceInterface
{
    /**
     * Returns item from the end of the stack without popping it off.
     *
     * @return mixed
     */
    public function peek();

    /**
     * Returns list of items from stack.
     *
     * @return array
     */
    public function getStackItems(): array;

    /**
     * Sets items to the stack items list.
     *
     * @param array $items
     *
     * @return $this
     */
    public function setStackItems(array $items): self;

    /**
     * Reverse the items of the stack.
     *
     * @return $this
     */
    public function reverseStack(): self;

    /**
     * Returns bool based on whether the stack is empty or not.
     *
     * @return bool
     */
    public function isEmpty(): bool;
}
