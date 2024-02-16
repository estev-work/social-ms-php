<?php

namespace App\Post\Infrastructure\Entity;

use Doctrine\ORM\Mapping as ORM;

class BaseEntity
{
    #[ORM\Id()]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type: "uuid", nullable: false)]
    private ?string $id;
    #[ORM\Column(name: "created_at", type: "date", nullable: false)]
    private ?string $createdAt;
    #[ORM\Column(name: "updated_at", type: "date", nullable: true)]
    private ?string $updatedAt;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    public function setId(?string $id): BaseEntity
    {
        $this->id = $id;
        return $this;
    }

    public function setCreatedAt(?string $createdAt): BaseEntity
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function setUpdatedAt(?string $updatedAt): BaseEntity
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}