<?php
declare(strict_types=1);

namespace Latanskaya\Gatherer\Entities;

use Latanskaya\Gatherer\Service\Transporter;

/**
 * Class Engine
 *
 * New Search Engine can be added by extending this class.
 * Note that Latanskaya\Gatherer\Entities\Engine->search() has to yield Latanskaya\Gatherer\Entities\Result instance
 * @package Latanskaya\Gatherer\Entities
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
