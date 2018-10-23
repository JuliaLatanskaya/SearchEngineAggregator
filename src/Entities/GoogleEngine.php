<?php
declare(strict_types=1);

namespace Latanskaya\Gatherer\Entities;

use Symfony\Component\DomCrawler\Crawler;

class GoogleEngine extends Engine
{
    const URI = 'https://www.google.com';
    const SEARCH_PATH = '/search?q=';

    #TODO: Dependency Injection for DOMParser
    public function search(string $keyword = ''): \Generator
    {
        $responseBody = $this->transporter->getResponse(self::URI . self::SEARCH_PATH . $keyword);

        $crawler = new Crawler($responseBody);

        $results = $crawler->filter('div#res div.g')
            ->reduce(function (Crawler $node) {
                return $node->filter('h3.r')->count() && $node->filter('div.s cite')->count();
            })
            ->each(function (Crawler $node) {
                return new Result(
                    'google engine',
                    $node->filter('h3.r')->text(),
                    $node->filter('div.s cite')->text()
                );
        });

        foreach ($results as $result) {
            yield $result;
        }
    }
}
