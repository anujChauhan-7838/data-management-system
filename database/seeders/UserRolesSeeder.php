<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRoles = array(
            array('user_id'=>1,'role_id'=>1,'module_id'=>1,'add'=>1,'edit'=>1,'view'=>1,'delete'=>1),
            array('user_id'=>1,'role_id'=>1,'module_id'=>2,'add'=>1,'edit'=>1,'view'=>1,'delete'=>1),
            array('user_id'=>1,'role_id'=>1,'module_id'=>3,'add'=>1,'edit'=>1,'view'=>1,'delete'=>1),
            array('user_id'=>1,'role_id'=>1,'module_id'=>4,'add'=>1,'edit'=>1,'view'=>1,'delete'=>1)
        );
        \DB::table('user_roles')->insert($userRoles);
    }
}
