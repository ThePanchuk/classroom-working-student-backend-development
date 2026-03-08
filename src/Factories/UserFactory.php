<?php declare(strict_types=1);

namespace App\Factories;

use App\AdminUser;
use App\CustomerUser;
use App\UserBase;

class UserFactory
{
    /**
     * @param array $data
     * @return UserBase
     */
    public static function create(array $data): UserBase
    {
        switch ($data['role']) {
            case UserBase::ROLE_ADMIN:
                return new AdminUser(
                    $data['name'],
                    $data['email'],
                    $data['password']
                );

            case UserBase::ROLE_CUSTOMER:
                return new CustomerUser(
                    $data['name'],
                    $data['email']
                );

            default:
                throw new \InvalidArgumentException("Unknown role");
        }
    }
}