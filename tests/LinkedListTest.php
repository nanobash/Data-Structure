<?php

declare(strict_types=1);

namespace ProjectX\DataStructure\Test;

use PHPUnit\Framework\TestCase;
use ProjectX\DataStructure\Exceptions\LinkedListNodeNotFound;
use ProjectX\DataStructure\Interfaces\LinkedListInterface;
use ProjectX\DataStructure\LinkedList;
use ProjectX\DataStructure\ListNode;

class LinkedListTest extends TestCase
{
    private $linkedList;

    public function setUp(): void
    {
        $this->linkedList = new LinkedList();
    }

    public function tearDown(): void
    {
        $this->linkedList = null;
    }

    /**
     * @dataProvider elementsListProvider
     *
     * @param $data
     */
    public function testConstructor($data)
    {
        $this->linkedList = new ListNode($data);

        if ($data === null) {
            $this->assertNull($this->linkedList->getData());
        } else {
            $this->assertNotNull($this->linkedList->getData());
        }

        $this->assertSame($data, $this->linkedList->getData());
    }

    public function testFindOnNull()
    {
        $this->setUpLinkedList();

        $this->assertNull($this->linkedList->find(101));
    }

    public function testAddOnNull()
    {
        $this->assertNull($this->linkedList->add("foo", 9));
    }

    public function testAddFirstAddLastAddFind()
    {
        $this->setUpLinkedList();

        $this->assertSame([
            6 => "heaps",
            7 => "doubly",
            4 => "stack",
            3 => "hashMap",
            10 => "queue",
            1 => "set",
            9 => "binary",
            8 => "singly",
            2 => "map",
            5 => "linkedList",
        ], $this->linkedList->getAll(LinkedListInterface::ASC));

        $this->assertSame([
            5 => "linkedList",
            2 => "map",
            8 => "singly",
            9 => "binary",
            1 => "set",
            10 => "queue",
            3 => "hashMap",
            4 => "stack",
            7 => "doubly",
            6 => "heaps",
        ], $this->linkedList->getAll(LinkedListInterface::DESC));

        $this->assertNotNull($this->linkedList->getHead());
        $this->assertNotNull($this->linkedList->getTail());
        $this->assertSame("heaps", $this->linkedList->getHead()->getData());
        $this->assertSame("linkedList", $this->linkedList->getTail()->getData());
        $this->assertSame(10, $this->linkedList->count());
        $this->assertSame(9, $this->linkedList
            ->getTail()
            ->getPrevious()
            ->getPrevious()
            ->getPrevious()
            ->getOrderIndex()
        );
        $this->assertSame(4, $this->linkedList
            ->getHead()
            ->getNext()
            ->getNext()
            ->getOrderIndex()
        );
        $this->assertSame("hashMap", $this->linkedList->find(3, LinkedListInterface::ASC)->getData());
        $this->assertSame("map", $this->linkedList->find(1, LinkedListInterface::DESC)->getData());
    }

    /**
     * @throws LinkedListNodeNotFound
     */
    public function testDeleteFirst()
    {
        $this->setUpLinkedList();

        $this->assertSame(10, $this->linkedList->count());
        $this->assertSame("heaps", $this->linkedList->getHead()->getData());
        $this->assertSame("linkedList", $this->linkedList->getTail()->getData());

        $this->linkedList->deleteFirst();

        $this->assertSame(9, $this->linkedList->count());
        $this->assertSame("doubly", $this->linkedList->getHead()->getData());
        $this->assertSame(
            "map",
            $this
                ->linkedList
                ->getTail()
                ->getPrevious()
                ->getData()
        );

        $this->linkedList->deleteFirst();

        $this->assertSame(8, $this->linkedList->count());
        $this->assertSame("stack", $this->linkedList->getHead()->getData());
        $this->assertSame(
            "singly",
            $this
                ->linkedList
                ->getTail()
                ->getPrevious()
                ->getPrevious()
                ->getData()
        );

        $this->linkedList->deleteFirst();

        $this->assertSame(7, $this->linkedList->count());
        $this->assertSame("hashMap", $this->linkedList->getHead()->getData());
        $this->assertSame(
            "binary",
            $this
                ->linkedList
                ->getTail()
                ->getPrevious()
                ->getPrevious()
                ->getPrevious()
                ->getData()
        );

        $this->linkedList->deleteFirst();

        $this->assertSame(6, $this->linkedList->count());
        $this->assertSame("queue", $this->linkedList->getHead()->getData());
        $this->assertSame(
            "set",
            $this
                ->linkedList
                ->getTail()
                ->getPrevious()
                ->getPrevious()
                ->getPrevious()
                ->getPrevious()
                ->getData()
        );

        $this->linkedList->deleteFirst();

        $this->assertSame(5, $this->linkedList->count());
        $this->assertSame("set", $this->linkedList->getHead()->getData());
        $this->assertSame(
            "set",
            $this->linkedList
                ->getTail()
                ->getPrevious()
                ->getPrevious()
                ->getPrevious()
                ->getPrevious()
                ->getData()
        );

        $this->linkedList->deleteFirst();

        $this->assertSame(4, $this->linkedList->count());
        $this->assertSame("binary", $this->linkedList->getHead()->getData());
        $this->assertSame(
            "binary",
            $this
                ->linkedList
                ->getTail()
                ->getPrevious()
                ->getPrevious()
                ->getPrevious()
                ->getData()
        );

        $this->linkedList->deleteFirst();

        $this->assertSame(3, $this->linkedList->count());
        $this->assertSame("singly", $this->linkedList->getHead()->getData());
        $this->assertSame(
            "singly",
            $this
                ->linkedList
                ->getTail()
                ->getPrevious()
                ->getPrevious()
                ->getData()
        );

        $this->linkedList->deleteFirst();

        $this->assertSame(2, $this->linkedList->count());
        $this->assertSame("map", $this->linkedList->getHead()->getData());
        $this->assertSame(
            "map",
            $this
                ->linkedList
                ->getTail()
                ->getPrevious()
                ->getData()
        );

        $this->linkedList->deleteFirst();

        $this->assertSame(1, $this->linkedList->count());
        $this->assertSame("linkedList", $this->linkedList->getHead()->getData());
        $this->assertSame("linkedList", $this->linkedList->getTail()->getData());

        $this->linkedList->deleteFirst();

        $this->assertSame(0, $this->linkedList->count());
        $this->assertSame(null, $this->linkedList->getHead());
        $this->assertSame(null, $this->linkedList->getTail());

        $this->expectException(LinkedListNodeNotFound::class);

        $this->linkedList->deleteFirst();
    }

