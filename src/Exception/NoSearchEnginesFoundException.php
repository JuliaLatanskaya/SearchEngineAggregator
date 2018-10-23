<?php
declare(strict_types=1);

namespace Gatherer\Exception;

class NoSearchEnginesFoundException extends AbstractGathererException
{
    protected $code = self::VALIDATION_EXCEPTION;
}
