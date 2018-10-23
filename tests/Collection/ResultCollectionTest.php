<?php
declare(strict_types=1);

use Gatherer\Entities\Result;
use Gatherer\Exception\TypeMismatchException;
use PHPUnit\Framework\TestCase;
use Gatherer\Collection\ResultCollection;

final class ResultCollectionTest extends TestCase
{
    private $collection;

    public function setUp()
    {
        $this->collection = new ResultCollection();
    }

    public function testExceptionWrongItemAdded(): void
    {
        $this->expectException(TypeMismatchException::class);
        $this->collection->add('sting');
    }

    public function testAddResultItem(): void
    {
        $result1 = new Result('source', 'title', 'url');
        $this->collection->add($result1);

        $this->assertEquals(1, $this->collection->count());

        $result2 = new Result('source1', 'title1', 'url1');
        $this->collection->add($result2);

        $this->assertEquals(2, $this->collection->count());

        $result3 = new Result('source1', 'title', 'url');
        $this->collection->add($result3);

        $this->assertEquals(2, $this->collection->count());

        $expected = [
            [
                'Title' => 'title',
                'Url'   => 'url',
                'Source'    => ['source', 'source1']
            ],
            [
                'Title' => 'title1',
                'Url'   => 'url1',
                'Source'    => ['source1']
            ]
        ];

        $this->assertEquals($expected, $this->collection->toArray());
    }
}
