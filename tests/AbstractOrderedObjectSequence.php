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
        $this->assertNull($this->seriesOfOrderedObjects->peek(), "The ordered object sequence does not return null!");
    }

    /**
     * @dataProvider itemsProvider
     *
     * @param mixed ...$args
     */
    public function testPeek(...$args): void
    {
        $this->seriesOfOrderedObjects->setSequenceItems($args);

        $this->assertSame($args[$this->seriesOfOrderedObjects->count() - 1], $this->seriesOfOrderedObjects->peek(), "The peek() method does not return last item!");
    }

    /**
     * @dataProvider itemsProvider
     *
     * @param mixed ...$args
     */
    public function testGetAndSetItems(...$args): void
    {
        $this->seriesOfOrderedObjects->setSequenceItems($args);

        $this->assertSame($args, $this->seriesOfOrderedObjects->getSequenceItems(), "The ordered object sequence does not container correct items!");
        $this->assertNotTrue($this->seriesOfOrderedObjects->isEmpty(), "The ordered objects sequence is not empty!");
    }

    /**
     * @dataProvider itemsProvider
     *
     * @param mixed ...$args
     */
    public function testReverseStack(...$args): void
    {
        $this->seriesOfOrderedObjects->setSequenceItems($args);

        $expected = array_reverse($this->seriesOfOrderedObjects->getSequenceItems());

        $this->assertSame($expected, $this->seriesOfOrderedObjects->reverseSequence()->getSequenceItems(), "The reversed stack is incorrect!");
    }

    public function testEmpty(): void
    {
        $this->assertTrue($this->seriesOfOrderedObjects->isEmpty(), "The ordered object sequence is not empty!");
    }

    public function testOffsetShouldNotExist(): void
    {
        $this->seriesOfOrderedObjects->setSequenceItems(["foo", "bar", "fooBar"]);

        $this->assertNotTrue($this->seriesOfOrderedObjects->offsetExists(3), "The offset 3 should not exist!");
        $this->assertNull($this->seriesOfOrderedObjects->offsetGet(3), "The offset 3 should not retrieve an item!");
    }

    public function testOffsetShouldExist()
    {
        $this->seriesOfOrderedObjects->setSequenceItems(["foo", "bar", "fooBar"]);

        $this->assertTrue($this->seriesOfOrderedObjects->offsetExists(0), "The offset 0 should exist!");
        $this->assertSame("foo", $this->seriesOfOrderedObjects->offsetGet(0), "The item should be 'foo'!");
        $this->assertSame("bar", $this->seriesOfOrderedObjects->offsetGet(1), "The item should be 'bar'!");
        $this->assertSame("fooBar", $this->seriesOfOrderedObjects->offsetGet(2), "The item should be 'fooBar'!");
    }

    public function testOffsetSetAndUnset()
    {
        $this
            ->seriesOfOrderedObjects
            ->offsetSet(0, "foo")
            ->offsetSet(1, "bar")
            ->offsetSet(2, "fooBar");

        $this
            ->seriesOfOrderedObjects
            ->offsetUnset(0)
            ->offsetUnset(1)
            ->offsetUnset(2);

        $this->assertNotTrue($this->seriesOfOrderedObjects->offsetExists(0));
        $this->assertNotTrue($this->seriesOfOrderedObjects->offsetExists(1));
        $this->assertNotTrue($this->seriesOfOrderedObjects->offsetExists(2));

        $this->assertNull($this->seriesOfOrderedObjects->offsetGet(0), "The item should not exist, and should be a null!");
        $this->assertNull($this->seriesOfOrderedObjects->offsetGet(1), "The item should not exist, and should be a null!");
        $this->assertNull($this->seriesOfOrderedObjects->offsetGet(2), "The item should not exist, and should be a null!");
    }

    /**
     * @dataProvider itemsProvider
     *
     * @param mixed ...$args
     */
    public function testCount(...$args): void
    {
        $length = count($args);

        $this->seriesOfOrderedObjects->setSequenceItems([1, true, '', (new \stdClass()), 1.4, function() {}, "/stuff/"]);
        $this->seriesOfOrderedObjects->setSequenceItems($args);

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
