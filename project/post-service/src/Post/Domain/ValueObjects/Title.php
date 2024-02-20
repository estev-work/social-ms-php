<?php

namespace App\Post\Domain\ValueObjects;

use App\Post\Domain\Exceptions\DomainTitleValidationException;

final class Title
{
    private const int MIN_LEN = 10;

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
            throw new DomainTitleValidationException();
        }
        if ($title !== '') {
            $this->title = $title;
        }
    }
}