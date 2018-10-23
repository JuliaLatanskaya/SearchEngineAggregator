<?php
declare(strict_types=1);

namespace Gatherer\Entities;

use Gatherer\Service\Transporter;

/**
 * Class Engine
 *
 * New Search Engine can be added by extending this class.
 * Note that Gatherer\Entities\Engine->search() has to yield Gatherer\Entities\Result instance
 * @package Gatherer\Entities
 */

abstract class Engine
{
    protected $transporter;

    public function setTransporter(Transporter $transporter): void
    {
        $this->transporter = $transporter;
    }

    abstract function search(string $keyword = ''): \Generator;
}
