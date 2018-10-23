<?php
declare(strict_types=1);

namespace Gatherer\Entities;

use Symfony\Component\DomCrawler\Crawler;

class YahooEngine extends Engine
{
    const URI = 'https://search.yahoo.com/';
    const SEARCH_PATH = 'search?p=';

    #TODO: Dependency Injection for DOMParser
    public function search(string $keyword = ''): \Generator
    {
        $responseBody = $this->transporter->getResponse(self::URI . self::SEARCH_PATH . $keyword);

        $crawler = new Crawler($responseBody);

        $results = $crawler->filter('div#web > ol > li')
            ->reduce(function (Crawler $node) {
                return $node->filter('h3.title a')->count() && $node->filter('h3.title + div span')->count();
            })
            ->each(function (Crawler $node) {
                return new Result(
                    'yahoo engine',
                    $node->filter('h3.title a')->text(),
                    $node->filter('h3.title + div span')->text()
                );
        });

        foreach ($results as $result) {
            yield $result;
        }
    }
}
