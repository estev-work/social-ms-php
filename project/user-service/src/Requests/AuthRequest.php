<?php

namespace App\Requests;

use Symfony\Component\Validator\Constraints as Assert;

class AuthRequest
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 10, max: 80)]
        public string $login,

        #[Assert\PasswordStrength]
        public string $password,
    ) {
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

}