<?php

namespace App\Controller;

use App\Requests\AuthRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('auth', name: 'auth_', requirements: [])]
class AuthController extends AbstractController
{
    #[Route(name: 'login', methods: 'POST', format: 'json')]
    public function login(
        AuthRequest $request
    ): JsonResponse {
        //TODO
        return $this->json([
            "data" => ['status' => 'worked']
        ]);
    }
}
