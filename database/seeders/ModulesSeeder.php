<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = array(
            array('name'=>'Dashboard','url'=>'/dashboard','icon'=>'fas fa-chart-line'),
            array('name'=>'Users','url'=>'/users','icon'=>'fas fa-users'),
            array('name'=>'Categories','url'=>'/categories','icon'=>'fas fa-venus-mars'),
            array('name'=>'Products','url'=>'/products','icon'=>'fab fa-product-hunt'),
        );
        \DB::table('modules')->insert($modules);
    }
}
