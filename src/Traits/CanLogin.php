<?php declare(strict_types=1);

namespace App\Traits;

/**
 * Trait providing login functionality.
 *
 * Can be reused across different user types.
 */
trait CanLogin
{
    /**
     * @param string $email
     * @return bool
     */
    public function login(string $email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "User with email {$email} logged in.\n";
            return true;
        }

        return false;
    }
}