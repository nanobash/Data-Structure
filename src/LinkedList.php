<?php

declare(strict_types=1);

namespace ProjectX\DataStructure;

use ProjectX\DataStructure\Exceptions\LinkedListNodeNotFound;
use ProjectX\DataStructure\Interfaces\LinkedListInterface;

class LinkedList extends ListNode implements LinkedListInterface
{
    /** @var ListNode|null */
    private $head = null;

    /** @var ListNode|null */
    private $tail = null;

    /** @var int */
    private $count = 0;

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
        $fmt = '';

        $fmt .= "Head -> " . (null !== $this->head ? $this->head->getData() : "NULL");
        $fmt .= "\n";
        $fmt .= "Tail -> " . (null !== $this->tail ? $this->tail->getData() : "NULL");

        return $fmt;
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
     *
     * @throws LinkedListNodeNotFound
     */
    public function find(int $index = 0, int $order = LinkedListInterface::ASC): ?ListNode
    {
        if ($index >= $this->count) {
            throw new LinkedListNodeNotFound("LinkedList node not found!");
        }

        $pointer = $order === LinkedListInterface::ASC ? $this->head : $this->tail;

        do {
            if ($index === 0) {
                return $pointer;
            }

            --$index;
        } while (null !== ($pointer = $order === LinkedListInterface::ASC ? $pointer->getNext() : $pointer->getPrevious()));
    }

    /**
     * @inheritDoc
     *
     * @throws LinkedListNodeNotFound
     */
    public function add($data, int $index = 0, int $order = LinkedListInterface::ASC, bool $before = true): ?LinkedListInterface
    {
        if (null === ($current = $this->find($index, $order))) {
            throw new LinkedListNodeNotFound("LinkedList node not found!");
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

        $newListNode->setOrderIndex($this->getOrderIndex());

        $this->increaseOrderIndex();
        ++$this->count;

        return $this;
    }

    /**
     * @inheritDoc
     *
     * @throws LinkedListNodeNotFound
     */
    public function delete(int $index, int $order = LinkedListInterface::ASC): LinkedListInterface
    {
        if (null === ($current = $this->find($index, $order))) {
            throw new LinkedListNodeNotFound("LinkedList node not found!");
        }

        $previous = $current->getPrevious();
        $next = $current->getNext();

        $previous->setNext($next);
        $next->setPrevious($previous);

        --$this->count;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addFirst($data): LinkedListInterface
    {
        $newListNode = new ListNode($data);

        $newListNode->setNext($this->head);
        $newListNode->setOrderIndex($this->getOrderIndex());

        if (null !== $this->head) {
            $this->head->setPrevious($newListNode);
        }

        if (1 === $this->getOrderIndex()) {
            $this->tail = $newListNode;
        }

        $this->head = $newListNode;

        $this->increaseOrderIndex();
        ++$this->count;

        return $this;
    }

    /**
     * @inheritDoc
     *
     * @throws LinkedListNodeNotFound
     */
    public function deleteFirst(): LinkedListInterface
    {
        if (0 === $this->count) {
            throw new LinkedListNodeNotFound("LinkedList node not found!");
        }

        $this->head = $this->head->getNext();

        if (null !== $this->head) {
            $this->head->setPrevious(null);
        }

        --$this->count;

        if (0 === $this->count) {
            $this->tail = null;
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addLast($data): LinkedListInterface
    {
        $newListNode = new ListNode($data);

        $newListNode->setPrevious($this->tail);
        $newListNode->setOrderIndex($this->getOrderIndex());

        if (null !== $this->tail) {
            $this->tail->setNext($newListNode);
        }

        if (1 === $this->getOrderIndex()) {
            $this->head = $newListNode;
        }

        $this->tail = $newListNode;

        $this->increaseOrderIndex();
        ++$this->count;

        return $this;
    }

    /**
     * @return LinkedListInterface
     *
     * @throws LinkedListNodeNotFound
     */
    public function deleteLast(): LinkedListInterface
    {
        if (0 === $this->count) {
            throw new LinkedListNodeNotFound("LinkedList node not found!");
        }

        $this->tail = $this->tail->getPrevious();

        if (null !== $this->tail) {
            $this->tail->setNext(null);
        }

        --$this->count;

        if (0 === $this->count) {
            $this->head = null;
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getAll(int $order = LinkedListInterface::ASC): array
    {
        if (null === $this->head) {
            return [];
        }

        $list = [];

        $pointer = $order === LinkedListInterface::ASC ? $this->head : $this->tail;

        do {
            $list[$pointer->getOrderIndex()] = $pointer->getData();
        } while (null !== ($pointer = $order === LinkedListInterface::ASC ? $pointer->getNext() : $pointer->getPrevious()));

        return $list;
    }

    public function count(): int
    {
        return $this->count;
    }
}
