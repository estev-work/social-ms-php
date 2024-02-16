<?php

namespace App\Post\Application\Commands\PublishPost;

use App\Post\Application\Commands\AbstractCommand;
use App\Post\Application\Commands\AbstractCommandHandler;
use App\Post\Domain\PostAggregate;

class PublishPostCommandHandler extends AbstractCommandHandler
{
    protected PostAggregate $aggregate;

    public function handle(PublishPostCommand|AbstractCommand $command): PostAggregate
    {
        $this->aggregate = $command->getPostAggregate();
        $this->aggregate->published();
        $this->logger->info("Published {$this->aggregate->getId()}");
        return $this->aggregate;
    }
}