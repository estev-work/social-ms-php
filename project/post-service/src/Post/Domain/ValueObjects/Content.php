<?php

namespace App\Post\Domain\ValueObjects;

class Content
{
    public function __construct(private string $content = "")
    {
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->content;
    }

    public function change(string $content): void
    {
        if ($content !== '') {
            $this->content = $content;
        }
    }
}