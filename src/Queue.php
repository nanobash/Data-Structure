<?php

declare(strict_types=1);

namespace ProjectX\DataStructure;

use Generator;
use ProjectX\DataStructure\Interfaces\AbstractOrderObjectList;
use ProjectX\DataStructure\Interfaces\QueueInterface;

/**
 * Data Structure: Queue
 *
 * Pros:
 *      Queues are advantageous for first in, first out (FIFO) policy.
 *
 * @package ProjectX\DataStructure
 */
class Queue extends AbstractOrderObjectList implements QueueInterface
{
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * @inheritDoc
     */
    public function fifoGenerator(): Generator
    {
        foreach ($this->getStackItems() as $item) {
            yield $item;
        }
    }
}
