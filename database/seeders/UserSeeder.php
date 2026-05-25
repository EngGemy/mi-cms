<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['super-admin', 'admin', 'editor'];
        foreach ($roles as $r) {
            Role::firstOrCreate(['name' => $r, 'guard_name' => 'web']);
        }

        User::firstOrCreate(
            ['email' => 'admin@mi-poultry.com'],
            [
                'name' => 'مدير النظام',
                'password' => Hash::make('Admin@2026'),
                'email_verified_at' => now(),
            ]
        )->assignRole('super-admin');
    }
}
