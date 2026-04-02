<?php

use Rickgoemans\LaravelPermissionService\Enums\PermissionAction;

// config for Rickgoemans/LaravelPermissionService
return [
    /*
     * The separator that's being used between the model its name and the action.
     */
    'separator' => '.',

    /*
     * The names of the methods that reflect the action.
     */
    'action_names' => [
        PermissionAction::View->name => 'view',
        PermissionAction::Create->name => 'create',
        PermissionAction::Update->name => 'update',
        PermissionAction::Delete->name => 'delete',
        PermissionAction::Restore->name => 'restore',
        PermissionAction::ForceDelete->name => 'force_delete',
    ],

    /*
     * The package prefix that is being used for package permissions.
     */
    'package_prefix' => 'package',

    /*
     * The application prefix that is being used for application permissions.
     */
    'application_prefix' => 'app',
];
