<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Latanskaya\Gatherer\Collection\AbstractCollection;

final class AbstractCollectionTest extends TestCase
{
    private $collection;

    public function setUp()
    {
        $this->collection = new class extends AbstractCollection {};
    }

    public function testIsEmpty(): void
    {
        $this->assertEquals(true, $this->collection->isEmpty());
    }

    public function testAdd(): void
    {
        $this->collection->add(1);
        $this->assertEquals(false, $this->collection->isEmpty());
    }

    public function testCount(): void
    {
        $this->collection->add(1);
        $this->assertEquals(1, $this->collection->count());
        $this->collection->add(2);
        $this->assertEquals(2, $this->collection->count());
    }

    public function testGenerate(): void
    {
        $this->collection->add(1);
        $this->collection->add(2);
        $this->collection->add(3);

        $res = [];

        foreach ($this->collection->generate() as $value) {
            $res[] = $value;
        }

        $this->assertEquals([1,2,3], $res);
    }
}
