<?php

namespace App\Controller;

use App\Post\Application\PostFacade;
use App\Requests\CreateNewPostRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;

#[Route('posts/', name: 'posts_', requirements: [])]
class PostController extends AbstractController
{

    public function __construct(private readonly PostFacade $postFacade)
    {
    }

    #[Route('new', name: 'new', methods: 'POST', format: 'json')]
    public function create(
        #[MapQueryString] CreateNewPostRequest $request
    ): JsonResponse {
        $post = $this->postFacade->createNewPost(
            $request->getTitle(),
            $request->getAuthorId(),
            $request->getIsPublished()
        );
        return $this->json([
            "data" => $post->toArray()
        ]);
    }
}
