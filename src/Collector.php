<?php
declare(strict_types=1);

namespace Latanskaya\Gatherer;

use Latanskaya\Gatherer\Collection\ResultCollection;
use Latanskaya\Gatherer\Entities\Engine;
use Latanskaya\Gatherer\Collection\EngineCollection;
use Latanskaya\Gatherer\Exception\NoSearchEnginesFoundException;

/**
 * Class Collector
 * @package Gatherer
 * @throws NoSearchEnginesFoundException
 *
 * Implementation of Search Engine Aggregator.
 * Current version uses Google and Yahoo search engines
 *
 * Basic usage:
 *
 * $collector = new Latanskaya\Gatherer\Collector();
 * $engineBuilder = new Latanskaya\Gatherer\Builder\GoogleEngineBuilder();
 * $collector->addEngine($engineBuilder->getEngine());
 * $collector->getSearchResult('keyword for search')->toArray();
 *
 */
class Collector
{
    protected $search_engines;
    protected $results;

    public function __construct()
    {
        $this->search_engines = new EngineCollection();
        $this->results = new ResultCollection();
    }

    public function getSearchResult(string $keyword): ResultCollection
    {
        if ($this->search_engines->isEmpty()) {
            throw new NoSearchEnginesFoundException('No search engines found. Try to set one by calling addEngine() method');
        }

        if ($keyword) {
            #TODO: filterOut user input $keyword
            foreach ($this->search_engines->generate() as $engine) {
                foreach ($engine->search($keyword) as $res) {
                    $this->results->add($res);
                }
            }
        }

        return $this->results;
    }

    public function addEngine(Engine $engine): void
    {
        $this->search_engines->add($engine);
    }

    public function getEngines(): EngineCollection
    {
        return $this->search_engines;
    }
}
