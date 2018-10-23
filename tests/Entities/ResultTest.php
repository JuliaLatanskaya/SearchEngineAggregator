<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Gatherer\Entities\Result;

final class ResultTest extends TestCase
{
    private $result;
    const TITLE = 'title';
    const URL = 'www.url.com';
    const SOURCE = 'search';

    public function setUp()
    {
        $this->result = new Result(self::SOURCE, self::TITLE, self::URL);
    }

    public function testGetSource()
    {
        $this->assertInternalType('array', $this->result->getSource());
        $this->assertEquals([self::SOURCE], $this->result->getSource());
    }

    public function testGetTitle()
    {
       $this->assertInternalType('string', $this->result->getTitle());
       $this->assertEquals(self::TITLE, $this->result->getTitle());
    }

    public function testGetUrl()
    {
        $this->assertInternalType('string', $this->result->getUrl());
        $this->assertEquals(self::URL, $this->result->getUrl());
    }

    public function testAddSource()
    {
        $this->result->addSource(['search1']);
        $this->assertInternalType('array', $this->result->getSource());
        $this->assertEquals([self::SOURCE, 'search1'], $this->result->getSource());

        $this->result->addSource([self::SOURCE]);
        $this->assertInternalType('array', $this->result->getSource());
        $this->assertEquals([self::SOURCE, 'search1'], $this->result->getSource());
    }
}
