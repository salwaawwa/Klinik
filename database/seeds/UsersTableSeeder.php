<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin2',
            'email' => 'admin2@example.com',
            'password' => Hash::make('password'),
            'role' => 'owner',
            'status' => 1
        ]);
    }
}
