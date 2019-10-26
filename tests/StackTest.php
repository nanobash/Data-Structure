<?php

declare(strict_types=1);

namespace ProjectX\DataStructure\Test;

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

        $this->assertSame($args[count($args) - 1], $this->stack->peek(), "The peek() method does not return last item!");
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

        $this->assertSame($expected, $this->stack->reverseStack()->getStackItems());
    }

    public function testEmpty(): void
    {
        $this->assertEmpty($this->stack->getStackitems(), "The stack is not empty!");
    }

    /**
     * @return array
     */
    public function itemsProvider(): array
    {
        return [
            [2, 4, 6],
            [0, null, '', "foo", false],
            ["foo", "bar", "foobar"],
            ["foo", 20, "", null, true, ["foo", "bar"], (new \stdClass())]
        ];
    }
}