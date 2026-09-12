<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@oncocare.com'],
            [
                'nom' => 'Admin',
                'prenom' => 'OncoCare',
                'telephone' => '0600000000',
                'password' => Hash::make('Admin@123456'),
                'role' => 'admin',
            ]
        );
    }
}