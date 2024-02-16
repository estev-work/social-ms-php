<?php

namespace App\Post\Domain\ValueObjects;

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
        if (!$this->value) {
            return null;
        }
        return $this->value->format(DATE_ISO8601_EXPANDED);
    }

    public function setValue(\DateTimeImmutable $value): void
    {
        $this->value = $value;
    }
}