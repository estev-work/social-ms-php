<?php

namespace App\Post\Application\Commands\CreateNewPost;

use App\Post\Application\Commands\AbstractCommand;

class CreateNewPostCommand extends AbstractCommand
{
    public function __construct(
        protected string $title,
        protected string $content,
        protected string $authorId,
        protected string $isPublished
    ) {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthorId(): string
    {
        return $this->authorId;
    }

    public function getIsPublished(): string
    {
        return $this->isPublished;
    }

    public function getContent(): string
    {
        return $this->content;
    }
    
}