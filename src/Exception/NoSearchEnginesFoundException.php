<?php
declare(strict_types=1);

namespace Latanskaya\Gatherer\Exception;

class NoSearchEnginesFoundException extends AbstractGathererException
{
    protected $code = self::VALIDATION_EXCEPTION;
}
