<?php

namespace App\Project\Domain\ValueObjects;

final class AuthorId
{
    public function __construct(private ?string $value)
    {
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): void
    {
        $this->value = $value;
    }
}