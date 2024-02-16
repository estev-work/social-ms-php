<?php

namespace App\Post\Application\Commands\UnpublishPost;

use App\Post\Application\Commands\AbstractCommand;
use App\Post\Application\Commands\AbstractCommandHandler;
use App\Post\Domain\PostAggregate;

class UnpublishPostCommandHandler extends AbstractCommandHandler
{
    protected PostAggregate $aggregate;

    public function handle(UnpublishPostCommand|AbstractCommand $command): PostAggregate
    {
        $this->aggregate = $command->getPostAggregate();
        $this->aggregate->unpublished();
        $this->logger->info("Unpublished {$this->aggregate->getId()}");
        return $this->aggregate;
    }
}