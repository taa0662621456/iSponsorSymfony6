<?php

namespace App\Exception;

/**
 * This exception should be thrown by service registry
 * when given type already exists.
 */
class ExistingServiceException extends \InvalidArgumentException
{
    public function __construct(string $context, string $type)
    {
        parent::__construct(sprintf('%s of type "%s" already exists.', $context, $type));
    }
}
