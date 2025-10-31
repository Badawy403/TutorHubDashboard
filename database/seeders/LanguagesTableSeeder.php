<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('languages')->delete();
        
        \DB::table('languages')->insert(array (
            0 => 
            array (
                'id' => 4,
                'name' => 'English',
                'description' => '<p>English</p>',
                'code' => 'en',
                'country_code' => 'US',
                'image' => NULL,
                'is_default' => 1,
                'is_active' => 1,
                'created_at' => '2021-09-08 12:15:06',
                'updated_at' => '2023-01-16 14:59:30',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 16,
                'name' => 'Hindi',
                'description' => '<p>Hindi Language&nbsp;</p>',
                'code' => 'hi',
                'country_code' => 'IN',
                'image' => NULL,
                'is_default' => 0,
                'is_active' => 1,
                'created_at' => '2023-10-05 18:14:06',
                'updated_at' => '2023-10-05 18:14:06',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 17,
                'name' => 'Arabic',
                'description' => '<p>Arabic Language&nbsp;</p>',
                'code' => 'ar',
                'country_code' => 'AE',
                'image' => NULL,
                'is_default' => 0,
                'is_active' => 1,
                'created_at' => '2023-10-05 18:15:02',
                'updated_at' => '2023-10-05 18:15:02',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}