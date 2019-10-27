<?php

declare(strict_types=1);

namespace ProjectX\DataStructure\Test;

use PHPUnit\Framework\TestCase;
use ProjectX\DataStructure\Queue;
use ProjectX\DataStructure\Stack;

class AbstractOrderedObjectSequence extends TestCase
{
    /** @var Stack|Queue */
    protected $seriesOfOrderedObjects;

    public function testPeekReturnsNull(): void
    {
        $this->assertNull($this->seriesOfOrderedObjects->peek(), "The stack does not return null!");
    }

    /**
     * @dataProvider itemsProvider
     *
     * @param mixed ...$args
     */
    public function testPeek(...$args): void
    {
        $this->seriesOfOrderedObjects->setStackItems($args);

        $this->assertSame($args[$this->seriesOfOrderedObjects->count() - 1], $this->seriesOfOrderedObjects->peek(), "The peek() method does not return last item!");
    }

    /**
     * @dataProvider itemsProvider
     *
     * @param mixed ...$args
     */
    public function testGetAndSetItems(...$args): void
    {
        $this->seriesOfOrderedObjects->setStackItems($args);

        $this->assertSame($args, $this->seriesOfOrderedObjects->getStackItems(), "The stack does not container correct items!");
    }

    /**
     * @dataProvider itemsProvider
     *
     * @param mixed ...$args
     */
    public function testReverseStack(...$args): void
    {
        $this->seriesOfOrderedObjects->setStackItems($args);

        $expected = array_reverse($this->seriesOfOrderedObjects->getStackItems());

        $this->assertSame($expected, $this->seriesOfOrderedObjects->reverseStack()->getStackItems(), "The reversed stack is incorrect!");
    }

    public function testEmpty(): void
    {
        $this->assertEmpty($this->seriesOfOrderedObjects->getStackitems(), "The stack is not empty!");
    }

    /**
     * @dataProvider itemsProvider
     *
     * @param mixed ...$args
     */
    public function testCount(...$args): void
    {
        $length = count($args);

        $this->seriesOfOrderedObjects->setStackItems([1, true, '', (new \stdClass()), 1.4, function() {}, "/stuff/"]);
        $this->seriesOfOrderedObjects->setStackItems($args);

        $this->assertSame($args[$length - 1] + 7, $this->seriesOfOrderedObjects->count());
    }

    /**
     * @return array
     */
    public function itemsProvider(): array
    {
        return [
            [0, null, '', "foo", false, function () {return "closure";}, 7],
            [2, 4, 6, 4],
            ["foo", "bar", "foobar", 4],
            ["foo", 20, '', 10.404, null, true, ["foo", "bar"], function () {return new \stdClass();}, 9],
        ];
    }
}
