<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'Shafiul',
            'email' => 'shafiulbashar@zoho.com',
            'email_verified_at' => now(),
            'password' => Hash::make('hello1234'),
            'remember_token' => Str::random(10),
        ]);
    }
}
