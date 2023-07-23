<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tworzenie użytkownika
        $user = User::create([
            'name' => 'Adam',
            'email' => 'adam@mail.pl',
            'password' => bcrypt('qwerty'),
        ]);

        // Przypisanie roli administratora
        $adminRole = Role::where('name', 'Admin')->first();

        if ($adminRole) {
            $user->roles()->attach($adminRole);
        }
    }
}
