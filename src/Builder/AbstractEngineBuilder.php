<?php
declare(strict_types=1);

namespace Latanskaya\Gatherer\Builder;

use Latanskaya\Gatherer\Entities\Engine;
use Latanskaya\Gatherer\Exception\TypeMismatchException;
use Latanskaya\Gatherer\Service\Transporter;

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
