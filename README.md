# SearchEngineAggregator
Simple search result aggregator library

Synopsis
==============
The search engine aggregator combines the results from the first page of Google and Yahoo search engines.

Another Search Engine can be added by extending ``` Gatherer\Entities\Engine::class ```.
Note that ``` Gatherer\Entities\Engine->search() ``` has to ``` yield Gatherer\Entities\Result instance ```

The result output is an array



Installation
==============
Requirements:
--------------
- PHP 7.2
- Installed composer (see https://getcomposer.org/)

How to install library
--------------
- clone repository https://github.com/JuliaLatanskaya/SearchEngineAggregator

	```
    https://github.com/JuliaLatanskaya/SearchEngineAggregator.git
    ```
    
- Install dependencies

    ```
	composer install
    ```
    
How to use library
--------------
   ```
    $collector = new Gatherer\Collector();
    $engineBuilder = new Gatherer\Builder\GoogleEngineBuilder();
    $collector->addEngine($engineBuilder->getEngine());
    $collector->getSearchResult('keyword for search')->toArray();
   ```

    
How to run tests
--------------

In root folder run:
```
./vendor/bin/phpunit tests/
```
