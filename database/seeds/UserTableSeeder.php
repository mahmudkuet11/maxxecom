<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::truncate();
        \App\User::create([
            'name'  =>  'Mahmud',
            'email' =>  'mahmudkuet11@gmail.com',
            'password'  =>  bcrypt('123456')
        ]);
    }
}
