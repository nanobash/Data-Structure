<?php

declare(strict_types=1);

namespace ProjectX\DataStructure\Test;

use Generator;
use ProjectX\DataStructure\Queue;

class QueueTest extends AbstractOrderedObjectSequence
{
    public function setUp(): void
    {
        $this->seriesOfOrderedObjects = new Queue();
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

        $this->seriesOfOrderedObjects = new Queue($args);

        $this->assertNotEmpty($this->seriesOfOrderedObjects->getStackItems(), "The seriesOfOrderedObjects is empty!");
        $this->assertSame($args[count($args) - 1], $this->seriesOfOrderedObjects->peek(), "The peek method does not return a correct item!");
        $this->assertSame(count($args), $this->seriesOfOrderedObjects->count(), "The items quantity does not match");

        $this->seriesOfOrderedObjects->dequeue();
        array_shift($args);

        $this->assertSame($args, $this->seriesOfOrderedObjects->getStackItems(), "The items do not match!");
    }

    /**
     * @dataProvider itemsProvider
     *
     * @param mixed $foo
     * @param mixed $bar
     * @param mixed $fooBar
     */
    public function testEnqueueNotEmpty($foo, $bar, $fooBar): void
    {
        $this->assertNotEmpty($this->seriesOfOrderedObjects->setStackItems([$foo, $bar, $fooBar]), "The stack is empty!");
    }

    /**
     * @dataProvider itemsProvider
     *
     * @param array ...$args
     */
    public function testEnqueue(...$args): void
    {
        foreach ($args as $arg) {
            $this->seriesOfOrderedObjects->enqueue($arg);
        }

        $this->assertSame($args, $this->seriesOfOrderedObjects->getStackItems(), "The stack does not contain all data!");
    }

    public function testDequeueReturnsNull(): void
    {
        $this->assertNull($this->seriesOfOrderedObjects->dequeue(), "The stack does not return null!");
    }

    /**
     * @dataProvider itemsProvider
     *
     * @param mixed ...$args
     */
    public function testDequeue(...$args): void
    {
        $this->seriesOfOrderedObjects->setStackItems($args);

        $actual = array_shift($args);
        $expected = $this->seriesOfOrderedObjects->dequeue();

        $this->assertSame($expected, $actual, "The dequeue element does not match!");
        $this->assertSame($args, $this->seriesOfOrderedObjects->getStackItems(), "The stack does not correct items!");
    }

    /**
     * @dataProvider itemsProvider
     *
     * @param mixed ...$args
     */
    public function testLifoGenerator(...$args): void
    {
        $this->seriesOfOrderedObjects->setStackItems($args);

        $generator = $this->seriesOfOrderedObjects->fifoGenerator();

        $this->assertInstanceOf(Generator::class, $generator, "The method does not return Generator instance!");

        $length = 0;

        foreach ($generator as $item) {
            $this->assertSame($args[$length], $item, "The Generator does not return items in correct order!");

            ++$length;
        }
    }
}
