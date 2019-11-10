<?php

declare(strict_types=1);

namespace ProjectX\DataStructure;

use ProjectX\DataStructure\Interfaces\ListNodeInterface;

class ListNode implements ListNodeInterface
{
    /** @var mixed|null */
    private $data = null;

    /** @var ListNode|null */
    private $next = null;

    /** @var ListNode|null */
    private $previous = null;

    /** @var int|null */
    private $orderIndex = 1;

    /**
     * @param mixed $data
     */
    public function __construct($data)
    {
        $this->setData($data);
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param null $data
     *
     * @return $this
     */
    public function setData($data): ListNode
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return ListNode|null
     */
    public function getNext(): ?ListNode
    {
        return $this->next;
    }

    /**
     * @return ListNode|null
     */
    public function getPrevious(): ?ListNode
    {
        return $this->previous;
    }

    /**
     * @return int|null
     */
    public function getOrderIndex(): int
    {
        return $this->orderIndex;
    }

    /**
     * @param ListNode|null $listNode
     *
     * @return ListNode
     */
    protected function setNext(?ListNode $listNode): ?ListNode
    {
        $this->next = $listNode;

        return $this;
    }

    /**
     * @param ListNode|null $listNode
     *
     * @return ListNode
     */
    protected function setPrevious(?ListNode $listNode): ?ListNode
    {
        $this->previous = $listNode;

        return $this;
    }

    /**
     * @param int $orderIndex
     *
     * @return ListNode
     */
    protected function setOrderIndex(int $orderIndex): ListNode
    {
        $this->orderIndex = $orderIndex;

        return $this;
    }

    /**
     * Increases order index of the linkedList element.
     *
     * @return ListNode
     */
    protected function increaseOrderIndex(): ListNode
    {
        ++$this->orderIndex;

        return $this;
    }
}
