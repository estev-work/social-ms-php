<?php

namespace App\Post\Application\Commands\SaveOrUpdatePost;

use App\Post\Application\Commands\AbstractCommand;
use App\Post\Application\Commands\AbstractCommandHandler;
use App\Post\Domain\PostAggregate;

class SSaveOrUpdatePostCommandHandler extends AbstractCommandHandler
{
    protected PostAggregate $aggregate;

    public function handle(SaveOrUpdatePostCommand|AbstractCommand $command): PostAggregate
    {
        $this->aggregate = PostAggregate::make(
            title: $command->getTitle(),
            authorId: $command->getAuthorId(),
            isPublished: $command->getIsPublished()
        );
        $this->logger->info("Created new post {$this->aggregate->getId()}");
        return $this->aggregate;
    }
}