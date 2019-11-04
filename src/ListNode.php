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
    private $insertOrderIndex = null;

    /** @var int */
    private $count = 0;

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

        ++$this->count;

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
    public function getInsertOrderIndex(): ?int
    {
        return $this->insertOrderIndex;
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return $this->count;
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
     * @param int $insertOrderIndex
     *
     * @return ListNode
     */
    protected function setInsertOrderIndex(int $insertOrderIndex): ListNode
    {
        $this->insertOrderIndex = $insertOrderIndex + 1;

        return $this;
    }
}
