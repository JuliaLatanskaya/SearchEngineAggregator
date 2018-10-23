<?php
declare(strict_types=1);

namespace Latanskaya\Gatherer\Builder;

use Latanskaya\Gatherer\Entities\YahooEngine;
use Latanskaya\Gatherer\Service\GuzzleTransporter;

class YahooEngineBuilder extends AbstractEngineBuilder
{
    public function __construct()
    {
        $this->engine = new YahooEngine();
        $this->transporter = new GuzzleTransporter();
        parent::__construct();
    }
}
