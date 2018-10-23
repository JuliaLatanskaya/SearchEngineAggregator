# SearchEngineAggregator
Simple search result aggregator library

Synopsis
==============
The search engine aggregator combines the results from the first page of Google and Yahoo search engines.

Another Search Engine can be added by extending ``` Latanskaya\Gatherer\Entities\Engine::class ```.
Note that ``` Latanskaya\Gatherer\Entities\Engine->search() ``` has to ``` yield Latanskaya\Gatherer\Entities\Result instance ```

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
	git clone https://github.com/JuliaLatanskaya/SearchEngineAggregator.git .
    ```
    
- Install dependencies

    ```
	composer install
    ```
    
How to use library
--------------
   ```
    require 'vendor/autoload.php';

    $collector = new Latanskaya\Gatherer\Collector();
    $engineBuilder = new Latanskaya\Gatherer\Builder\GoogleEngineBuilder();
    $collector->addEngine($engineBuilder->getEngine());
    $collector->getSearchResult('keyword for search')->toArray();
   ```

    
How to run tests
--------------

In root folder run:
```
./vendor/bin/phpunit tests/
```
