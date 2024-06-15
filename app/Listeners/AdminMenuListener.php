<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use JeroenNoten\LaravelAdminLte\Menu\Builder;

class AdminMenuListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BuildingMenu $event): void
    {
        $event->menu->add([
            'header' => 'authorization_config',
            'can' => ['user view', 'role view', 'permission view']
        ]);

        $event->menu->add([
            'key' => 'authorization',
            'text' => 'Authorization',
            'icon' => '',
            'can' => ['user view', 'role view', 'permission view']
        ]);
        
        $event->menu->addIn('authorization', [
            'key' => 'admin_user',
            'text' => 'Users',
            'url' => route('admin.user.index'),
            'icon' => 'fas fa-fw fa-user',
        ]);

        $event->menu->addIn('authorization', [
            'key' => 'admin_role',
            'text' => 'Roles',
            'url' => route('admin.role.index'),
            'icon' => 'fas fa-fw fa-key',
        ]);

        $event->menu->addIn('authorization', [
            'key' => 'admin_permission',
            'text' => 'Permissions',
            'url' => route('admin.permission.index'),
            'icon' => 'fas fa-fw fa-eye',
        ]);

        $event->menu->add([
            'key' => 'account_settings',
            'text' => 'account_settings',
            'icon' => '',
            'submenu' => [
                [
                    'text' => 'profile',
                    'route' => 'admin.profile',
                    'icon' => 'fas fa-fw fa-user',
                ],
                [
                    'text' => 'change_password',
                    'route' => 'admin.change_password',
                    'icon' => 'fas fa-fw fa-lock',
                ],
            ]
        ]);

    }
}
