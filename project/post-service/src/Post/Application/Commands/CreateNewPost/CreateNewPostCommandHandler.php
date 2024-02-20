<?php

namespace App\Post\Application\Commands\CreateNewPost;

use App\Post\Application\Commands\AbstractCommand;
use App\Post\Application\Commands\AbstractCommandHandler;
use App\Post\Application\Exceptions\ApplicationCommandException;
use App\Post\Application\Exceptions\CreatePostException;
use App\Post\Domain\PostAggregate;
use Exception;

class CreateNewPostCommandHandler extends AbstractCommandHandler
{
    protected PostAggregate $aggregate;

    /**
     * @throws ApplicationCommandException
     * @throws Exception
     */
    public function handle(CreateNewPostCommand|AbstractCommand $command): PostAggregate
    {
        $this->aggregate = PostAggregate::make(
            title: $command->getTitle(),
            content: $command->getContent(),
            authorId: $command->getAuthorId(),
            isPublished: $command->getIsPublished()
        );
        try {
            $this->postRepository->savePost($this->aggregate);
        } catch (Exception $exception) {
            throw new CreatePostException();
        }
        $this->logger->info("Created new post {$this->aggregate->getId()}");
        return $this->aggregate;
    }
}