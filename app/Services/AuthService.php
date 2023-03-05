<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\AuthRepository;

class AuthService
{
    /**
     * @var AuthRepository
     */
    private AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $gitHubId
     * @param string $gitHubUrl
     * 
     * @return User
     */
    public function store(
        string $name,
        string $email,
        string $gitHubId,
        string $gitHubUrl
    ): User {
        return $this->authRepository->store(
            $name,
            $email,
            $gitHubId,
            $gitHubUrl
        );
    }

    /**
     * @param string $gitHubId
     * 
     * @return User|null
     */
    public function findByGitHubId(string $gitHubId): ?User
    {
        return $this->authRepository->findByGitHubId($gitHubId);
    }
}
