<?php

namespace App\Project\Infrastructure\EventPublisher;

interface EventPublisherInterface
{
    const string postCreated = "POST_CREATED_TOPIC";
    const string postUpdated = "POST_UPDATED_TOPIC";
    const string postDeleted = "POST_DELETED_TOPIC";
    const string postPublishing = "POST_DELETED_TOPIC";

    function publish(string $topic, $message): void;
}