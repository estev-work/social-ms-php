<?php

namespace App\Post\Application\Exceptions;

class CreatePostException extends ApplicationCommandException
{
    public function __construct()
    {
        parent::__construct("Не удалось создать пост");
    }
}