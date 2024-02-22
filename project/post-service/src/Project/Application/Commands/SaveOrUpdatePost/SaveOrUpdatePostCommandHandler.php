<?php

namespace App\Project\Application\Commands\SaveOrUpdatePost;

use App\Project\Application\Commands\AbstractCommand;
use App\Project\Application\Commands\AbstractCommandHandler;
use App\Project\Domain\PostAggregate;

class SaveOrUpdatePostCommandHandler extends AbstractCommandHandler
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