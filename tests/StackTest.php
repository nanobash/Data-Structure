<?php

declare(strict_types=1);

namespace ProjectX\DataStructure\Test;

use Generator;
use PHPUnit\Framework\TestCase;
use ProjectX\DataStructure\Stack;

class StackTest extends TestCase
{
    private $stack;

    public function setUp(): void
    {
        $this->stack = new Stack();
    }

    public function tearDown(): void
    {
        $this->stack = null;
    }

    /**
     * @dataProvider itemsProviderForToString
     *
     * @param mixed $args
     */
    public function testToString(...$args): void
    {
        $expected = array_pop($args);

        $this->stack->setStackItems($args);

        $this->expectOutputString($expected);

        echo $this->stack;
    }

    /**
     * @dataProvider itemsProvider
     *
     * @param mixed $foo
     * @param mixed $bar
     * @param mixed $fooBar
     */
    public function testPushNotEmpty($foo, $bar, $fooBar): void
    {
        $this->assertNotEmpty($this->stack->setStackItems([$foo, $bar, $fooBar]), "The stack is empty!");
    }

    /**
     * @dataProvider itemsProvider
     *
     * @param array ...$args
     */
    public function testPush(...$args): void
    {
        $this->stack->setStackItems($args);

        $this->assertSame($args, $this->stack->getStackItems(), "The stack does not contain all data!");
    }

    public function testPopReturnsNull(): void
    {
        $this->assertNull($this->stack->pop(), "The stack does not return null!");
    }

    /**
     * @dataProvider itemsProvider
     *
     * @param mixed ...$args
     */
    public function testPop(...$args): void
    {
        $this->stack->setStackItems($args);

        $actual = array_pop($args);
        $expected = $this->stack->pop();

        $this->assertSame($expected, $actual, "The popped off element does not match!");
        $this->assertSame($args, $this->stack->getStackItems(), "The stack does not correct items!");
    }

    public function testPeekReturnsNull(): void
    {
        $this->assertNull($this->stack->peek(), "The stack does not return null!");
    }

    /**
     * @dataProvider itemsProvider
     *
     * @param mixed ...$args
     */
    public function testPeek(...$args): void
    {
        $this->stack->setStackItems($args);

        $this->assertSame($args[$this->stack->getCount() - 1], $this->stack->peek(), "The peek() method does not return last item!");
    }

    /**
     * @dataProvider itemsProvider
     *
     * @param mixed ...$args
     */
    public function testGetAndSetItems(...$args): void
    {
        $this->stack->setStackItems($args);

        $this->assertSame($args, $this->stack->getStackItems(), "The stack does not container correct items!");
    }

    /**
     * @dataProvider itemsProvider
     *
     * @param mixed ...$args
     */
    public function testReverseStack(...$args): void
    {
        $this->stack->setStackItems($args);

        $expected = array_reverse($this->stack->getStackItems());

        $this->assertSame($expected, $this->stack->reverseStack()->getStackItems(), "The reversed stack is incorrect!");
    }

    /**
     * @dataProvider itemsProvider
     *
     * @param mixed ...$args
     */
    public function testLifoGenerator(...$args): void
    {
        $this->stack->setStackItems($args);

        $generator = $this->stack->lifoGenerator();

        $this->assertInstanceOf(Generator::class, $generator, "The method does not return Generator instance!");

        $length = $this->stack->getCount() - 1;

        foreach ($generator as $item) {
            $this->assertSame($args[$length], $item, "The Generator does not return items in correct order!");

            --$length;
        }
    }

    public function testEmpty(): void
    {
        $this->assertEmpty($this->stack->getStackitems(), "The stack is not empty!");
    }

    /**
     * @dataProvider itemsProvider
     *
     * @param mixed ...$args
     */
    public function testCount(...$args): void
    {
        $length = count($args);

        $this->stack->push('foo');
        $this->stack->setStackItems([1, true, '', (new \stdClass()), 1.4, function() {}, "/stuff/"]);
        $this->stack->setStackItems($args);
        $this->stack->pop();

        $this->assertSame($args[$length - 1] + 7, $this->stack->getCount());
    }

    /**
     * @return array
     */
    public function itemsProviderForToString()
    {
        return [
            [true, 2, 4.5, "1, 2, 4.5"],
            [false, null, '', ''],
            ["foo", "bar", "foo, bar"],
            [new Stack(), [], 10, false, "10"],
            [new \stdClass(), function () {}, 100, "fooBar", null, true, "100, fooBar, , 1"],
        ];
    }

    /**
     * @return array
     */
    public function itemsProvider(): array
    {
        return [
            [2, 4, 6, 4],
            [0, null, '', "foo", false, function () {return "closure";}, 7],
            ["foo", "bar", "foobar", 4],
            ["foo", 20, '', 10.404, null, true, ["foo", "bar"], (new \stdClass()), 9]
        ];
    }
}
