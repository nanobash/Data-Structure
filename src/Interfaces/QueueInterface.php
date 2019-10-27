<?php

declare(strict_types=1);

namespace ProjectX\DataStructure\Interfaces;

use Generator;

interface QueueInterface
{
    /**
     * Yields generator instance.
     *
     * @return Generator
     */
    public function fifoGenerator(): Generator;
}
