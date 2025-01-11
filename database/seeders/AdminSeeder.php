<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'id' => (string) Str::uuid(),
            'name' => 'Admin',
            'username' => 'admin',
            'phone' => '081234567890',
            'email' => 'tes@gmail.com',
            'password' => bcrypt('password'),
            'token' => 'tes',
        ]);
    }
}
