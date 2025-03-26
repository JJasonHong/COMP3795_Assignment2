<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Adjust namespace if needed
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin user a@a.a
        User::create([
            'username' => 'a@a.a',
            'firstName' => 'AdminA',
            'lastName' => 'User',
            'password' => Hash::make('P@$$w0rd'),
            'isApproved' => true,
            'role' => 'Admin',
        ]);

        // Admin user b@b.b
        User::create([
            'username' => 'b@b.b',
            'firstName' => 'AdminB',
            'lastName' => 'User',
            'password' => Hash::make('P@$$w0rd'),
            'isApproved' => true,
            'role' => 'Admin',
        ]);
    }
}