<?php

namespace App\Requests;

use Symfony\Component\Validator\Constraints as Assert;

class CreateNewPostRequest
{
    public function __invoke()
    {
        dd($this);
    }

    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 10, max: 500)]
        public string $title,

        #[Assert\NotBlank]
        #[Assert\Length(min: 10, max: 500)]
        public string $content,

        #[Assert\NotBlank]
        public string $authorId,

        #[Assert\Type('boolean')]
        public ?bool $isPublished,
    ) {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getAuthorId(): string
    {
        return $this->authorId;
    }

    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }
}