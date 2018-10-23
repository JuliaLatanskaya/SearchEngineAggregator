<?php
declare(strict_types=1);

namespace Latanskaya\Gatherer\Exception;

class TypeMismatchException extends AbstractGathererException
{
    protected $code = self::TECHNICAL_EXCEPTION;
}
