<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure required roles exist
        $roles = ['super-admin', 'admin', 'editor'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }

        // Create or update the super-admin user
        $user = User::firstOrCreate(
            ['email' => 'admin@mi-poultry.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('Admin@2026'),
                'email_verified_at' => now(),
            ]
        );

        $user->syncRoles(['super-admin']);
    }
}
