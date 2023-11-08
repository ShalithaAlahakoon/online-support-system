<?php

namespace Database\Seeders;

use Domain\User\Models\Module;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class ModuleTableSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            [
                'name' => 'Dashboard',
                'permissions' => [
                    ['name' => 'View dashboard'],
                ],
            ],
            [
                'name' => 'User',
                'permissions' => [
                    ['name' => 'Create user'],
                    ['name' => 'Edit user'],
                    ['name' => 'View user'],
                    ['name' => 'Delete user'],
                ],
            ],
            [
                'name' => 'Role',
                'permissions' => [
                    ['name' => 'Create role'],
                    ['name' => 'Edit role'],
                    ['name' => 'View role'],
                    ['name' => 'Delete role'],
                ],
            ],
            [
                'name' => 'Permission',
                'permissions' => [
                    ['name' => 'Create permission'],
                    ['name' => 'Edit permission'],
                    ['name' => 'View permission'],
                    ['name' => 'Delete permission'],
                ],
            ],
            [
                'name' => 'Ticket',
                'permissions' => [
                    ['name' => 'Create ticket'],
                    ['name' => 'Edit ticket'],
                    ['name' => 'View ticket'],
                    ['name' => 'Delete ticket'],
                ],
            ],
        ];

        $data = [];

        foreach ($modules as $module) {
            $createdModule = Module::create(['name' => $module['name']]);

            foreach ($module['permissions'] as $permission) {
                $data[] = ['name' => $permission['name'], 'module_id' => $createdModule->id, 'guard_name' => 'web'];
            }
        }

        Permission::insert($data);
    }
}
