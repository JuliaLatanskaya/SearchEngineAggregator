<?php
declare(strict_types=1);

namespace Gatherer\Builder;

use Gatherer\Entities\Engine;
use Gatherer\Exception\TypeMismatchException;
use Gatherer\Service\Transporter;

class AbstractEngineBuilder
{
    protected $transporter;
    protected $engine;

    public function __construct()
    {
        if (!($this->engine instanceof Engine)) {
            throw new TypeMismatchException('Engine was not set up correctly');
        }

        if (!($this->transporter instanceof Transporter)) {
            throw new TypeMismatchException('Transporter was not set up correctly');
        }

        $this->build();
    }

    public function getEngine(): Engine
    {
        return $this->engine;
    }

    private function build()
    {
        $this->engine->setTransporter($this->transporter);
    }
}
