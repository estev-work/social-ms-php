<?php

namespace App\Project\Application\Commands\CreateNewPost;

use App\Project\Application\Commands\AbstractCommand;
use App\Project\Application\Commands\AbstractCommandHandler;
use App\Project\Application\Exceptions\ApplicationLayerException;
use App\Project\Application\Exceptions\CreatePostException;
use App\Project\Domain\PostAggregate;
use Exception;

class CreateNewPostCommandHandler extends AbstractCommandHandler
{
    protected PostAggregate $aggregate;

    /**
     * @throws ApplicationLayerException
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