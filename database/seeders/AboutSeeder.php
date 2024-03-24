<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
            'title' => 'About US',
            'description' => 'Welcome to the System | Development By ( Front End Mohamed Emad ) And ( Back End Hassan Mohamed )',
        ]);
    }
}
