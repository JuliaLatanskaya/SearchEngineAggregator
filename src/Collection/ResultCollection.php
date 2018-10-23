<?php
declare(strict_types=1);

namespace Gatherer\Collection;

use Gatherer\CollectionInterface;
use Gatherer\Entities\Result;
use Gatherer\Exception\TypeMismatchException;

class ResultCollection extends AbstractCollection
{
    public function add($item): void
    {
        if (!($item instanceof Result)) {
            throw new TypeMismatchException('This collection accepts only Gatherer\Entities\Result instances');
        }

        foreach ($this->generate() as $existedItem) {
            if (
                $item->getTitle() === $existedItem->getTitle() &&
                $this->compareUrl($item->getUrl(),$existedItem->getUrl()) &&
                $item->getSource() !== $existedItem->getSource()
            ) {
                $existedItem->addSource($item->getSource());
                return;
            }
        }

        parent::add($item);
    }

    private function compareUrl(string $url1, string $url2)
    {
        $string1 = \parse_url($url1, PHP_URL_HOST) . \parse_url($url1, PHP_URL_PATH);
        $string2 = \parse_url($url2, PHP_URL_HOST) . \parse_url($url2, PHP_URL_PATH);

        return $string1 === $string2;

    }

    public function toArray(): array
    {
        $result = [];
        foreach ($this->generate() as $item) {
            $result[] = [
                'Title'     => $item->getTitle(),
                'Url'       => $item->getUrl(),
                'Source'    => $item->getSource()
            ];
        }

        return $result;
    }
}
