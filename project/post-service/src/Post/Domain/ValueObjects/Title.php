<?php

namespace App\Post\Domain\ValueObjects;

final class Title
{
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

    public function change(string $title): void
    {
        if ($title !== '') {
            $this->title = $title;
        }
    }
}