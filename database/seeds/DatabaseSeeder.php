<?php

use Illuminate\Database\Seeder;
use App\Entities\User;
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
        User::create([
            'isAdm'         => true,
        	'name' 			=> 'athos',
            'email' 		=> 'athos@sistemas.com',
            'phone'         => '1971025399',
        	'password' => Hash::make('password'),
        ]);
    }
}
