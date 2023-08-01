<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234567890'),
            'telephone' => '083123456789',
            'address' => 'Kuningan',
        ]);

        $admin->assignRole('admin');

        $customer_service = User::create([
            'name' => 'Customer Service',
            'email' => 'customerservice@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234567890'),
            'telephone' => '083123456789',
            'address' => 'Kuningan',
        ]);

        $customer_service->assignRole('customer service');

        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234567890'),
            'telephone' => '083123456789',
            'address' => 'Kuningan',
        ]);

        $user->assignRole('user');
    }
}
