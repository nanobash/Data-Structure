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
class Stack extends AbstractOrderedObjectSequence implements StackInterface
{
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
        --$this->count;

        return array_pop($this->items);
    }

    /**
     * @inheritDoc
     */
    public function lifoGenerator(): Generator
    {
        foreach ($this->reverseSequence()->getSequenceItems() as $item) {
            yield $item;
        }
    }
}
