<?php
declare(strict_types=1);

namespace Latanskaya\Gatherer\Service;

interface Transporter
{
    public function getResponse($uri = '');
}
