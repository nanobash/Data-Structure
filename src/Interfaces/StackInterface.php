<?php

declare(strict_types=1);

namespace ProjectX\DataStructure\Interfaces;

use Generator;

interface StackInterface
{
    /**
     * Pushes item to the stack.
     *
     * @param $item
     *
     * @return $this
     */
    public function push($item): self;

    /**
     * Pops off item from the end of the stack.
     *
     * @return mixed
     */
    public function pop();

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
     * Yields generator instance.
     *
     * @return Generator
     */
    public function lifoGenerator(): Generator;

    /**
     * Returns bool based on whether the stack is empty or not.
     *
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * Returns quantity of items in the stack.
     *
     * @return int
     */
    public function getCount(): int;
}
