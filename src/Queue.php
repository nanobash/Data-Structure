<?php

declare(strict_types=1);

namespace ProjectX\DataStructure;

use Generator;
use ProjectX\DataStructure\Interfaces\QueueInterface;

/**
 * Data Structure: Queue
 *
 * Pros:
 *      Queues are advantageous for first in, first out (FIFO) policy.
 *
 * @package ProjectX\DataStructure
 */
class Queue extends AbstractOrderedObjectSequence implements QueueInterface
{
    /**
     * @inheritDoc
     */
    public function enqueue($item): QueueInterface
    {
        $this->items[] = $item;

        ++$this->count;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function dequeue()
    {
        --$this->count;

        return array_shift($this->items);
    }

    /**
     * @inheritDoc
     */
    public function fifoGenerator(): Generator
    {
        foreach ($this->getSequenceItems() as $item) {
            yield $item;
        }
    }
}
