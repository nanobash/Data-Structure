<?php

declare(strict_types=1);

namespace ProjectX\DataStructure\Interfaces;

use Generator;

interface StackInterface
{
    /**
     * Pops off item from the end of the stack.
     *
     * @return mixed
     */
    public function pop();

    /**
     * Yields generator instance.
     *
     * @return Generator
     */
    public function lifoGenerator(): Generator;
}
