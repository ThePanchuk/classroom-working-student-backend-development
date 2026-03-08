<?php declare(strict_types=1);

namespace App\Repositories;

use App\UserBase;

/**
 * Repository for managing collections of users.
 *
 * Provides:
 * - addUser(): store a user
 * - getAll(): retrieve all users
 * - findByEmail(): search user by email (case-insensitive)
 */
class UserRepository
{
    /**
     * @var UserBase[]
     */
    private array $users = [];

    public function addUser(UserBase $user): void
    {
        $this->users[] = $user;
    }

    /**
     * @return UserBase[]
     */
    public function getAll(): array
    {
        return $this->users;
    }

    /**
     * @param string $email
     * @return UserBase|null
     */
    public function findByEmail(string $email): ?UserBase
    {
        $identifier = strtolower($email);

        foreach ($this->users as $user) {
            if ($user->getIdentifier() === $identifier) {
                return $user;
            }
        }

        return null;
    }
}