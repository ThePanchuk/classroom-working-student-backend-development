<?php declare(strict_types=1);

namespace App;

use App\Interfaces\Loginable;
use App\Traits\CanLogin;

/**
 * Concrete class representing a Customer user.
 *
 * Implements:
 * - Loginable: can login
 *
 * Uses:
 * - CanLogin trait for reusable login functionality
 */
class CustomerUser extends UserBase implements Loginable
{
    use CanLogin;

    /**
     * @return string
     */
    public function getRole(): string
    {
        return self::ROLE_CUSTOMER;
    }
}