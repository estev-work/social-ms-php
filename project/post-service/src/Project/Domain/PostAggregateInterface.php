<?php

namespace App\Project\Domain;

use App\Base\Interfaces\AggregateRootInterface;
use App\Project\Domain\Exceptions\DomainTitleValidationException;
use App\Project\Domain\ValueObjects\CreatedDate;
use App\Project\Domain\ValueObjects\UpdatedDate;
use Exception;

interface PostAggregateInterface extends AggregateRootInterface
{
    public function getId(): string;

    /**
     * @throws DomainTitleValidationException|Exception
     */
    public function changeTitle(string $newTitle): PostAggregate;

    public function published(): PostAggregate;

    public function unpublished(): PostAggregate;

    public function getCreatedAt(): CreatedDate;

    public function getUpdatedAt(): UpdatedDate;

    public function getTitle(): string;

    public function getAuthor(): string;

    public function getPublished(): bool;

    public function getContent(): string;
}