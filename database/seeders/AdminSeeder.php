<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            [
                'email' => 'admin@example.com'
            ],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password123'),
                'status' => true,
            ]
        );

        $admin->assignRole('super_admin');
    }
}