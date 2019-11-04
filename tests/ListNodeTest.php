<?php

declare(strict_types=1);

namespace ProjectX\DataStructure\Test;

use PHPUnit\Framework\TestCase;
use ProjectX\DataStructure\ListNode;

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

    public function testSetDataGetDataAndCount()
    {
        $this->node->setData("foo");

        $this->assertNotNull($this->node->getData());
        $this->assertSame("foo", $this->node->getData());
        $this->assertSame(1, $this->node->count());
        $this->assertSame(null, $this->node->getInsertOrderIndex());
    }

    public function listNodeProvider(): array
    {
        return [
            [null],
            [true],
            [0],
            [''],
            ["foo"],
            [25],
            [40.404],
            [[]],
            [new \stdClass()],
            [function () {return "closure";}],
        ];
    }
}
