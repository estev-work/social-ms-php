<?php

namespace App\Project\Domain\ValueObjects;

use Symfony\Component\Uid\Uuid;

final class PostId
{
    public function __construct(private ?string $value = null)
    {
        $this->value = $this->value ?? Uuid::v4();
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }
}