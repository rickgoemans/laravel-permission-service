# A Laravel permission helper service

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rickgoemans/laravel-permission-service.svg?style=flat-square)](https://packagist.org/packages/rickgoemans/laravel-permission-service)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/rickgoemans/laravel-permission-service/run-tests?label=tests)](https://github.com/rickgoemans/laravel-permission-service/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/rickgoemans/laravel-permission-service/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/rickgoemans/laravel-permission-service/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/rickgoemans/laravel-permission-service.svg?style=flat-square)](https://packagist.org/packages/rickgoemans/laravel-permission-service)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-permission-service.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-permission-service)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us
by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We
publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require rickgoemans/laravel-permission-service
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-permission-service-config"
```

This is the contents of the published config file:

```php
<?php

use Rickgoemans\LaravelPermissionService\Enums\PermissionAction;

// config for Rickgoemans/LaravelPermissionService
return [
    /*
     * The separator that's being used between the model it's name and the action.
     */
    'separator'    => '.',

    /*
     * The names of the methods that reflect the action.
     */
    'action_names' => [
        PermissionAction::VIEW->value         => 'view',
        PermissionAction::CREATE->value       => 'create',
        PermissionAction::UPDATE->value       => 'update',
        PermissionAction::DELETE->value       => 'delete',
        PermissionAction::RESTORE->value      => 'restore',
        PermissionAction::FORCE_DELETE->value => 'force_delete',
    ],
    
    /*
     * The package prefix that is being used for package permissions.
     */
    'package_prefix' => 'package',
];

```

## Usage

Here's an example in a configuration file containing all permissions that the system holds to sync them on deployment (through a seeder probably).

```php
<?php

use App\Models\Activity;
use App\Models\Customer;
use App\Models\User;
use Rickgoemans\LaravelPermissionService\Services\PermissionService;

return [
    'all' => [
        PermissionService::viewPermission(Activity::class),
        ...PermissionService::crudPermissions(User::class),
        ...PermissionService::crudPermissions(Customer::class, true, true),
        ...PermissionService::packagePermission('nova'),
    ],
];
```

Here's an example of how this can be used in a policy.

```php
<?php

namespace App\Policies;

use App\Models\Example;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Rickgoemans\LaravelApiResponseHelpers\ApiResponse;

class ExamplePolicy extends Controller {
    use HandlesAuthorization;
    
    public function viewAny(User $auth): Response|bool
    {
        return $auth->can(PermissionService::viewPermission(Example::class));
    }

    public function view(User $auth, Example $example): Response|bool
    {
        return $auth->can(PermissionService::viewPermission(Example::class));
    }

    public function create(User $auth): Response|bool
    {
        return $auth->can(PermissionService::createPermission(Example::class));
    }

    public function update(User $auth, Example $example): Response|bool
    {
        return $auth->can(PermissionService::updatePermission(Example::class));
    }

    public function delete(User $auth, Example $example): Response|bool
    {
        return $auth->can(PermissionService::deletePermission(Example::class));
    }

    public function restore(User $auth, Example $example): Response|bool
    {
        return $auth->can(PermissionService::restorePermission(Example::class));
    }

    public function forceDelete(User $auth, Example $example): Response|bool
    {
        return $auth->can(PermissionService::forceDeletePermission(Example::class));
    }
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Rick Goemans](https://github.com/rickgoemans)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
