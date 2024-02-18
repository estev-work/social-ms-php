<?php

namespace App\Post\Domain\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class DomainValidationException extends \Exception
{
    public function __construct(string $message = "")
    {
        parent::__construct($message, Response::HTTP_UPGRADE_REQUIRED);
    }
}