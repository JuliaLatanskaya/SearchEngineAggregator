<?php
declare(strict_types=1);

namespace Latanskaya\Gatherer\Collection;

abstract class AbstractCollection
{
    protected $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function isEmpty(): bool
    {
        return !\count($this->items);
    }

    public function add($item): void
    {
        $this->items[] = $item;
    }

    public function count(): int
    {
        return \count($this->items);
    }

    public function generate(): \Generator
    {
        foreach ($this->items as $item) {
            yield $item;
        }
    }
}
