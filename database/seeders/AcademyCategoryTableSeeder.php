<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AcademyCategoryTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('academy_category')->delete();
        
        \DB::table('academy_category')->insert(array (
            0 => 
            array (
                'id' => 5,
                'academy_category_id' => 1,
                'academy_id' => 9,
            ),
            1 => 
            array (
                'id' => 6,
                'academy_category_id' => 1,
                'academy_id' => 11,
            ),
            2 => 
            array (
                'id' => 7,
                'academy_category_id' => 1,
                'academy_id' => 14,
            ),
            3 => 
            array (
                'id' => 8,
                'academy_category_id' => 5,
                'academy_id' => 8,
            ),
            4 => 
            array (
                'id' => 10,
                'academy_category_id' => 16,
                'academy_id' => 5,
            ),
            5 => 
            array (
                'id' => 12,
                'academy_category_id' => 16,
                'academy_id' => 1,
            ),
            6 => 
            array (
                'id' => 13,
                'academy_category_id' => 5,
                'academy_id' => 6,
            ),
            7 => 
            array (
                'id' => 14,
                'academy_category_id' => 15,
                'academy_id' => 3,
            ),
        ));
        
        
    }
}