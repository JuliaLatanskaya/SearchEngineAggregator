<?php
declare(strict_types=1);

namespace Latanskaya\Gatherer\Collection;

use Latanskaya\Gatherer\Entities\Engine;

class EngineCollection extends AbstractCollection
{
    public function add($item): void
    {
        if (!($item instanceof Engine)) {
            throw new TypeMismatchException('This collection accepts only Latanskaya\Gatherer\Entities\Engine instances');
        }

        parent::add($item);
    }
}
