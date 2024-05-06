<?php

declare(strict_types=1);

namespace Vdlp\Redirect\Updates;

use Backend\Models\User;
use Backend\Models\UserRole;
use October\Rain\Database\Model;
use October\Rain\Database\Updates\Migration;

class AddNewStatisticsPermissionToCurrentUsersAndRoles extends Migration
{
    public function up(): void
    {
        if (!class_exists(User::class) || !class_exists(UserRole::class)) {
            // A check for future releases of October CMS, where the User and Role models might not exist anymore.
            return;
        }

        /** @var User $user */
        foreach (User::query()->cursor() as $user) {
            $this->updatePermission($user);
        }

        /** @var UserRole $role */
        foreach (UserRole::query()->cursor() as $role) {
            $this->updatePermission($role);
        }
    }

    public function down(): void
    {
        // No need to revert the changes.
    }

    private function updatePermission(Model $model): void
    {
        $permissions = $model->getAttribute('permissions');

        if (!is_array($permissions) || !array_key_exists('vdlp.redirect.access_redirects', $permissions)) {
            return;
        }

        $permissions['vdlp.redirect.access_redirect_statistics'] = 1;
        $model->setAttribute('permissions', $permissions);
        $model->save();
    }
};
