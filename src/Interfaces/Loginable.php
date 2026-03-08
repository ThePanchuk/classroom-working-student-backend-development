<?php declare(strict_types=1);

namespace App\Interfaces;


interface Loginable
{
    /**
     * @param string $email
     * @return bool
     */
    public function login(string $email): bool;
}