<?php

namespace App\Project\Application\Events\PostCreationEvent;

use App\Project\Application\Events\AbstractEvent;
use App\Project\Domain\PostAggregate;

class PostCreationEvent extends AbstractEvent
{
    public function __construct(protected PostAggregate $postAggregate)
    {
    }

    public function getPostAggregate(): PostAggregate
    {
        return $this->postAggregate;
    }

}