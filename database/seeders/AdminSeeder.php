<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => env('ADMIN_NAME'),
            'email' => env('ADMIN_EMAIL'),
            'phone' => env('ADMIN_PHONE'),
            'type' => Status::ADMIN,
            'password' => Hash::make(env('ADMIN_PASSWORD')),
        ]);
    }
}
