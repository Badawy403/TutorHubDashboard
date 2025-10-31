<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AcademyLanguageTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('academy_language')->delete();
        
        \DB::table('academy_language')->insert(array (
            0 => 
            array (
                'id' => 1,
                'academy_id' => 5,
                'all_language_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'academy_id' => 3,
                'all_language_id' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'academy_id' => 3,
                'all_language_id' => 2,
            ),
            3 => 
            array (
                'id' => 4,
                'academy_id' => 11,
                'all_language_id' => 6,
            ),
            4 => 
            array (
                'id' => 5,
                'academy_id' => 6,
                'all_language_id' => 3,
            ),
        ));
        
        
    }
}