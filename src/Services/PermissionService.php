<?php

namespace Rickgoemans\LaravelPermissionService\Services;

use Illuminate\Support\Str;
use Rickgoemans\LaravelPermissionService\Enums\PermissionAction;

class PermissionService
{
    /** @param  class-string  $model */
    public static function crudPermissions(string $model, bool $withRestore = false, bool $withForceDelete = false): array
    {
        $permissions = [
            static::viewPermission($model),
            static::createPermission($model),
            static::updatePermission($model),
            static::deletePermission($model),
        ];

        if ($withRestore) {
            $permissions[] = static::restorePermission($model);
        }

        if ($withForceDelete) {
            $permissions[] = static::forceDeletePermission($model);
        }

        return $permissions;
    }

    public static function viewPermission(string $model): string
    {
        return static::actionPermission($model, PermissionAction::VIEW);
    }

    public static function createPermission(string $model): string
    {
        return static::actionPermission($model, PermissionAction::CREATE);
    }

    public static function updatePermission(string $model): string
    {
        return static::actionPermission($model, PermissionAction::UPDATE);
    }

    public static function deletePermission(string $model): string
    {
        return static::actionPermission($model, PermissionAction::DELETE);
    }

    public static function restorePermission(string $model): string
    {
        return static::actionPermission($model, PermissionAction::RESTORE);
    }

    public static function forceDeletePermission(string $model): string
    {
        return static::actionPermission($model, PermissionAction::FORCE_DELETE);
    }

    public static function actionPermission(string $model, PermissionAction $action): string
    {
        $model = static::modelName($model);
        $separator = config('permission-service.separator');
        $action = config("permission-service.action_names.{$action->value}");

        return "{$model}{$separator}{$action}";
    }

    public static function packagePermission(string $package): string
    {
        $packagePrefix = config('permission-service.package_prefix');
        $separator = config('permission-service.separator');

        return "{$packagePrefix}{$separator}{$package}";
    }

    protected static function modelName(string $model): string
    {
        $class = class_basename($model);

        return Str::snake($class);
    }
}
