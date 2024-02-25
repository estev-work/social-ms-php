<?php

namespace App\Project\Infrastructure\EventPublisher\Implementation;

use App\Project\Infrastructure\EventPublisher\EventPublisherInterface;

class KafkaEventPublisher implements EventPublisherInterface
{

    function publish(string $topic, $message): void
    {
        // TODO: Implement publish() method.
    }
}