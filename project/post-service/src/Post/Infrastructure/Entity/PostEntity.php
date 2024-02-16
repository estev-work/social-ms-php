<?php

namespace App\Post\Infrastructure\Entity;


use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: "App\Post\Infrastructure\Repository\DoctrinePostRepository")]
#[ORM\Table(name: "posts")]
class PostEntity extends BaseEntity
{
    #[ORM\Column(name: 'title', type: "text", length: 255, nullable: false)]
    private ?string $title;

    #[ORM\Column(type: "text", nullable: false)]
    private ?string $content;
    #[ORM\Column(name: 'author_id', type: "string", nullable: false)]
    private ?string $authorId;
    #[ORM\Column(name: 'is_published', type: "boolean", nullable: false)]
    private ?string $isPublished;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): PostEntity
    {
        $this->title = $title;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): PostEntity
    {
        $this->content = $content;
        return $this;
    }

    public function getAuthorId(): ?string
    {
        return $this->authorId;
    }

    public function setAuthorId(?string $authorId): PostEntity
    {
        $this->authorId = $authorId;
        return $this;
    }

    public function getIsPublished(): ?string
    {
        return $this->isPublished;
    }

    public function setIsPublished(?string $isPublished): PostEntity
    {
        $this->isPublished = $isPublished;
        return $this;
    }
}