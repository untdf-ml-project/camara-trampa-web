<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'              => 'PanalSoft',
            'email'             => 'panalsoft.ush@gmail.com',
            'email_verified_at' => now(),
            'password'          => bcrypt('123456'),
        ]);
    }
}
