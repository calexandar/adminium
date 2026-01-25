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

===

<laravel-boost-guidelines>
=== foundation rules ===

# Laravel Boost Guidelines

The Laravel Boost guidelines are specifically curated by Laravel maintainers for this application. These guidelines should be followed closely to enhance the user's satisfaction building Laravel applications.

## Foundational Context
This application is a Laravel application and its main Laravel ecosystems package & versions are below. You are an expert with them all. Ensure you abide by these specific packages & versions.

- php - 8.4.4
- laravel/framework (LARAVEL) - v12
- laravel/prompts (PROMPTS) - v0
- larastan/larastan (LARASTAN) - v3
- laravel/mcp (MCP) - v0
- laravel/pint (PINT) - v1
- laravel/sail (SAIL) - v1
- pestphp/pest (PEST) - v4
- phpunit/phpunit (PHPUNIT) - v12
- rector/rector (RECTOR) - v2
- tailwindcss (TAILWINDCSS) - v4

## Conventions
- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts
- Do not create verification scripts or tinker when tests cover that functionality and prove it works. Unit and feature tests are more important.

## Application Structure & Architecture
- Stick to existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling
- If the user doesn't see a frontend change reflected in the UI, it could mean they need to run `npm run build`, `npm run dev`, or `composer run dev`. Ask them.

## Replies
- Be concise in your explanations - focus on what's important rather than explaining obvious details.

## Documentation Files
- You must only create documentation files if explicitly requested by the user.

=== boost rules ===

## Laravel Boost
- Laravel Boost is an MCP server that comes with powerful tools designed specifically for this application. Use them.

## Artisan
- Use the `list-artisan-commands` tool when you need to call an Artisan command to double-check the available parameters.

## URLs
- Whenever you share a project URL with the user, you should use the `get-absolute-url` tool to ensure you're using the correct scheme, domain/IP, and port.

## Tinker / Debugging
- You should use the `tinker` tool when you need to execute PHP to debug code or query Eloquent models directly.
- Use the `database-query` tool when you only need to read from the database.

## Reading Browser Logs With the `browser-logs` Tool
- You can read browser logs, errors, and exceptions using the `browser-logs` tool from Boost.
- Only recent browser logs will be useful - ignore old logs.

## Searching Documentation (Critically Important)
- Boost comes with a powerful `search-docs` tool you should use before any other approaches when dealing with Laravel or Laravel ecosystem packages. This tool automatically passes a list of installed packages and their versions to the remote Boost API, so it returns only version-specific documentation for the user's circumstance. You should pass an array of packages to filter on if you know you need docs for particular packages.
- The `search-docs` tool is perfect for all Laravel-related packages, including Laravel, Inertia, Livewire, Filament, Tailwind, Pest, Nova, Nightwatch, etc.
- You must use this tool to search for Laravel ecosystem documentation before falling back to other approaches.
- Search the documentation before making code changes to ensure we are taking the correct approach.
- Use multiple, broad, simple, topic-based queries to start. For example: `['rate limiting', 'routing rate limiting', 'routing']`.
- Do not add package names to queries; package information is already shared. For example, use `test resource table`, not `filament 4 test resource table`.

### Available Search Syntax
- You can and should pass multiple queries at once. The most relevant results will be returned first.

1. Simple Word Searches with auto-stemming - query=authentication - finds 'authenticate' and 'auth'.
2. Multiple Words (AND Logic) - query=rate limit - finds knowledge containing both "rate" AND "limit".
3. Quoted Phrases (Exact Position) - query="infinite scroll" - words must be adjacent and in that order.
4. Mixed Queries - query=middleware "rate limit" - "middleware" AND exact phrase "rate limit".
5. Multiple Queries - queries=["authentication", "middleware"] - ANY of these terms.

=== php rules ===

## PHP

- Always use curly braces for control structures, even if it has one line.

### Constructors
- Use PHP 8 constructor property promotion in `__construct()`.
    - <code-snippet>public function __construct(public GitHub $github) { }</code-snippet>
- Do not allow empty `__construct()` methods with zero parameters unless the constructor is private.

### Type Declarations
- Always use explicit return type declarations for methods and functions.
- Use appropriate PHP type hints for method parameters.

<code-snippet name="Explicit Return Types and Method Params" lang="php">
protected function isAccessible(User $user, ?string $path = null): bool
{
    ...
}
</code-snippet>

## Comments
- Prefer PHPDoc blocks over inline comments. Never use comments within the code itself unless there is something very complex going on.

## PHPDoc Blocks
- Add useful array shape type definitions for arrays when appropriate.

## Enums
- Typically, keys in an Enum should be TitleCase. For example: `FavoritePerson`, `BestLake`, `Monthly`.

