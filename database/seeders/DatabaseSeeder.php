<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => "Admin",
            'last_name' => "admin",
            'email' => "admin@covid.com",
            'password' => Hash::make("temp"),
            'type' => "admin",
        ]);
    }
}
