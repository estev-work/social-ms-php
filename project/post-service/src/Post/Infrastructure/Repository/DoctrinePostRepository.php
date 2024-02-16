<?php

namespace App\Post\Infrastructure\Repository;

use App\Post\Domain\PostAggregate;
use App\Post\Infrastructure\Entity\PostEntity;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

//TODO Доработать, репозиторий сырой, возможно сделать классы мэппинга aggregate на entities
class DoctrinePostRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @throws Exception
     */
    public function savePost(PostAggregate $postAggregate): PostAggregate
    {
        // Маппинг из PostAggregate в PostEntity
        $postEntity = $this->aggregateToEntity($postAggregate);

        $this->entityManager->persist($postEntity);
        $this->entityManager->flush();

        // Возвращаем обновленный агрегат, возможно с новым ID или другими полями, установленными после сохранения
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
        $entity = new PostEntity();
        $entity->setTitle($aggregate->getTitle());
        $entity->setContent($aggregate->getContent());
        $entity->setCreatedAt($aggregate->getCreatedAt());
        $entity->setUpdatedAt($aggregate->getUpdatedAt());

        return $entity;
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