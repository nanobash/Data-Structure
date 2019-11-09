<?php

declare(strict_types=1);

namespace ProjectX\DataStructure\Test;

use PHPUnit\Framework\TestCase;
use ProjectX\DataStructure\ListNode;
use ReflectionClass;
use ReflectionException;

class ListNodeTest extends TestCase
{
    private $node = null;

    public function setUp(): void
    {
        $this->node = new ListNode(null);
    }

    public function tearDown(): void
    {
        $this->node = null;
    }

    /**
     * @dataProvider listNodeProvider
     *
     * @param mixed $data
     */
    public function testConstructorSetDataGetData($data)
    {
        $this->node = new ListNode($data);

        if ($data === null) {
            $this->assertNull($this->node->getData());
        } else {
            $this->assertNotNull($this->node->getData());
        }

        $this->assertSame($data, $this->node->getData());
    }

    /**
     * @dataProvider listNodeProvider
     *
     * @param mixed $data
     */
    public function testSetDataGetDataAndCount($data)
    {
        $this->node->setData($data);

        if (null === $data) {
            $this->assertNull($this->node->getData());
        } else {
            $this->assertNotNull($this->node->getData());
        }

        $this->assertSame($data, $this->node->getData());
        $this->assertSame(null === $data ? 0 : 1, $this->node->count());
        $this->assertSame(null, $this->node->getInsertOrderIndex());
    }

    /**
     * @throws ReflectionException
     */
    public function testSetNext()
    {
        $newNode = new ListNode("foo");

        $reflection = new ReflectionClass($this->node);
        $method = $reflection->getMethod("setNext");
        $method->setAccessible(true);

        $method->invoke($this->node, $newNode);

        $this->assertSame("foo", $this->node->getNext()->getData());
    }

    /**
     * @throws ReflectionException
     */
    public function testSetPrevious()
    {
        $newNode = new ListNode("bar");

        $reflection = new ReflectionClass($this->node);
        $method = $reflection->getMethod("setPrevious");
        $method->setAccessible(true);

        $method->invoke($this->node, $newNode);

        $this->assertSame("bar", $this->node->getPrevious()->getData());
    }

    /**
     * @throws ReflectionException
     */
    public function testSetInsertOrderIndex()
    {
        $reflection = new ReflectionClass($this->node);
        $method = $reflection->getMethod("setInsertOrderIndex");
        $method->setAccessible(true);

        $method->invoke($this->node, 9);

        $this->assertSame(10, $this->node->getInsertOrderIndex());
    }

    public function listNodeProvider(): array
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
