<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => 'super-admin',
            'username' => Str::slug('super-admin'),
            'email' => 'super-admin@mail.com',
            'password' => Hash::make('rahasiaadmin'),
        ]);
        $user->assignRole('super-admin');

        $user = User::create([
            'name' => 'siswa',
            'username' => Str::slug('siswa'),
            'email' => 'siswa@mail.com',
            'password' => Hash::make('rahasiaadmin'),
        ]);
        $user->assignRole('siswa');

        $user = User::create([
            'name' => 'administrator',
            'username' => Str::slug('administrator'),
            'email' => 'administrator@mail.com',
            'password' => Hash::make('rahasiaadmin'),
        ]);
        $user->assignRole('administrator');

    }
}
