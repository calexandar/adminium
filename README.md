# Adminium

A modular Laravel admin panel and CMS built with Tailwind CSS.

## Requirements

- PHP 8.4+
- Laravel 12 or 13
- Node.js (for the frontend assets)
- A database supported by Laravel

## Install from a private GitHub repository

Add the repository to the application that will consume the package:

```bash
composer config repositories.adminium vcs https://github.com/calexandar/adminium-package
composer require calexandar/adminium:dev-main
```

Replace the URL with your private repository. Composer needs access to it:

- HTTPS: create a GitHub token and run
  `composer config --global github-oauth.github.com <token>`
- SSH: use `git@github.com:calexandar/adminium-package.git` and make sure your
  SSH key is available to Composer.

If the repository has a tagged release, you can require a version instead:

```bash
composer require calexandar/adminium:^1.0
```

## Install the panel

```bash
php artisan adminium:install
php artisan migrate
```

Or do everything in one command:

```bash
php artisan adminium:install --migrate --seed
```

The `--seed` flag creates the `super_admin` role, every module permission, and
the default super admin (`superadmin@gmail.com` / `password`). Change that
password immediately.

`adminium:install` publishes the config and assets, publishes the Spatie
Permission and Media Library migrations when they are missing, and creates the
storage link.

### Authentication

Adminium configures the `users` auth provider to use
`config('adminium.user_model')`, which defaults to
`Calexandar\Adminium\UserManagment\User`. The model must use the Spatie
`HasRoles` trait and the Media Library `InteractsWithMedia` trait.

To use your own model, create one that extends the package user and set it in
`config/adminium.php`:

```php
'user_model' => App\Models\User::class,
```

### Frontend assets

Add the package entries to `vite.config.js`:

```js
input: [
    'resources/css/app.css',
    'resources/js/app.js',
    'vendor/calexandar/adminium/resources/css/adminium.css',
    'vendor/calexandar/adminium/resources/js/adminium.js',
],
```

The package uses `@tailwindplus/elements` for the interactive components:

```bash
npm install @tailwindplus/elements
```

Point the package at those entries in `config/adminium.php`:

```php
'vite' => [
    'vendor/calexandar/adminium/resources/css/adminium.css',
    'vendor/calexandar/adminium/resources/js/adminium.js',
],
```

Then build the assets:

```bash
npm run build
```

Alternatively, keep the default `resources/css/app.css` and
`resources/js/app.js` entries and include the package sources from your own
entry files:

```css
/* resources/css/app.css */
@source '../../vendor/calexandar/adminium/src/**/*.blade.php';
```

```js
// resources/js/app.js
import '@tailwindplus/elements';
```

### Logo

Place your logo at `storage/app/public/images/adminium-logo.png` or publish the
config and change the `logo` path. When the file is missing, the panel renders
an "Adminium" wordmark instead of a broken image.

### Configuration

Publish the config file to change the route prefix, enable or disable modules,
or customize the logo and Vite entries:

```bash
php artisan vendor:publish --tag=adminium-config
```

### Sign in

The panel is available at `/admin/sign-in` by default. The route prefix can be
changed with `ADMINIUM_ROUTE_PREFIX` or the `route_prefix` config value.

## Local development

When developing the package from a monorepo, add a path repository instead:

```json
"repositories": [
    {
        "type": "path",
        "url": "packages/adminium",
        "options": {
            "symlink": true
        }
    }
]
```

## Testing

```bash
composer install
vendor/bin/pest
vendor/bin/phpstan analyse
vendor/bin/pint --test
```

## License

MIT. See [LICENSE](LICENSE).
