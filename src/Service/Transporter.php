<?php
declare(strict_types=1);

namespace Gatherer\Service;

interface Transporter
{
    public function getResponse($uri = '');
}
