<?php
declare(strict_types=1);

use Gatherer\Entities\GoogleEngine;
use Gatherer\Entities\YahooEngine;
use PHPUnit\Framework\TestCase;
use Gatherer\Collector;
use Gatherer\Builder\GoogleEngineBuilder;
use Gatherer\Builder\YahooEngineBuilder;
use Gatherer\Exception\NoSearchEnginesFoundException;
use Gatherer\Collection\EngineCollection;
use Gatherer\Collection\ResultCollection;
use Gatherer\Entities\Result;

final class CollectorTest extends TestCase
{
    private $collector;
    private $googleEngineBuilder;
    private $yahooEngineBuilder;

    public function setUp(): void
    {
        $this->collector = new Collector();
        $this->googleEngineBuilder = new GoogleEngineBuilder();
        $this->yahooEngineBuilder = new YahooEngineBuilder();
    }

    public function testEmptyEngines(): void
    {
        $this->expectException(NoSearchEnginesFoundException::class);
        $this->collector->getSearchResult('test message');
    }

    public function testAddEngine(): void
    {
        $googleEngine = $this->googleEngineBuilder->getEngine();
        $this->collector->addEngine($googleEngine);

        $this->assertInstanceOf(EngineCollection::class, $this->collector->getEngines());
        $this->assertEquals(1, $this->collector->getEngines()->count());

        $yahooEngine = $this->yahooEngineBuilder->getEngine();
        $this->collector->addEngine($yahooEngine);
        $this->assertEquals(2, $this->collector->getEngines()->count());
    }

    public function testSearchEmptySet(): void
    {
        $googleEngine = $this->googleEngineBuilder->getEngine();
        $this->collector->addEngine($googleEngine);

        $yahooEngine = $this->yahooEngineBuilder->getEngine();
        $this->collector->addEngine($yahooEngine);

        $result = $this->collector->getSearchResult('');
        $this->assertInstanceOf(ResultCollection::class, $result);
        $this->assertEquals(true, $result->isEmpty());
    }

    public function testMockedOneEngineNoDuplicatesSearch(): void
    {
        $engine = $this->getMockBuilder(GoogleEngine::class)->getMock();
        $engine->method('search')->will(
            $this->returnCallback(function () {
                $data = [
                    new Result('google engine', 'title', 'http://url.com'),
                    new Result('google engine', 'title1', 'http://url-test.com')
                ];
                foreach ($data as $e) {
                    yield $e;
                }
            })
        );

        $mockGoogleEngineBuilder = $this->getMockBuilder(GoogleEngineBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();
        $mockGoogleEngineBuilder->method('getEngine')
            ->willReturn($engine);

        $this->collector->addEngine($mockGoogleEngineBuilder->getEngine());
        $result = $this->collector->getSearchResult('test');
        $this->assertInstanceOf(ResultCollection::class, $result);
        $this->assertEquals(2, $result->count());

        $expected_res = [
            [
                'Title' => 'title',
                'Url'   => 'http://url.com',
                'Source'    => ['google engine']
            ],
            [
                'Title' => 'title1',
                'Url'   => 'http://url-test.com',
                'Source'    => ['google engine']
            ]
        ];

        $this->assertEquals($expected_res, $result->toArray());
    }

    public function testMockedTwoEnginesWithDuplicatesSearch(): void
    {
        $googleEngine = $this->getMockBuilder(GoogleEngine::class)->getMock();
        $googleEngine->method('search')->will(
            $this->returnCallback(function () {
                $data = [
                    new Result('google engine', 'title', 'http://url.com'),
                    new Result('google engine', 'title1', 'http://url-test.com')
                ];
                foreach ($data as $e) {
                    yield $e;
                }
            })
        );

        $mockGoogleEngineBuilder = $this->getMockBuilder(GoogleEngineBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();
        $mockGoogleEngineBuilder->method('getEngine')
            ->willReturn($googleEngine);

        $yahooEngine = $this->getMockBuilder(YahooEngine::class)->getMock();
        $yahooEngine->method('search')->will(
            $this->returnCallback(function () {
                $data = [
                    new Result('yahoo engine', 'title', 'http://url.com'),
                    new Result('yahoo engine', 'title1', 'http://url-yahoo.com')
                ];
                foreach ($data as $e) {
                    yield $e;
                }
            })
        );

        $mockYahooEngineBuilder = $this->getMockBuilder(YahooEngineBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();
        $mockYahooEngineBuilder->method('getEngine')
            ->willReturn($yahooEngine);

        $this->collector->addEngine($mockGoogleEngineBuilder->getEngine());
        $this->collector->addEngine($mockYahooEngineBuilder->getEngine());

        $result = $this->collector->getSearchResult('test');
        $this->assertInstanceOf(ResultCollection::class, $result);
        $this->assertEquals(3, $result->count());

        $expected_res = [
            [
                'Title' => 'title',
                'Url'   => 'http://url.com',
                'Source'    => ['google engine', 'yahoo engine']
            ],
            [
                'Title' => 'title1',
                'Url'   => 'http://url-test.com',
                'Source'    => ['google engine']
            ],
            [
                'Title' => 'title1',
                'Url'   => 'http://url-yahoo.com',
                'Source'    => ['yahoo engine']
            ]
        ];

        $this->assertEquals($expected_res, $result->toArray());
    }

    public function testRealEngines(): void
    {
        $googleEngineBuilder = new GoogleEngineBuilder();

        foreach ($googleEngineBuilder->getEngine()->search('test') as $res) {
           $this->assertInstanceOf(Result::class, $res);
        }

        $yahooEngineBuilder = new YahooEngineBuilder();

        foreach ($yahooEngineBuilder->getEngine()->search('test') as $res) {
            $this->assertInstanceOf(Result::class, $res);
        }

        $this->collector->addEngine($googleEngineBuilder->getEngine());
        $this->collector->addEngine($yahooEngineBuilder->getEngine());

        $result = $this->collector->getSearchResult('test')->toArray();
        $this->assertInternalType('array', $result);
    }
}
