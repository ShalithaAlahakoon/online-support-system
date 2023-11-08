<?php

namespace Database\Seeders;

use Domain\User\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ModuleTableSeeder::class);

        DB::table('roles')->insert([
            ['name' => 'Admin', 'guard_name' => 'web', 'description' => 'This is admin role', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Support Agent', 'guard_name' => 'web', 'description' => 'This is support agent role', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'User', 'guard_name' => 'web', 'description' => 'This is user role', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $adminRole = Role::where('id', 1)->first();
        $adminRole->givePermissionTo(['View dashboard', 'Create user', 'Edit user', 'View user', 'Delete user']);

        $supportAgentRole = Role::where('id', 2)->first();
        $supportAgentRole->givePermissionTo(['View dashboard', 'Create ticket', 'Edit ticket', 'View ticket', 'Delete ticket']);

        User::factory(100)->create();

        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@onlinesupportsystem.com',
            'role_id' => 1,
        ]);

        User::factory()->create([
            'name' => 'Support Agent',
            'email' => 'support@onlinesupportsystem.com',
            'role_id' => 2,
        ]);

        $adminUser = User::where('name', 'Super Admin')->first();
        $adminUser->assignRole($adminRole);

        $supportAgentUser = User::where('name', 'Support Agent')->first();
        $supportAgentUser->assignRole($supportAgentRole);
    }
}
