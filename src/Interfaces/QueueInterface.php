<?php

declare(strict_types=1);

namespace ProjectX\DataStructure\Interfaces;

use Generator;

interface QueueInterface
{
    /**
     * Enqueues item to the Queue.
     *
     * @param mixed $item
     *
     * @return QueueInterface
     */
    public function enqueue($item): QueueInterface;

    /**
     * Dequeues item from the Queue.
     *
     * @return mixed
     */
    public function dequeue();
    
    /**
     * Yields generator instance.
     *
     * @return Generator
     */
    public function fifoGenerator(): Generator;
}
