<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $user = User::create([
            'email' => 'user1@email.com',
            'password' => bcrypt('12345678'),
            'name' => 'Kim Dahyun',
            'created_at' => now(),
        ]);

        $user->assignRole('user');
    }
}