    /**
     * @throws LinkedListNodeNotFound
     */
    public function testDeleteLast()
    {
        $this->setUpLinkedList();

        $this->assertSame(10, $this->linkedList->count());
        $this->assertSame("heaps", $this->linkedList->getHead()->getData());
        $this->assertSame("linkedList", $this->linkedList->getTail()->getData());

        $this->linkedList->deleteLast();

        $this->assertSame(9, $this->linkedList->count());
        $this->assertSame(
            "doubly",
            $this
                ->linkedList
                ->getHead()
                ->getNext()
                ->getData()
        );
        $this->assertSame("map", $this->linkedList->getTail()->getData());

        $this->linkedList->deleteLast();

        $this->assertSame(8, $this->linkedList->count());
        $this->assertSame(
            "stack",
            $this
                ->linkedList
                ->getHead()
                ->getNext()
                ->getNext()
                ->getData()
        );
        $this->assertSame("singly", $this->linkedList->getTail()->getData());

        $this->linkedList->deleteLast();

        $this->assertSame(7, $this->linkedList->count());
        $this->assertSame(
            "hashMap",
            $this
                ->linkedList
                ->getHead()
                ->getNext()
                ->getNext()
                ->getNext()
                ->getData()
        );
        $this->assertSame("binary", $this->linkedList->getTail()->getData());

        $this->linkedList->deleteLast();

        $this->assertSame(6, $this->linkedList->count());
        $this->assertSame(
            "queue",
            $this
                ->linkedList
                ->getHead()
                ->getNext()
                ->getNext()
                ->getNext()
                ->getNext()
                ->getData()
        );
        $this->assertSame("set", $this->linkedList->getTail()->getData());

        $this->linkedList->deleteLast();

        $this->assertSame(5, $this->linkedList->count());
        $this->assertSame(
            "queue",
            $this
                ->linkedList
                ->getHead()
                ->getNext()
                ->getNext()
                ->getNext()
                ->getNext()
                ->getData()
        );
        $this->assertSame("queue", $this->linkedList->getTail()->getData());

        $this->linkedList->deleteLast();

        $this->assertSame(4, $this->linkedList->count());
        $this->assertSame(
            "hashMap",
            $this
                ->linkedList
                ->getHead()
                ->getNext()
                ->getNext()
                ->getNext()
                ->getData()
        );
        $this->assertSame("hashMap", $this->linkedList->getTail()->getData());

        $this->linkedList->deleteLast();

        $this->assertSame(3, $this->linkedList->count());
        $this->assertSame(
            "stack",
            $this
                ->linkedList
                ->getHead()
                ->getNext()
                ->getNext()
                ->getData()
        );
        $this->assertSame("stack", $this->linkedList->getTail()->getData());

        $this->linkedList->deleteLast();

        $this->assertSame(2, $this->linkedList->count());
        $this->assertSame(
            "doubly",
            $this
                ->linkedList
                ->getHead()
                ->getNext()
                ->getData()
        );
        $this->assertSame("doubly", $this->linkedList->getTail()->getData());

        $this->linkedList->deleteLast();

        $this->assertSame(1, $this->linkedList->count());
        $this->assertSame("heaps", $this->linkedList->getHead()->getData());
        $this->assertSame("heaps", $this->linkedList->getTail()->getData());

        $this->linkedList->deleteLast();

        $this->assertSame(0, $this->linkedList->count());
        $this->assertSame(null, $this->linkedList->getHead());
        $this->assertSame(null, $this->linkedList->getTail());

        $this->expectException(LinkedListNodeNotFound::class);

        $this->linkedList->deleteLast();
    }

    public function testGetAllForEmpty()
    {
        $this->assertEmpty($this->linkedList->getAll());
    }

    public function elementsListProvider(): array
    {
        return [
            [function () {return new \stdClass();}],
            [null],
            [25],
            ["foo"],
            [true],
            [0],
            [''],
            [40.404],
            [[]],
        ];
    }

    private function setUpLinkedList()
    {
        $this
            ->linkedList
            ->addFirst("set")
            ->addLast("map")
            ->addFirst("hashMap")
            ->addFirst("stack")
            ->addLast("linkedList")
            ->addFirst("heaps")
            ->add("doubly", 1, LinkedListInterface::ASC, true)
            ->add("singly", 4, LinkedListInterface::ASC, false)
            ->add("binary", 2, LinkedListInterface::DESC, true)
            ->add("queue", 5, LinkedListInterface::DESC, false)
        ;
    }
}
