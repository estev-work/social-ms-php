<?php

namespace App\Post\Application\Commands\CreateNewPost;

use App\Post\Application\Commands\AbstractCommand;
use App\Post\Application\Commands\AbstractCommandHandler;
use App\Post\Domain\PostAggregate;

class CreateNewPostCommandHandler extends AbstractCommandHandler
{
    protected PostAggregate $aggregate;

    public function handle(CreateNewPostCommand|AbstractCommand $command): PostAggregate
    {
        $this->aggregate = PostAggregate::make(
            title: $command->getTitle(),
            content: $command->getContent(),
            authorId: $command->getAuthorId(),
            isPublished: $command->getIsPublished()
        );
        $this->logger->info("Created new post {$this->aggregate->getId()}");
        return $this->aggregate;
    }
}