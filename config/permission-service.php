<?php

use Rickgoemans\LaravelPermissionService\Enums\PermissionAction;

// config for Rickgoemans/LaravelPermissionService
return [
    /*
     * The separator that's being used between the model it's name and the action.
     */
    'separator' => '.',

    /*
     * The names of the methods that reflect the action.
     */
    'action_names' => [
        PermissionAction::VIEW->value => 'view',
        PermissionAction::CREATE->value => 'create',
        PermissionAction::UPDATE->value => 'update',
        PermissionAction::DELETE->value => 'delete',
        PermissionAction::RESTORE->value => 'restore',
        PermissionAction::FORCE_DELETE->value => 'force_delete',
    ],
];
