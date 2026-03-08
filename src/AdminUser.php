<?php declare(strict_types=1);

namespace App;

use App\Interfaces\Loginable;
use App\Traits\CanLogin;
use App\Interfaces\Resettable;

/**
 * Concrete class representing an Admin user.
 *
 * Implements:
 * - Loginable: can login
 * - Resettable: can reset password
 *
 * Uses:
 * - CanLogin trait for reusable login functionality
 */
class AdminUser extends UserBase implements Resettable, Loginable
{
    use CanLogin;

    private string $password;

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function __construct(string $name, string $email, string $password)
    {
        parent::__construct($name, $email);
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return self::ROLE_ADMIN;
    }

    /**
     * @param string $newPassword
     * @return void
     */
    public function resetPassword(string $newPassword): void
    {
        $this->password = $newPassword;
        echo "Admin password reset successful.\n";
    }
}