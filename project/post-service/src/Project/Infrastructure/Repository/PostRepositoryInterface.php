<?php

namespace App\Project\Infrastructure\Repository;

use App\Project\Domain\PostAggregate;
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