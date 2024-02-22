<?php

namespace App\Responses;

class PostResource extends AbstractResource
{
    public string $id;
    public string $title;
    public string $content;
    public string $author;
    public bool $published;
    public string $createdAt;
    public string $updatedAt;
}