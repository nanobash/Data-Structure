<?php

declare(strict_types=1);

namespace ProjectX\DataStructure;

use ProjectX\DataStructure\Interfaces\LinkedListInterface;

class LinkedList extends ListNode implements LinkedListInterface
{
    /** @var ListNode|null */
    private $head = null;

    /** @var ListNode|null */
    private $tail = null;

    /** @var int */
    private $orderIndex = 0;

    /**
     * @param null $data
     */
    public function __construct($data = null)
    {
        parent::__construct($data);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf("Head -> %s\nTail -> %s", $this->getHead()->getData(), $this->getTail()->getData());
    }

    /**
     * @inheritDoc
     */
    public function getHead(): ?ListNode
    {
        return $this->head;
    }

    /**
     * @inheritDoc
     */
    public function getTail(): ?ListNode
    {
        return $this->tail;
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return $this->orderIndex;
    }

    /**
     * @inheritDoc
     */
    public function find(int $index = 0, int $order = LinkedListInterface::ASC): ?ListNode
    {
        if ($index > $this->orderIndex) {
            return null;
        }

        $pointer = $order === LinkedListInterface::ASC ? $this->head : $this->tail;

        do {
            if ($index === 0) {
                return $pointer;
            }

            --$index;
        } while (null !== ($pointer = $order === LinkedListInterface::ASC ? $pointer->getNext() : $pointer->getPrevious()));

        return null;
    }

    /**
     * @inheritDoc
     */
    public function add($data, int $index = 0, int $order = LinkedListInterface::ASC, bool $before = true): ?LinkedListInterface
    {
        if (null === ($current = $this->find($index, $order))) {
            return null;
        }

        $newListNode = new ListNode($data);

        if (true === $before) {
            $currentPrevious = $current->getPrevious();

            $newListNode->setNext($current);
            $newListNode->setPrevious($currentPrevious);
            $current->setPrevious($newListNode);
            $currentPrevious->setNext($newListNode);
        } else {
            $currentNext = $current->getNext();

            $newListNode->setNext($currentNext);
            $newListNode->setPrevious($current);
            $current->setNext($newListNode);
            $currentNext->setPrevious($newListNode);
        }

        $newListNode->setInsertOrderIndex($this->orderIndex);

        ++$this->orderIndex;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addFirst($data): LinkedListInterface
    {
        $newListNode = new ListNode($data);

        $newListNode->setNext($this->head);
        $newListNode->setInsertOrderIndex($this->orderIndex);

        if (null !== $this->head) {
            $this->head->setPrevious($newListNode);
        }

        if (0 === $this->orderIndex) {
            $this->tail = $newListNode;
        }

        $this->head = $newListNode;

        ++$this->orderIndex;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addLast($data): LinkedListInterface
    {
        $newListNode = new ListNode($data);

        $newListNode->setPrevious($this->tail);
        $newListNode->setInsertOrderIndex($this->orderIndex);

        if (null !== $this->tail) {
            $this->tail->setNext($newListNode);
        }

        if (0 === $this->orderIndex) {
            $this->head = $newListNode;
        }

        $this->tail = $newListNode;

        ++$this->orderIndex;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getAll(int $order = LinkedListInterface::ASC): array
    {
        $list = [];

        $pointer = $order === LinkedListInterface::ASC ? $this->head : $this->tail;

        do {
            $list[$pointer->getInsertOrderIndex()] = $pointer->getData();
        } while (null !== ($pointer = $order === LinkedListInterface::ASC ? $pointer->getNext() : $pointer->getPrevious()));

        return $list;
    }
}
