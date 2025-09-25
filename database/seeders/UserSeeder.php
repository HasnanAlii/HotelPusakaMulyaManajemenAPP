<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 🔹 Buat role
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $kasirRole = Role::firstOrCreate(['name' => 'kasir']);

        // 🔹 Buat permission
        $permissions = [
            'manage reservations',
            'manage finances',
            'manage customers',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // 🔹 Assign semua permission ke admin
        $adminRole->syncPermissions(Permission::all());

        // 🔹 Kasir hanya boleh kelola reservasi
        $kasirRole->syncPermissions(['manage reservations']);

        // 🔹 Buat user admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Hotel',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole($adminRole);

        // 🔹 Buat user kasir
        $kasir = User::firstOrCreate(
            ['email' => 'kasir@gmail.com'],
            [
                'name' => 'Kasir Hotel',
                'password' => Hash::make('password'),
            ]
        );
        $kasir->assignRole($kasirRole);
    }
}
