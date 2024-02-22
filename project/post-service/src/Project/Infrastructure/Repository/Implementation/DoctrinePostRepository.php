<?php

namespace App\Project\Infrastructure\Repository\Implementation;

use App\Project\Domain\PostAggregate;
use App\Project\Infrastructure\Entity\PostEntity;
use App\Project\Infrastructure\Repository\PostRepositoryInterface;
use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

class DoctrinePostRepository extends ServiceEntityRepository implements PostRepositoryInterface
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostEntity::class);
    }

    /**
     * @throws Exception
     */
    public function savePost(PostAggregate $postAggregate): PostAggregate
    {
        $entityManager = $this->getEntityManager();
        $postEntity = $this->aggregateToEntity($postAggregate);

        $entityManager->persist($postEntity);
        $entityManager->flush();
        return $this->entityToAggregate($postEntity);
    }

    /**
     * @throws Exception
     */
    public function getPostById(string $postId): PostAggregate
    {
        $entityManager = $this->getEntityManager();
        /** @var PostEntity $postEntity */
        $postEntity = $entityManager->getRepository(PostEntity::class)->find($postId);

        if (!$postEntity) {
            throw new Exception("Project not found");
        }

        return $this->entityToAggregate($postEntity);
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getPosts(): array
    {
        $entityManager = $this->getEntityManager();
        $repository = $entityManager->getRepository(PostEntity::class);
        /** @var PostEntity[] $postEntity */
        $postEntities = $repository->findAll();
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