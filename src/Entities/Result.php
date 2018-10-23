<?php
declare(strict_types=1);

namespace Latanskaya\Gatherer\Entities;

class Result
{
    protected $title;
    protected $url;
    protected $source;

    public function __construct(string $source, string $title, string $url)
    {
        $this->source = [$source];
        $this->title = $title;
        $this->url = $url;
    }

    public function getSource(): array
    {
        return $this->source;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function addSource(array $source): void
    {
        $this->source = array_unique(array_merge($this->source, $source));
    }
}
