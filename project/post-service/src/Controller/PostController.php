<?php

namespace App\Controller;

use App\Post\Application\PostFacade;
use App\Requests\CreateNewPostRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('posts', name: 'posts_', requirements: [])]
class PostController extends AbstractController
{
    public function __construct(private readonly PostFacade $postFacade)
    {
    }

    #[Route(name: 'create', methods: 'POST', format: 'json')]
    public function create(
        CreateNewPostRequest $request
    ): JsonResponse {
        $post = $this->postFacade->createNewPost(
            $request->getTitle(),
            $request->getContent(),
            $request->getAuthorId(),
            $request->getIsPublished()
        );
        return $this->json([
            "data" => $post->toArray()
        ]);
    }

    #[Route(name: 'list', methods: 'GET', format: 'json')]
    public function list(): JsonResponse
    {
        //TODO
        return $this->json([
            "data" => ['status' => 'worked']
        ]);
    }
}
