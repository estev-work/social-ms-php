<?php

namespace App\Post\Application;

use App\Post\Application\Commands\CommandBus;
use App\Post\Application\Commands\CreateNewPost\CreateNewPostCommand;
use App\Post\Application\Commands\CreateNewPost\CreateNewPostCommandHandler;
use App\Post\Application\Commands\PublishPost\PublishPostCommand;
use App\Post\Application\Commands\PublishPost\PublishPostCommandHandler;
use App\Post\Application\Commands\UnpublishPost\UnpublishPostCommand;
use App\Post\Application\Commands\UnpublishPost\UnpublishPostCommandHandler;
use App\Post\Domain\PostAggregate;

class PostFacade
{
    private CommandBus $commandBus;

    public function __construct()
    {
        $this->commandBus = new CommandBus();
        $this->initializeHandlers();
    }

    private function initializeHandlers(): void
    {
        $this->commandBus->registerHandler(
            CreateNewPostCommand::class,
            new CreateNewPostCommandHandler()
        );
        $this->commandBus->registerHandler(
            PublishPostCommand::class,
            new PublishPostCommandHandler()
        );
        $this->commandBus->registerHandler(
            UnpublishPostCommand::class,
            new UnpublishPostCommandHandler()
        );
    }

    #region Commands
    public function createNewPost(string $title, string $authorId, $isPublished): PostAggregate
    {
        $command = new CreateNewPostCommand($title, $authorId, $isPublished);
        $command = new CreateNewPostCommand($title, $authorId, $isPublished);
        return $this->commandBus->handle($command);
    }

    public function publishPost(PostAggregate $post): PostAggregate
    {
        $command = new PublishPostCommand($post);
        return $this->commandBus->handle($command);
    }

    public function unpublishPost(PostAggregate $post): array
    {
        $command = new UnpublishPostCommand($post);
        $result = $this->commandBus->handle($command);
        return $result->toArray();
    }

    #endregion
}