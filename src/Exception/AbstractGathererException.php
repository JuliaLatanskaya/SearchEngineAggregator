<?php
declare(strict_types=1);

namespace Gatherer\Exception;

abstract class AbstractGathererException extends \Exception
{
    const VALIDATION_EXCEPTION = 100;
    const COMMUNICATION_EXCEPTION = 200;
    const TECHNICAL_EXCEPTION = 300;

    protected $code = 0;
}
