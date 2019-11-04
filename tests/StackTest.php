<?php

declare(strict_types=1);

namespace ProjectX\DataStructure\Test;

use Generator;
use ProjectX\DataStructure\Stack;

class StackTest extends AbstractOrderedObjectSequence
{
    public function setUp(): void
    {
        $this->seriesOfOrderedObjects = new Stack();
    }

    public function tearDown(): void
    {
        $this->seriesOfOrderedObjects = null;
    }

    /**
     * @dataProvider itemsProvider
     *
     * @param mixed ...$args
     */
    public function testStackConstructor(...$args)
    {
        if (null !== $this->seriesOfOrderedObjects) {
            $this->seriesOfOrderedObjects = null;
        }

        $this->seriesOfOrderedObjects = new Stack($args);

        $this->assertNotEmpty($this->seriesOfOrderedObjects->getSequenceItems(), "The seriesOfOrderedObjects is empty!");
        $this->assertSame($args[count($args) - 1], $this->seriesOfOrderedObjects->peek(), "The peek method does not return a correct item!");
        $this->assertSame(count($args), $this->seriesOfOrderedObjects->count(), "The items quantity does not match");

        $this->seriesOfOrderedObjects->pop();
        array_pop($args);

        $this->assertSame($args, $this->seriesOfOrderedObjects->getSequenceItems(), "The items do not match!");
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
        $this->assertNotEmpty($this->seriesOfOrderedObjects->setSequenceItems([$foo, $bar, $fooBar]), "The stack is empty!");
    }

    /**
     * @dataProvider itemsProvider
     *
     * @param array ...$args
     */
    public function testPush(...$args): void
    {
        foreach ($args as $arg) {
            $this->seriesOfOrderedObjects->push($arg);
        }

        $this->assertSame($args, $this->seriesOfOrderedObjects->getSequenceItems(), "The stack does not contain all data!");
        $this->assertSame(count($args), $this->seriesOfOrderedObjects->count(), "Elements quantity of the stack should be: " . count($args));
    }

    public function testPopReturnsNull(): void
    {
        $this->assertNull($this->seriesOfOrderedObjects->pop(), "The stack does not return null!");
    }

    /**
     * @dataProvider itemsProvider
     *
     * @param mixed ...$args
     */
    public function testPop(...$args): void
    {
        $this->seriesOfOrderedObjects->setSequenceItems($args);

        $actual = array_pop($args);
        $expected = $this->seriesOfOrderedObjects->pop();

        $this->assertSame($expected, $actual, "The popped off element does not match!");
        $this->assertSame($args, $this->seriesOfOrderedObjects->getSequenceItems(), "The stack does not correct items!");
        $this->assertSame(count($args), $this->seriesOfOrderedObjects->count(), "Elements quantity of the stack should be: " . count($args));
    }

    /**
     * @dataProvider itemsProvider
     *
     * @param mixed ...$args
     */
    public function testLifoGenerator(...$args): void
    {
        $this->seriesOfOrderedObjects->setSequenceItems($args);

        $generator = $this->seriesOfOrderedObjects->lifoGenerator();

        $this->assertInstanceOf(Generator::class, $generator, "The method does not return Generator instance!");

        $length = $this->seriesOfOrderedObjects->count() - 1;

        foreach ($generator as $item) {
            $this->assertSame($args[$length], $item, "The Generator does not return items in correct order!");

            --$length;
        }
    }
}
