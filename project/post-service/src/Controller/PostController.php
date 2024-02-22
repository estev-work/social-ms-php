<?php

namespace App\Controller;

use App\Project\Application\PostFacade;
use App\Requests\CreateNewPostRequest;
use App\Responses\PostResource;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('posts', name: 'posts_', requirements: [])]
class PostController extends AbstractController
{

    public function __construct(private readonly PostFacade $postFacade)
    {
    }

    #[Route(name: 'create', methods: 'POST', format: 'json')]
    public function create(
        #[MapRequestPayload] CreateNewPostRequest $request
    ): Response {
        return PostResource::make(
            $this->postFacade->createNewPost(
                $request->getTitle(),
                $request->getContent(),
                $request->getAuthorId(),
                $request->getIsPublished()
            )->toArray()
        );
    }

    /**
     * @throws Exception
     */
    #[Route(name: 'list', methods: 'GET', format: 'json')]
    public function list(): Response
    {
        return PostResource::collection(...$this->postFacade->getAllPosts());
    }
}
