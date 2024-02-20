<?php

namespace App\Post\Infrastructure\Repository\Implementation;

use App\Post\Domain\PostAggregate;
use App\Post\Infrastructure\Entity\PostEntity;
use App\Post\Infrastructure\Repository\PostRepositoryInterface;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class DoctrinePostRepository implements PostRepositoryInterface
{
    public function __construct(protected EntityManagerInterface $entityManager)
    {
    }

    /**
     * @throws Exception
     */
    public function savePost(PostAggregate $postAggregate): PostAggregate
    {
        $postEntity = $this->aggregateToEntity($postAggregate);

        $this->entityManager->persist($postEntity);
        $this->entityManager->flush();
        return $this->entityToAggregate($postEntity);
    }

    /**
     * @throws Exception
     */
    public function getPostById(string $postId): PostAggregate
    {
        /** @var PostEntity $postEntity */
        $postEntity = $this->entityManager->getRepository(PostEntity::class)->find($postId);

        if (!$postEntity) {
            throw new Exception("Post not found");
        }

        return $this->entityToAggregate($postEntity);
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getPosts(): array
    {
        /** @var PostEntity[] $postEntity */
        $postEntities = $this->entityManager->getRepository(PostEntity::class)->findAll();
        $result = array_map(function (PostEntity $postEntity) {
            return $this->entityToAggregate($postEntity);
        }, $postEntities);
        if (!$postEntities) {
            throw new Exception("Posts not found");
        }

        return [$result, count($result)];
    }

    private function aggregateToEntity(PostAggregate $aggregate): PostEntity
    {
        return new PostEntity(
            $aggregate->getId(),
            $aggregate->getTitle(),
            $aggregate->getContent(),
            $aggregate->getAuthor(),
            $aggregate->getPublished(),
            $aggregate->getCreatedAt()->toISO(),
            $aggregate->getUpdatedAt()->toISO(),
        );
    }

    /**
     * @throws Exception
     */
    private function entityToAggregate(PostEntity $entity): PostAggregate
    {
        return PostAggregate::make(
            postId: $entity->getId(),
            title: $entity->getTitle(),
            content: $entity->getContent(),
            authorId: $entity->getAuthorId(),
            isPublished: $entity->getIsPublished(),
            createdAt: new DateTimeImmutable($entity->getCreatedAt()),
            updatedAt: new DateTimeImmutable($entity->getUpdatedAt())
        );
    }
}