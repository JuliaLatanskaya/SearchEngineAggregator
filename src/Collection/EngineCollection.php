<?php
declare(strict_types=1);

namespace Gatherer\Collection;

use Gatherer\Entities\Engine;

class EngineCollection extends AbstractCollection
{
    public function add($item): void
    {
        if (!($item instanceof Engine)) {
            throw new TypeMismatchException('This collection accepts only Gatherer\Entities\Engine instances');
        }

        parent::add($item);
    }
}
