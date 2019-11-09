<?php

declare(strict_types=1);

namespace ProjectX\DataStructure\Test;

use PHPUnit\Framework\TestCase;
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

    public function testAddFirstAddLastAddFind()
    {
        $this->linkedList
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
            ->getInsertOrderIndex()
        );
        $this->assertSame(4, $this->linkedList
            ->getHead()
            ->getNext()
            ->getNext()
            ->getInsertOrderIndex()
        );
        $this->assertSame("hashMap", $this->linkedList->find(3, LinkedListInterface::ASC)->getData());
        $this->assertSame("map", $this->linkedList->find(1, LinkedListInterface::DESC)->getData());
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
}
