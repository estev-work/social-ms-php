<?php

namespace App\Project\Application;

use App\Project\Application\Commands\CommandBus;
use App\Project\Application\Commands\CreateNewPost\CreateNewPostCommand;
use App\Project\Application\Commands\CreateNewPost\CreateNewPostCommandHandler;
use App\Project\Application\Commands\PublishPost\PublishPostCommand;
use App\Project\Application\Commands\PublishPost\PublishPostCommandHandler;
use App\Project\Application\Commands\UnpublishPost\UnpublishPostCommand;
use App\Project\Application\Commands\UnpublishPost\UnpublishPostCommandHandler;
use App\Project\Application\Queries\GetAllPosts\GetAllPostsQuery;
use App\Project\Application\Queries\GetAllPosts\GetAllPostsQueryHandler;
use App\Project\Application\Queries\QueryBus;
use App\Project\Domain\PostAggregate;

class PostFacade
{
    private CommandBus $commandBus;
    private QueryBus $queryBus;

    public function __construct(
        CommandBus $commandBus,
        QueryBus $queryBus,
        CreateNewPostCommandHandler $createNewPostCommandHandler,
        PublishPostCommandHandler $publishPostCommandHandler,
        UnpublishPostCommandHandler $unpublishPostCommandHandler,
        GetAllPostsQueryHandler $getAllPostsQueryHandler,
    ) {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;

        $this->initializeHandlers(
            $createNewPostCommandHandler,
            $publishPostCommandHandler,
            $unpublishPostCommandHandler,
            $getAllPostsQueryHandler
        );
    }

    private function initializeHandlers(
        CreateNewPostCommandHandler $createNewPostCommandHandler,
        PublishPostCommandHandler $publishPostCommandHandler,
        UnpublishPostCommandHandler $unpublishPostCommandHandler,
        GetAllPostsQueryHandler $getAllPostsQueryHandler,
    ): void {
        //Commands
        $this->commandBus->registerHandler(CreateNewPostCommand::class, $createNewPostCommandHandler);
        $this->commandBus->registerHandler(PublishPostCommand::class, $publishPostCommandHandler);
        $this->commandBus->registerHandler(UnpublishPostCommand::class, $unpublishPostCommandHandler);

        //Queries
        $this->queryBus->registerHandler(GetAllPostsQuery::class, $getAllPostsQueryHandler);
    }

    #region Commands
    public function createNewPost(string $title, string $content, string $authorId, $isPublished): PostAggregate
    {
        $command = new CreateNewPostCommand($title, $content, $authorId, $isPublished);
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
    #region Queries

    /**
     * @return PostAggregate[]|array
     */
    public function getAllPosts(): array
    {
        $query = new GetAllPostsQuery();
        return $this->queryBus->handle($query);
    }
    #endregion
}