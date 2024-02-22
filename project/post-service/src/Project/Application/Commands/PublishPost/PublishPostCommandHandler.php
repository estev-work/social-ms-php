<?php

namespace App\Project\Application\Commands\PublishPost;

use App\Project\Application\Commands\AbstractCommand;
use App\Project\Application\Commands\AbstractCommandHandler;
use App\Project\Domain\PostAggregate;

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