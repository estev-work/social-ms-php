<?php

namespace App\Post\Application\Commands;

use Monolog\Logger;

abstract class AbstractCommandHandler
{
    protected Logger $logger;

    public function __construct()
    {
        $this->logger = new Logger(static::class);
    }

    public abstract function handle(AbstractCommand $command);
}