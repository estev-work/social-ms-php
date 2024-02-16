<?php

namespace App\Post\Domain\ValueObjects;

final class CreatedDate
{

    public function __construct(private ?\DateTimeImmutable $value = null)
    {
        if (!$value) {
            $this->value = new \DateTimeImmutable();
        }
    }

    public function getValue(): \DateTimeImmutable
    {
        return $this->value;
    }

    public function toISO(): string
    {
        return $this->value->format(DATE_ATOM);
    }

    public function setValue(\DateTimeImmutable $value): void
    {
        $this->value = $value;
    }
}