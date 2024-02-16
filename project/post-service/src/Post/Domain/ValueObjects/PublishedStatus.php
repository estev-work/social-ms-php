<?php

namespace App\Post\Domain\ValueObjects;

final class PublishedStatus
{

    public function __construct(private ?bool $value = false)
    {
        if ($this->value === null) {
            $this->value = false;
        }
    }

    public function published(): string
    {
        return $this->value = true;
    }

    public function unpublished(): void
    {
        $this->value = false;
    }

    /**
     * @return bool
     */
    public function getValue(): bool
    {
        return $this->value;
    }
}