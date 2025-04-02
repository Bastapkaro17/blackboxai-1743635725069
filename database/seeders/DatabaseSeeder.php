<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'business_name' => 'Admin Business',
            'is_admin' => true,
        ]);

        // Create regular user
        User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'business_name' => 'Test Business',
            'username' => 'test-business',
        ]);

        // Create sample reviews
        User::find(2)->reviews()->createMany([
            ['rating' => 5, 'comment' => 'Great service!', 'source_ip' => '127.0.0.1'],
            ['rating' => 4, 'comment' => 'Good experience', 'source_ip' => '127.0.0.1'],
            ['rating' => 3, 'comment' => 'Average service', 'source_ip' => '127.0.0.1'],
        ]);
    }
}