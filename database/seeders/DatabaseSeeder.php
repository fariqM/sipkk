<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(1)->create();
        $role1 = Role::create(['name' => 'Super Admin']);
        $role2 = Role::create(['name' => 'Bendahara']);
        $role3 = Role::create(['name' => 'Pemantau']);

        $permission = Permission::create(['name' => 'create']);
        $role1->givePermissionTo($permission);
        $role2->givePermissionTo($permission);

        $permission = Permission::create(['name' => 'update']);
        $role1->givePermissionTo($permission);
        $role2->givePermissionTo($permission);

        $permission = Permission::create(['name' => 'read']);
        $role1->givePermissionTo($permission);
        $role2->givePermissionTo($permission);

        $permission = Permission::create(['name' => 'delete']);
        $role1->givePermissionTo($permission);
        $role2->givePermissionTo($permission);

        // create admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $admin->assignRole('Super Admin');
    }
}
