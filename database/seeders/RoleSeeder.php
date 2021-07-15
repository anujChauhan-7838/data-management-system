<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
            array('name'=>'superadmin','display_name'=>'Super Admin'),
            array('name'=>'admin','display_name'=>'Admin'),
            array('name'=>'sadmin','display_name'=>'Sales Admin')
        );
        \DB::table('roles')->insert($roles);
    }
}
