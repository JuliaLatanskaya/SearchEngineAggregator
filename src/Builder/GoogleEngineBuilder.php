<?php
declare(strict_types=1);

namespace Gatherer\Builder;

use Gatherer\Entities\GoogleEngine;
use Gatherer\Service\GuzzleTransporter;

class GoogleEngineBuilder extends AbstractEngineBuilder
{
    public function __construct()
    {
        $this->engine = new GoogleEngine();
        $this->transporter = new GuzzleTransporter();
        parent::__construct();
    }
}
