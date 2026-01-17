# Adminium Development Guidelines

This document contains the development guidelines, patterns, and conventions for the Adminium codebase. All developers should follow these standards to maintain consistency and code quality.

## Table of Contents

1. [Project Overview](#project-overview)
2. [Technology Stack](#technology-stack)
3. [Code Standards](#code-standards)
4. [File Organization](#file-organization)
5. [Architecture Patterns](#architecture-patterns)
6. [Database Guidelines](#database-guidelines)
7. [Frontend Standards](#frontend-standards)
8. [Testing Guidelines](#testing-guidelines)
9. [Security Practices](#security-practices)
10. [Development Workflow](#development-workflow)

## Project Overview

Adminium is a custom admin panel built on Laravel with a modular architecture. The project uses a domain-driven design approach where each feature (Users, Products, Categories, etc.) has its own module under the `admin/` directory.

### Key Architectural Principles

- **Modular Architecture**: Each feature is a self-contained module
- **Domain-Driven Design**: Business logic organized by domain
- **Service Provider Pattern**: Each module registers its own routes and views
- **Command Query Responsibility Segregation (CQRS)**: Separate command handlers for actions

## Technology Stack

### Backend
- **PHP**: ^8.2 with strict typing
- **Laravel**: ^12.0 (latest version)
- **Database**: MySQL (production), SQLite (testing)

### Key Packages
- `spatie/laravel-permission` - Role-based access control
- `spatie/laravel-media-library` - File management
- `spatie/laravel-translatable` - Multi-language support
- `kra8/laravel-snowflake` - Unique ID generation

### Frontend
- **Tailwind CSS**: v4.0 (utility-first CSS framework)
- **Vite**: Build tool and development server
- **Alpine.js**: Lightweight JavaScript framework
- **CKEditor**: Rich text editing
- **SweetAlert2**: Enhanced alerts

### Development Tools
- **Docker**: Container-based development
- **Pest**: Testing framework
- **PHPStan**: Static analysis (Level 7)
- **Laravel Pint**: Code formatting
- **Rector**: Automated refactoring

## Code Standards

### PHP Standards

#### Strict Typing
All PHP files MUST declare strict typing:

```php
<?php

declare(strict_types=1);

// Your code here
```

#### Class Declarations
Controllers and services should be `final` and use `readonly` for dependency injection:

```php
final readonly class UsersController
{
    public function __construct(
        private UserService $userService
    ) {}

    public function index(): View
    {
        // Implementation
    }
}
```

#### Type Hints
All methods MUST have return type declarations:

```php
public function create(): View
{
    return view('users::create');
}

public function store(CreateUserRequest $request): RedirectResponse
{
    // Implementation
}
```

#### Naming Conventions
- **Controllers**: `{Feature}Controller` (e.g., `UsersController`)
- **Requests**: `{Action}{Feature}Request` (e.g., `CreateUserRequest`)
- **Service Providers**: `{Feature}ServiceProvider`
- **Route Files**: `{feature}-routes.php`
- **Models**: PascalCase (e.g., `User`, `Product`)

## File Organization

### Module Structure
Each feature module under `admin/` follows this structure:

```
admin/{feature}/
├── Controller.php
├── {Feature}ServiceProvider.php
├── RouteServiceProvider.php
├── {feature}-routes.php
├── Views/
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── edit.blade.php
│   └── partials/
├── Create{Feature}Request.php
└── Update{Feature}Request.php
```

### Namespace Convention
All admin modules use the `Admin\{Feature}` namespace:

```php
namespace Admin\Users;

final class UsersController
{
    // Implementation
}
```

### Service Provider Registration
Each module MUST register its own service provider in `bootstrap/providers.php`:

```php
return [
    // Other providers
    Admin\Users\UsersServiceProvider::class,
    Admin\Products\ProductsServiceProvider::class,
];
```

## Architecture Patterns

### Modular Architecture
Each feature module is self-contained with its own:

- Routes
- Controllers
- Views
- Service Providers
- Request Classes

### CQRS Pattern
Use command handlers for complex operations:

```php
final readonly class SignInAdminController
{
    public function __construct(
        private SignInAdminCommandHandler $handler
    ) {}

    public function __invoke(AdminSignInRequest $request): RedirectResponse
    {
        $this->handler->handle(new SignInAdminCommand(/*...*/));
        return redirect()->intended(route('admin.dashboard'));
    }
}
```

### Service Provider Pattern
Each module registers its routes and views:

```php
final class UsersServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/Views', 'users');
        $this->app->register(RouteServiceProvider::class);
    }
}
```

## Database Guidelines

### Migration Patterns
Use anonymous class migrations with proper typing:

```php
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }
};
```

### Model Patterns
Models should use appropriate traits and have proper type casting:

```php
final class User extends Authenticatable implements HasMedia
{
    use HasFactory, HasRoles, HasShortflakePrimary, InteractsWithMedia, Notifiable;

    protected $fillable = [
        'name',
        'title', 
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
```

### Database Design
- **Snowflake IDs**: Use `kra8/laravel-snowflake` for unique identifiers
- **Hard Deletes**: No soft deletes (explicit removal)
- **Timestamps**: Standard `created_at` and `updated_at`
- **Foreign Keys**: Proper relationships with constraints

## Frontend Standards

### Blade Template Organization
Use the extensible layout system:

```php
@extends('dashboard::admin_layout')

@section('content')
    <!-- Main content here -->
@endsection

@push('admin_script')
    <!-- Page-specific scripts -->
@endpush
```

### CSS Architecture
Use Tailwind CSS v4 with custom theme:

```css
@theme {
    --font-sans: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
}

/* Utility-first approach */
.btn-primary {
    @apply bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md;
}
```

### Component-Based Views
Create reusable blade components in `resources/views/components/`:

```php
// Usage
<x-admin.input type="email" name="email" label="Email Address" required />

// Component definition
// resources/views/components/admin/input.blade.php
@props(['type' => 'text', 'name', 'label', 'required' => false])

<div class="form-group">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" 
           {{ $required ? 'required' : '' }} 
           class="form-input @error($name) border-red-500 @enderror">
    @error($name)
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
</div>
```

### JavaScript Patterns
Use vanilla JavaScript with Alpine.js integration:

```javascript
document.addEventListener('DOMContentLoaded', () => {
    // Initialize components
    initializeDataTables();
    initializeTooltips();
});

// Alpine.js components
Alpine.data('userForm', () => ({
    showPassword: false,
    togglePassword() {
        this.showPassword = !this.showPassword;
    }
}));
```

## Testing Guidelines

### Pest Testing Framework
Use Pest for all testing with proper organization:

```php
// tests/Feature/UsersTest.php
pest()->extend(Tests\TestCase::class)
    ->in('Feature');

it('can view users index', function () {
    $user = User::factory()->create();
    
    actingAs($user)
        ->get(route('admin.users.index'))
        ->assertOk()
        ->assertSee($user->name);
});
```

### Test Configuration
- Use SQLite in-memory database for testing
- Use array drivers for cache and sessions
- Isolate environment variables

### Custom Expectations
Create custom expectations for common assertions:

```php
// tests/Pest.php
expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

// Usage
expect($count)->toBeOne();
```

## Security Practices

### Authentication & Authorization
- Use Spatie Laravel Permission for role-based access control
- Implement permission-based middleware on routes
- Use custom admin authentication system

### Input Validation
All user input MUST be validated using Form Request classes:

```php
final class CreateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }
}
```

### CSRF Protection
Ensure all forms include CSRF token:

```php
<form method="POST" action="{{ route('admin.users.store') }}">
    @csrf
    <!-- Form fields -->
</form>
```

### Data Protection
- Hash passwords using Laravel's built-in hashing
- Use prepared statements (Eloquent ORM)
- Validate and sanitize all user input
- Implement proper error handling without exposing sensitive information

## Development Workflow

### Environment Setup
Use Docker for consistent development environment:

```bash
# Start development environment
docker-compose up -d

# Install dependencies
composer install
npm install

# Run development server
npm run dev
```

### Code Quality Tools
Run these tools before committing:

```bash
# Code formatting
./vendor/bin/pint

# Static analysis
./vendor/bin/phpstan analyse

# Tests
./vendor/bin/pest

# Automated refactoring (if needed)
./vendor/bin/rector process
```

### Git Workflow
1. Create feature branches from `main`
2. Write descriptive commit messages
3. Ensure all tests pass before creating PR
4. Use conventional commit format if required

### Development Commands
```bash
# Development server with all services
composer run dev

# Generate IDE helper files
composer run ide-helper

# Clear caches
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Best Practices Summary

### DO ✅
- Use strict typing in all PHP files
- Make controllers and services `final`
- Use `readonly` for dependency injection
- Follow the modular architecture pattern
- Validate all input with Form Requests
- Write tests for all features
- Use proper error handling
- Follow the established naming conventions

### DON'T ❌
- Mix business logic with controllers
- Use `any()` type hints
- Skip input validation
- Hardcode configuration values
- Ignore code quality tools
- Write controllers without proper type hints
- Use global helpers without proper namespacing
- Skip testing for new features

## Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Pest Testing Documentation](https://pestphp.com/docs)
- [Spatie Packages Documentation](https://spatie.be/docs)

---

This document should be updated as the codebase evolves. All developers are encouraged to contribute to improving these guidelines.