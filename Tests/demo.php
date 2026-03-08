<?php declare(strict_types=1);

/**
 * Demo script for the PHP User & Role Management System.
 *
 * Demonstrates:
 * - User creation via factory
 * - Traits (login)
 * - Interfaces (password reset)
 * - Repositories
 * - Array functions
 * - Closures
 * - Superglobals
 * - Logging
 * - Assertions
 */

require __DIR__ . '/../vendor/autoload.php';

use App\UserBase;
use App\Factories\UserFactory;
use App\Repositories\UserRepository;
use App\Services\Logger;

echo "=== PHP User System Demo ===\n\n";

try {

    /*
    |--------------------------------------------------------------------------
    | 1. Simulate input via superglobals ($_POST)
    |--------------------------------------------------------------------------
    | Useful for demonstrating handling of incoming request data.
    */
    $_POST = [
        'name' => 'Alice',
        'email' => 'alice@example.com',
        'password' => 'secret123',
        'role' => UserBase::ROLE_ADMIN
    ];

    $admin = UserFactory::create($_POST);

    $customerData = [
        'name' => 'Bob',
        'email' => 'bob@example.com',
        'role' => UserBase::ROLE_CUSTOMER
    ];

    $customer = UserFactory::create($customerData);

    echo "Users created via factory.\n\n";

    /*
    |--------------------------------------------------------------------------
    | 2. Repository Usage
    |--------------------------------------------------------------------------
    | Stores users and provides retrieval/search capabilities.
    */
    $repo = new UserRepository();
    $repo->addUser($admin);
    $repo->addUser($customer);

    echo "Users stored in repository.\n\n";

    /*
    |--------------------------------------------------------------------------
    | 3. Trait Example: Login
    |--------------------------------------------------------------------------
    | Demonstrates reusable login functionality from CanLogin trait.
    */
    if ($admin instanceof \App\Interfaces\Loginable) {
        $admin->login($admin->getEmail());
    }

    /*
    |--------------------------------------------------------------------------
    | 4. Interface Example: Password Reset
    |--------------------------------------------------------------------------
    | Demonstrates Resettable interface implementation.
    */
    if ($admin instanceof \App\Interfaces\Resettable) {
        $admin->resetPassword("newStrongPassword");
    }

    echo "\n";

    /*
    |--------------------------------------------------------------------------
    | 5. Display all users
    |--------------------------------------------------------------------------
    */
    $users = $repo->getAll();

    echo "All users:\n";
    foreach ($users as $user) {
        echo $user . " | Role: " . $user->getRole() . "\n";
    }

    echo "\n";

    /*
    |--------------------------------------------------------------------------
    | 6. Associative array example
    |--------------------------------------------------------------------------
    | Maps roles to emails for easy lookup.
    */
    $userEmails = [
        'admin' => $admin->getEmail(),
        'customer' => $customer->getEmail()
    ];

    print_r($userEmails);
    echo "\n";

    /*
    |--------------------------------------------------------------------------
    | 7. array_map example
    |--------------------------------------------------------------------------
    | Extract all user names from numeric array of users.
    */
    $names = array_map(fn($user) => $user->getName(), $users);

    echo "User Names:\n";
    print_r($names);
    echo "\n";

    /*
    |--------------------------------------------------------------------------
    | 8. array_filter + closure example
    |--------------------------------------------------------------------------
    | Filter only admin users using a closure.
    */
    $admins = array_filter($users, function ($user) {
        return $user->getRole() === UserBase::ROLE_ADMIN;
    });

    echo "Filtered Admin Users:\n";
    foreach ($admins as $adminUser) {
        echo $adminUser . "\n";
    }
    echo "\n";

    /*
    |--------------------------------------------------------------------------
    | 9. Static property example
    |--------------------------------------------------------------------------
    | Tracks total number of User instances created.
    */
    echo "Total users created: " . UserBase::getUserCount() . "\n\n";

    /*
    |--------------------------------------------------------------------------
    | 10. Repository search by email using getIdentifier
    |--------------------------------------------------------------------------
    */
    $foundUser = $repo->findByEmail("ALICE@EXAMPLE.COM"); // case-insensitive

    if ($foundUser !== null) {
        echo "User found in repository: " . $foundUser . "\n\n";
    }

    /*
    |--------------------------------------------------------------------------
    | 11. Logging example
    |--------------------------------------------------------------------------
    | Writes messages to logs/app.log
    */
    Logger::log("Demo executed successfully.");
    Logger::log("Total users: " . UserBase::getUserCount());

    /*
    |--------------------------------------------------------------------------
    | 12. Assertion test
    |--------------------------------------------------------------------------
    | Basic test to ensure correct user count.
    */
    assert(UserBase::getUserCount() === 2);
    echo "Assertion test passed.\n\n";

    echo "=== Demo completed successfully ===\n";

} catch (\Throwable $e) {

    echo "Error occurred: " . $e->getMessage() . "\n";

    Logger::log("Error: " . $e->getMessage());
}