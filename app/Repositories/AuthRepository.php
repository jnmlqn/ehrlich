<?php

namespace App\Repositories;

use App\Models\User;

class AuthRepository
{
    /**
     * @var User
     */
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
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
        $user = $this->user->create([
            'name' => $name,
            'email' => $email,
            'github_id'=> $gitHubId,
            'github_url'=> $gitHubUrl
        ]);

        return $user;
    }

    /**
     * @param string $gitHubId
     * 
     * @return User|null
     */
    public function findByGitHubId(string $gitHubId): ?User
    {
        return $this->user->where('github_id', $gitHubId)->first();
    }
}
