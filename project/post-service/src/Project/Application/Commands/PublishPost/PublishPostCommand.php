<?php

namespace App\Project\Application\Commands\PublishPost;

use App\Project\Application\Commands\AbstractCommand;
use App\Project\Domain\PostAggregate;

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