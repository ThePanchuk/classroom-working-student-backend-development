# PHP User & Role Management System

This project is a small backend exercise demonstrating core PHP concepts such as object-oriented programming, interfaces, traits, namespaces, and autoloading.

It was created as part of a coding challenge for a **Working Student Backend Developer position**.

---

# Features

The project demonstrates the following PHP concepts:

* Abstract classes
* Inheritance
* Interfaces
* Traits
* Namespaces & PSR-4 autoloading
* Static properties and constants
* Magic methods
* Exception handling
* Array manipulation (`array_map`, `array_filter`)
* Closures
* Superglobals
* Repository pattern
* Factory pattern
* Basic logging
* Simple assertions for testing

---

# Project Structure

```
src/
  AdminUser.php
  CustomerUser.php
  UserBase.php

  Factories/
    UserFactory.php

  Interfaces/
    Loginable.php
    Resettable.php

  Repositories/
    UserRepository.php

  Services/
    Logger.php

  Traits/
    CanLogin.php

tests/
  demo.php

logs/
  app.log
```

### Directory explanation


| Folder         | Purpose                          |
| -------------- | -------------------------------- |
| `src`          | Main application code            |
| `Interfaces`   | Contracts implemented by classes |
| `Traits`       | Reusable behavior                |
| `Repositories` | Data access layer                |
| `Factories`    | Object creation logic            |
| `Services`     | Utility services like logging    |
| `tests`        | Demo/test scripts                |
| `logs`         | Application log files            |

---

# Installation

Clone the repository:

```bash
git clone <https://github.com/ThePanchuk/classroom-working-student-backend-development/tree/main>
cd classroom-working-student-backend-development
```

Install dependencies:

```bash
composer install
```

---

# Running the Demo

Execute the demo script:

```bash
php tests/demo.php
```

Example output:

```
=== PHP User System Demo ===

Users created via factory.

Users stored in repository.

User with email alice@example.com logged in.
Admin password reset successful.

All users:
Alice (alice@example.com) | Role: admin
Bob (bob@example.com) | Role: customer
```

---

# Design Decisions

### Abstract Base Class

`UserBase` defines shared properties and behavior for all user types.

### Traits

The `CanLogin` trait provides reusable login functionality.

### Interfaces

Interfaces define required behaviors:

* `Loginable` → login capability
* `Resettable` → password reset capability

### Repository Pattern

`UserRepository` manages collections of users and provides search functionality.

### Factory Pattern

`UserFactory` centralizes user object creation.

### Logging

A simple logger writes messages to:

```
logs/app.log
```

---

# Example Concepts Demonstrated

### Array functions

```
array_map()
array_filter()
```

### Closures

Anonymous functions are used for filtering user collections.

### Magic methods

```
__construct
__toString
__get
__set
```

---

# Testing

The demo script contains a simple assertion:

```php
assert(UserBase::getUserCount() === 2);
```

This ensures correct user creation.

---

# Possible Improvements

Future improvements could include:

* database storage
* REST API endpoints
* authentication system
* full unit tests with PHPUnit
* dependency injection container

---

# Author

Created as part of a backend development coding challenge.
