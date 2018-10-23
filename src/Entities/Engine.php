<?php
declare(strict_types=1);

namespace Gatherer\Entities;

use Gatherer\Service\Transporter;

abstract class Engine
{
    protected $transporter;

    public function setTransporter(Transporter $transporter): void
    {
        $this->transporter = $transporter;
    }

    abstract function search(string $keyword = ''): \Generator;
}
