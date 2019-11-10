<?php

declare(strict_types=1);

namespace ProjectX\DataStructure\Interfaces;

use Countable;
use ProjectX\DataStructure\LinkedList;
use ProjectX\DataStructure\ListNode;

/**
 * Doubly LinkedList interface.
 *
 * @package ProjectX\DataStructure\Interfaces
 */
interface LinkedListInterface extends Countable
{
    public const ASC = 1;

    public const DESC = 2;

    /**
     * Returns the head of the LinkedList.
     *
     * @return ListNode|null
     */
    public function getHead(): ?ListNode;

    /**
     * Returns the tail of the LinkedList.
     *
     * @return ListNode|null
     */
    public function getTail(): ?ListNode;

    /**
     * @param $data
     * @param int $index
     * @param int $order
     * @param bool $before
     *
     * @return LinkedListInterface|null
     */
    public function add($data, int $index = 0, int $order = LinkedList::ASC, bool $before = true): ?LinkedListInterface;

    /**
     * Adds element in front of the LinkedList.
     *
     * @param $data
     *
     * @return LinkedListInterface
     */
    public function addFirst($data): LinkedListInterface;

    /**
     * Deletes element from the front of the LinkedList.
     *
     * @return LinkedListInterface
     */
    public function deleteFirst(): LinkedListInterface;

    /**
     * Adds an element in the back of the LinkedList.
     *
     * @param $data
     *
     * @return LinkedListInterface
     */
    public function addLast($data): LinkedListInterface;

    /**
     * Deletes an element from the back of the LinkedList.
     *
     * @return LinkedListInterface
     */
    public function deleteLast(): LinkedListInterface;

    /**
     * Returns element of the LinkedList or null if not found based on specified index & order.
     *
     * @param int $index
     * @param int $order
     *
     * @return ListNode|null
     */
    public function find(int $index = 0, int $order = LinkedList::ASC): ?ListNode;

    /**
     * Returns all the elements of the LinkedList as an array.
     *
     * @param int $order
     *
     * @return array
     */
    public function getAll(int $order = LinkedList::ASC): array;
}
