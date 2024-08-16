<?php
namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    public const HIDDEN_GUARD_NAME = 'sanctum';

    public const RESERVED_ROLE_NAME = [
        'admin' => 'admin',
        'super-admin' => 'super-admin'
    ];

    public static function getDefaultGuards() {
        $guards = config('auth.guards') ? array_keys(config('auth.guards')) : ['web'];
        $guards = array_filter($guards, function($value) {
            return ROLE::HIDDEN_GUARD_NAME !== $value;
        });
        return array_values($guards);
    }
}
