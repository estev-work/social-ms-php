<?php

namespace App\Project\Application\Commands;

use App\Project\Infrastructure\Repository\PostRepositoryInterface;
use Monolog\Logger;

abstract class AbstractCommandHandler
{
    protected Logger $logger;

    public function __construct(protected readonly PostRepositoryInterface $postRepository)
    {
        $this->logger = new Logger(static::class);
    }

    public abstract function handle(AbstractCommand $command);
}