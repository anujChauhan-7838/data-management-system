<?php

namespace Database\Seeders;

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
        $user = array(
            'first_name' => 'Anuj',
            'last_name'  => 'Chauhan',
            'email'      => 'sm.anuj.chauhan@yopmail.com',
            'user_type'   => 1,
            'password'   => bcrypt('12345678')
        );
        \DB::table('users')->insert($user);
    }
}
