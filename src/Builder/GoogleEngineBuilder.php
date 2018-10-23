<?php
declare(strict_types=1);

namespace Latanskaya\Gatherer\Builder;

use Latanskaya\Gatherer\Entities\GoogleEngine;
use Latanskaya\Gatherer\Service\GuzzleTransporter;

class GoogleEngineBuilder extends AbstractEngineBuilder
{
    public function __construct()
    {
        $this->engine = new GoogleEngine();
        $this->transporter = new GuzzleTransporter();
        parent::__construct();
    }
}