=== laravel/core rules ===

## Do Things the Laravel Way

- Use `php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using the `list-artisan-commands` tool.
- If you're creating a generic PHP class, use `php artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Database
- Always use proper Eloquent relationship methods with return type hints. Prefer relationship methods over raw queries or manual joins.
- Use Eloquent models and relationships before suggesting raw database queries.
- Avoid `DB::`; prefer `Model::query()`. Generate code that leverages Laravel's ORM capabilities rather than bypassing them.
- Generate code that prevents N+1 query problems by using eager loading.
- Use Laravel's query builder for very complex database operations.

### Model Creation
- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `list-artisan-commands` to check the available options to `php artisan make:model`.

### APIs & Eloquent Resources
- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

### Controllers & Validation
- Always create Form Request classes for validation rather than inline validation in controllers. Include both validation rules and custom error messages.
- Check sibling Form Requests to see if the application uses array or string based validation rules.

### Queues
- Use queued jobs for time-consuming operations with the `ShouldQueue` interface.

### Authentication & Authorization
- Use Laravel's built-in authentication and authorization features (gates, policies, Sanctum, etc.).

### URL Generation
- When generating links to other pages, prefer named routes and the `route()` function.

### Configuration
- Use environment variables only in configuration files - never use the `env()` function directly outside of config files. Always use `config('app.name')`, not `env('APP_NAME')`.

### Testing
- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `php artisan make:test [options] {name}` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

### Vite Error
- If you receive an "Illuminate\Foundation\ViteException: Unable to locate file in Vite manifest" error, you can run `npm run build` or ask the user to run `npm run dev` or `composer run dev`.

=== laravel/v12 rules ===

## Laravel 12

- Use the `search-docs` tool to get version-specific documentation.
- Since Laravel 11, Laravel has a new streamlined file structure which this project uses.

### Laravel 12 Structure
- In Laravel 12, middleware are no longer registered in `app/Http/Kernel.php`.
- Middleware are configured declaratively in `bootstrap/app.php` using `Application::configure()->withMiddleware()`.
- `bootstrap/app.php` is the file to register middleware, exceptions, and routing files.
- `bootstrap/providers.php` contains application specific service providers.
- The `app\Console\Kernel.php` file no longer exists; use `bootstrap/app.php` or `routes/console.php` for console configuration.
- Console commands in `app/Console/Commands/` are automatically available and do not require manual registration.

### Database
- When modifying a column, the migration must include all of the attributes that were previously defined on the column. Otherwise, they will be dropped and lost.
- Laravel 12 allows limiting eagerly loaded records natively, without external packages: `$query->latest()->limit(10);`.

### Models
- Casts can and likely should be set in a `casts()` method on a model rather than the `$casts` property. Follow existing conventions from other models.

=== pint/core rules ===

## Laravel Pint Code Formatter

