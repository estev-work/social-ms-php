<?php

namespace App\Post\Application\Commands\PublishPost;

use App\Post\Application\Commands\AbstractCommand;
use App\Post\Domain\PostAggregate;

class PublishPostCommand extends AbstractCommand
{
    public function __construct(protected PostAggregate $postAggregate)
    {
    }

    public function getPostAggregate(): PostAggregate
    {
        return $this->postAggregate;
    }
}