<?php

namespace App\Post\Domain\ValueObjects;

use App\Post\Domain\Exceptions\DomainValidationException;

final class Title
{
    private const int MIN_LEN = 10;
    private const string MIN_LEN_ERROR_TEXT = 'Title менее 10 символов';

    public function __construct(private string $title = "none")
    {
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->title;
    }

    /**
     * @throws \Exception
     */
    public function change(string $title): void
    {
        if (strlen($title) < self::MIN_LEN) {
            throw new DomainValidationException(self::MIN_LEN_ERROR_TEXT);
        }
        if ($title !== '') {
            $this->title = $title;
        }
    }
}