<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create(
            [
                'id' => 0,
                'school_id' => 0,
                'name' => 'Admin',
                'class' => '',
                'major' => '',
                'username' => 'admin_perpustakaan',
                'role' => 'admin',
                'password' => Hash::make('admin123'),
                'email' => 'perpustakaan@smktelkom-jkt.sch.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );
    }
}
