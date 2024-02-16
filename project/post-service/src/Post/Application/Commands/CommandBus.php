<?php

namespace App\Post\Application\Commands;

use App\Post\Domain\PostAggregate;
use Symfony\Component\Config\Definition\Exception\Exception;

class CommandBus
{
    /** @var array<AbstractCommandHandler> $handlers */
    private array $handlers = [];

    public function registerHandler(string $commandClass, AbstractCommandHandler $handler): void
    {
        $this->handlers[$commandClass] = $handler;
    }

    public function handle(AbstractCommand $command): PostAggregate
    {
        $commandClass = get_class($command);

        if (!isset($this->handlers[$commandClass])) {
            throw new Exception(`Обработчик для команды {$commandClass} не найден.`);
        }

        $handler = $this->handlers[$commandClass];
        return $handler->handle($command);
    }
}