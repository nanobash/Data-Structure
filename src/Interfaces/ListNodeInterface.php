<?php

declare(strict_types=1);

namespace ProjectX\DataStructure\Interfaces;

use ProjectX\DataStructure\ListNode;

interface ListNodeInterface
{
    public function getOrderIndex(): int;

    public function getData();

    public function setData($data): ListNode;

    public function getNext(): ?ListNode;

    public function getPrevious(): ?ListNode;
}
