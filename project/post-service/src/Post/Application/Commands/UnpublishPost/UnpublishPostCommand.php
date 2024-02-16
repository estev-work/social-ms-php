<?php

namespace App\Post\Application\Commands\UnpublishPost;

use App\Post\Application\Commands\AbstractCommand;
use App\Post\Domain\PostAggregate;

class UnpublishPostCommand extends AbstractCommand
{
    public function __construct(protected PostAggregate $postAggregate)
    {
    }

    public function getPostAggregate(): PostAggregate
    {
        return $this->postAggregate;
    }
}