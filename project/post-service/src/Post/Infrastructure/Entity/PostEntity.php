<?php

namespace App\Post\Infrastructure\Entity;


use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: "App\Post\Infrastructure\Repository\PostRepositoryInterface")]
#[ORM\Table(name: "posts")]
readonly class PostEntity
{
    #[ORM\Id()]
    #[ORM\Column(type: "uuid", nullable: false)]
    protected string $id;

    #[ORM\Column(name: 'title', type: "text", length: 255, nullable: false)]
    protected string $title;

    #[ORM\Column(type: "text", nullable: false)]
    protected string $content;
    #[ORM\Column(name: 'author_id', type: "string", nullable: false)]
    protected string $authorId;
    #[ORM\Column(name: 'is_published', type: "boolean", nullable: false)]
    protected string $isPublished;

    #[ORM\Column(name: "created_at", type: "string", nullable: false)]
    protected string $createdAt;
    #[ORM\Column(name: "updated_at", type: "string", nullable: false)]
    protected string $updatedAt;

    /**
     * @param string|null $id
     * @param string|null $title
     * @param string|null $content
     * @param string|null $authorId
     * @param string|null $isPublished
     * @param string|null $createdAt
     * @param string $updatedAt
     */
    public function __construct(
        ?string $id,
        ?string $title,
        ?string $content,
        ?string $authorId,
        ?string $isPublished,
        ?string $createdAt,
        string $updatedAt
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->authorId = $authorId;
        $this->isPublished = $isPublished;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getAuthorId(): ?string
    {
        return $this->authorId;
    }

    public function getIsPublished(): ?string
    {
        return $this->isPublished;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}