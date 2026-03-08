<?php declare(strict_types=1);

namespace App;

/**
 * Abstract base class for all user types.
 *
 * Provides:
 * - common properties: name, email
 * - validation for name and email
 * - static user count tracking
 * - magic methods (__toString, __get, __set)
 * - unique identifier for consistent comparisons
 *
 * All concrete users must implement `getRole()`.
 */
abstract class UserBase
{
    public const ROLE_ADMIN = 'admin';
    public const ROLE_CUSTOMER = 'customer';

    protected string $name;
    protected string $email;

    protected static int $userCount = 0;

    /**
     * @param string $name
     * @param string $email
     *
     * User Constructor
     */
    public function __construct(string $name, string $email)
    {
        $this->setName($name);
        $this->setEmail($email);

        self::$userCount++;
    }

    /**
     * @return string
     *
     * Unique Identifier for every user
     */
    final public function getIdentifier(): string
    {
        return strtolower($this->email);
    }

    /**
     * @return int
     */
    public static function getUserCount(): int
    {
        return self::$userCount;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        if ($name === '') {
            throw new \InvalidArgumentException("Name cannot be empty.");
        }

        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return void
     */
    public function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Invalid email: $email");
        }

        $this->email = $email;
    }

    /**
     * @return string
     *
     * Convert user to string.
     */
    public function __toString(): string
    {
        return "{$this->name} ({$this->email})";
    }

    /**
     * @param string $property
     * @return null
     */
    public function __get(string $property)
    {
        return $this->$property ?? null;
    }

    /**
     * @param string $property
     * @param $value
     * @return void
     */
    public function __set(string $property, $value): void
    {
        $this->$property = $value;
    }

    /**
     * @return string
     *
     * Each user type must define its role
     */
    abstract public function getRole(): string;
}