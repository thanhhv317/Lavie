<?php

use Illuminate\Database\Seeder;
use DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = array(
		    ['name' => 'Milk'],
		    ['name' => 'Book'],
		    ['name' => 'Beer'],
		    ['name' => 'Picture'],
		    ['name' => 'Ao Quan'],
		    ['name' => 'Water'],
		    ['name' => 'Nuoc co gar'],
		    ['name' => 'Orther']
		);
        DB::table('categories')->insert($data);
    }
}
