<?php

namespace App\Post\Infrastructure\Repository;

use App\Post\Domain\PostAggregate;
use Exception;

interface PostRepositoryInterface
{
    /**
     * @param PostAggregate $postAggregate
     * @return PostAggregate
     * @throws Exception
     */
    public function savePost(PostAggregate $postAggregate): PostAggregate;

    /**
     * @param string $postId
     * @return PostAggregate
     * @throws Exception
     */
    public function getPostById(string $postId): PostAggregate;

    /**
     * @return array
     * @throws Exception
     */
    public function getPosts(): array;
}