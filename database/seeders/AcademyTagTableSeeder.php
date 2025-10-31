<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AcademyTagTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('academy_tag')->delete();
        
        \DB::table('academy_tag')->insert(array (
            0 => 
            array (
                'id' => 1,
                'academy_id' => 5,
                'tag_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'academy_id' => 5,
                'tag_id' => 3,
            ),
            2 => 
            array (
                'id' => 3,
                'academy_id' => 3,
                'tag_id' => 4,
            ),
            3 => 
            array (
                'id' => 4,
                'academy_id' => 3,
                'tag_id' => 5,
            ),
            4 => 
            array (
                'id' => 5,
                'academy_id' => 3,
                'tag_id' => 3,
            ),
            5 => 
            array (
                'id' => 6,
                'academy_id' => 11,
                'tag_id' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'academy_id' => 11,
                'tag_id' => 4,
            ),
            7 => 
            array (
                'id' => 8,
                'academy_id' => 11,
                'tag_id' => 3,
            ),
            8 => 
            array (
                'id' => 9,
                'academy_id' => 11,
                'tag_id' => 5,
            ),
            9 => 
            array (
                'id' => 10,
                'academy_id' => 11,
                'tag_id' => 6,
            ),
            10 => 
            array (
                'id' => 11,
                'academy_id' => 6,
                'tag_id' => 4,
            ),
            11 => 
            array (
                'id' => 12,
                'academy_id' => 6,
                'tag_id' => 1,
            ),
            12 => 
            array (
                'id' => 13,
                'academy_id' => 6,
                'tag_id' => 6,
            ),
        ));
        
        
    }
}