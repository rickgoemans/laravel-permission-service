<?php

namespace Rickgoemans\LaravelPermissionService\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Rickgoemans\LaravelPermissionService\LaravelPermissionServiceServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(fn (string $modelName) => 'Rickgoemans\\LaravelPermissionService\\Database\\Factories\\'.class_basename($modelName).'Factory');
    }

    protected function getPackageProviders($app): array
    {
        return [
            LaravelPermissionServiceServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');
    }
}