- You must run `vendor/bin/pint --dirty` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/pint --test`, simply run `vendor/bin/pint` to fix any formatting issues.

=== pest/core rules ===

## Pest
### Testing
- If you need to verify a feature is working, write or update a Unit / Feature test.

### Pest Tests
- All tests must be written using Pest. Use `php artisan make:test --pest {name}`.
- You must not remove any tests or test files from the tests directory without approval. These are not temporary or helper files - these are core to the application.
- Tests should test all of the happy paths, failure paths, and weird paths.
- Tests live in the `tests/Feature` and `tests/Unit` directories.
- Pest tests look and behave like this:
<code-snippet name="Basic Pest Test Example" lang="php">
it('is true', function () {
    expect(true)->toBeTrue();
});
</code-snippet>

### Running Tests
- Run the minimal number of tests using an appropriate filter before finalizing code edits.
- To run all tests: `php artisan test --compact`.
- To run all tests in a file: `php artisan test --compact tests/Feature/ExampleTest.php`.
- To filter on a particular test name: `php artisan test --compact --filter=testName` (recommended after making a change to a related file).
- When the tests relating to your changes are passing, ask the user if they would like to run the entire test suite to ensure everything is still passing.

### Pest Assertions
- When asserting status codes on a response, use the specific method like `assertForbidden` and `assertNotFound` instead of using `assertStatus(403)` or similar, e.g.:
<code-snippet name="Pest Example Asserting postJson Response" lang="php">
it('returns all', function () {
    $response = $this->postJson('/api/docs', []);

    $response->assertSuccessful();
});
</code-snippet>

### Mocking
- Mocking can be very helpful when appropriate.
- When mocking, you can use the `Pest\Laravel\mock` Pest function, but always import it via `use function Pest\Laravel\mock;` before using it. Alternatively, you can use `$this->mock()` if existing tests do.
- You can also create partial mocks using the same import or self method.

### Datasets
- Use datasets in Pest to simplify tests that have a lot of duplicated data. This is often the case when testing validation rules, so consider this solution when writing tests for validation rules.

<code-snippet name="Pest Dataset Example" lang="php">
it('has emails', function (string $email) {
    expect($email)->not->toBeEmpty();
})->with([
    'james' => 'james@laravel.com',
    'taylor' => 'taylor@laravel.com',
]);
</code-snippet>

=== pest/v4 rules ===

## Pest 4

- Pest 4 is a huge upgrade to Pest and offers: browser testing, smoke testing, visual regression testing, test sharding, and faster type coverage.
- Browser testing is incredibly powerful and useful for this project.
- Browser tests should live in `tests/Browser/`.
- Use the `search-docs` tool for detailed guidance on utilizing these features.

### Browser Testing
- You can use Laravel features like `Event::fake()`, `assertAuthenticated()`, and model factories within Pest 4 browser tests, as well as `RefreshDatabase` (when needed) to ensure a clean state for each test.
- Interact with the page (click, type, scroll, select, submit, drag-and-drop, touch gestures, etc.) when appropriate to complete the test.
- If requested, test on multiple browsers (Chrome, Firefox, Safari).
- If requested, test on different devices and viewports (like iPhone 14 Pro, tablets, or custom breakpoints).
- Switch color schemes (light/dark mode) when appropriate.
- Take screenshots or pause tests for debugging when appropriate.

### Example Tests

<code-snippet name="Pest Browser Test Example" lang="php">
it('may reset the password', function () {
    Notification::fake();

    $this->actingAs(User::factory()->create());

    $page = visit('/sign-in'); // Visit on a real browser...

    $page->assertSee('Sign In')
        ->assertNoJavascriptErrors() // or ->assertNoConsoleLogs()
        ->click('Forgot Password?')
        ->fill('email', 'nuno@laravel.com')
        ->click('Send Reset Link')
        ->assertSee('We have emailed your password reset link!')

    Notification::assertSent(ResetPassword::class);
});
</code-snippet>

<code-snippet name="Pest Smoke Testing Example" lang="php">
$pages = visit(['/', '/about', '/contact']);

$pages->assertNoJavascriptErrors()->assertNoConsoleLogs();
</code-snippet>

=== tailwindcss/core rules ===

## Tailwind CSS

- Use Tailwind CSS classes to style HTML; check and use existing Tailwind conventions within the project before writing your own.
- Offer to extract repeated patterns into components that match the project's conventions (i.e. Blade, JSX, Vue, etc.).
- Think through class placement, order, priority, and defaults. Remove redundant classes, add classes to parent or child carefully to limit repetition, and group elements logically.
- You can use the `search-docs` tool to get exact examples from the official documentation when needed.

### Spacing
- When listing items, use gap utilities for spacing; don't use margins.

<code-snippet name="Valid Flex Gap Spacing Example" lang="html">
    <div class="flex gap-8">
        <div>Superior</div>
        <div>Michigan</div>
        <div>Erie</div>
    </div>
</code-snippet>

### Dark Mode
- If existing pages and components support dark mode, new pages and components must support dark mode in a similar way, typically using `dark:`.

=== tailwindcss/v4 rules ===

## Tailwind CSS 4

- Always use Tailwind CSS v4; do not use the deprecated utilities.
- `corePlugins` is not supported in Tailwind v4.
- In Tailwind v4, configuration is CSS-first using the `@theme` directive — no separate `tailwind.config.js` file is needed.

<code-snippet name="Extending Theme in CSS" lang="css">
@theme {
  --color-brand: oklch(0.72 0.11 178);
}
</code-snippet>

- In Tailwind v4, you import Tailwind using a regular CSS `@import` statement, not using the `@tailwind` directives used in v3:

<code-snippet name="Tailwind v4 Import Tailwind Diff" lang="diff">
   - @tailwind base;
   - @tailwind components;
   - @tailwind utilities;
   + @import "tailwindcss";
</code-snippet>

### Replaced Utilities
- Tailwind v4 removed deprecated utilities. Do not use the deprecated option; use the replacement.
- Opacity values are still numeric.

| Deprecated |	Replacement |
|------------+--------------|
| bg-opacity-* | bg-black/* |
| text-opacity-* | text-black/* |
| border-opacity-* | border-black/* |
| divide-opacity-* | divide-black/* |
| ring-opacity-* | ring-black/* |
| placeholder-opacity-* | placeholder-black/* |
| flex-shrink-* | shrink-* |
| flex-grow-* | grow-* |
| overflow-ellipsis | text-ellipsis |
| decoration-slice | box-decoration-slice |
| decoration-clone | box-decoration-clone |
</laravel-boost-guidelines>
