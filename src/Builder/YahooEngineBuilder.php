<?php
declare(strict_types=1);

namespace Gatherer\Builder;

use Gatherer\Entities\YahooEngine;
use Gatherer\Service\GuzzleTransporter;

class YahooEngineBuilder extends AbstractEngineBuilder
{
    public function __construct()
    {
        $this->engine = new YahooEngine();
        $this->transporter = new GuzzleTransporter();
        parent::__construct();
    }
}
