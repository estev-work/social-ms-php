<?php

namespace App\Post\Domain\ValueObjects;

use DateTimeInterface;

final class UpdatedDate
{
    public function __construct(private ?\DateTimeImmutable $value = null)
    {
    }

    public function getValue(): ?\DateTimeImmutable
    {
        return $this->value;
    }

    public function toISO(): ?string
    {
        return $this->value?->format(DateTimeInterface::ATOM);
    }

    public function setValue(\DateTimeImmutable $value): void
    {
        $this->value = $value;
    }
}