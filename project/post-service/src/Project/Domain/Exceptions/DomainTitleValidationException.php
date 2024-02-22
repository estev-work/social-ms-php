<?php

namespace App\Project\Domain\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class DomainTitleValidationException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Title менее 10 символов', Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}