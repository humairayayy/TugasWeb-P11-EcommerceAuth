<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Admin',    'email' => 'admin@example.com',   'role' => 'admin'],
            ['name' => 'Editor',   'email' => 'editor@example.com',  'role' => 'editor'],
            ['name' => 'Editor 2', 'email' => 'editor2@example.com', 'role' => 'editor'],
            ['name' => 'User',     'email' => 'user@example.com',    'role' => 'user'],
        ];

        foreach ($users as $u) {
            User::updateOrCreate(['email' => $u['email']], $u + [
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);
        }
    }
}