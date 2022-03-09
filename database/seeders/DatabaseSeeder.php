<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\AccountCategory;
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

        $bendahara = User::create([
            'name' => 'Bendahara',
            'email' => 'bendahara@sipkk.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $bendahara->assignRole('Bendahara');

        $Pemantau = User::create([
            'name' => 'Pemantau',
            'email' => 'pemantau@sipkk.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $Pemantau->assignRole('Pemantau');

        Account::create([
            'title' => 'KAS'
        ]);

        Account::create([
            'title' => 'PENERIMAAN'
        ]);

        AccountCategory::create([
            'level' => 3,
            'account_id' => 1,
            'code' => '1.01.01',
            'title' => 'Kas Lingkungan'
        ]);
        AccountCategory::create([
            'level' => 3,
            'account_id' => 1,
            'code' => '1.01.02',
            'title' => 'Kas Kecil Blok'
        ]);

        AccountCategory::create([
            'level' => 3,
            'account_id' => 2,
            'code' => '2.01.01',
            'title' => 'Kolekte'
        ]);
        AccountCategory::create([
            'level' => 3,
            'account_id' => 2,
            'code' => '2.01.02',
            'title' => 'Subsidi Paroki'
        ]);
        AccountCategory::create([
            'level' => 3,
            'account_id' => 2,
            'code' => '2.01.03',
            'title' => 'Lainnya'
        ]);

        // \App\Models\User::factory(5)->create();
    }
}
