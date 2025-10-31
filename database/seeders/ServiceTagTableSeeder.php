<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceTagTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_tag')->delete();
        
        \DB::table('service_tag')->insert(array (
            0 => 
            array (
                'id' => 1,
                'service_id' => 1,
                'tag_id' => 3,
            ),
            1 => 
            array (
                'id' => 2,
                'service_id' => 2,
                'tag_id' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'service_id' => 3,
                'tag_id' => 4,
            ),
            3 => 
            array (
                'id' => 4,
                'service_id' => 4,
                'tag_id' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'service_id' => 5,
                'tag_id' => 3,
            ),
            5 => 
            array (
                'id' => 6,
                'service_id' => 6,
                'tag_id' => 3,
            ),
            6 => 
            array (
                'id' => 7,
                'service_id' => 7,
                'tag_id' => 3,
            ),
            7 => 
            array (
                'id' => 8,
                'service_id' => 8,
                'tag_id' => 5,
            ),
            8 => 
            array (
                'id' => 9,
                'service_id' => 9,
                'tag_id' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'service_id' => 9,
                'tag_id' => 4,
            ),
            10 => 
            array (
                'id' => 11,
                'service_id' => 10,
                'tag_id' => 3,
            ),
            11 => 
            array (
                'id' => 12,
                'service_id' => 10,
                'tag_id' => 5,
            ),
            12 => 
            array (
                'id' => 13,
                'service_id' => 11,
                'tag_id' => 4,
            ),
            13 => 
            array (
                'id' => 14,
                'service_id' => 11,
                'tag_id' => 5,
            ),
            14 => 
            array (
                'id' => 15,
                'service_id' => 12,
                'tag_id' => 1,
            ),
            15 => 
            array (
                'id' => 16,
                'service_id' => 12,
                'tag_id' => 5,
            ),
            16 => 
            array (
                'id' => 17,
                'service_id' => 13,
                'tag_id' => 1,
            ),
            17 => 
            array (
                'id' => 18,
                'service_id' => 13,
                'tag_id' => 4,
            ),
            18 => 
            array (
                'id' => 19,
                'service_id' => 13,
                'tag_id' => 3,
            ),
            19 => 
            array (
                'id' => 20,
                'service_id' => 14,
                'tag_id' => 1,
            ),
            20 => 
            array (
                'id' => 21,
                'service_id' => 14,
                'tag_id' => 5,
            ),
            21 => 
            array (
                'id' => 22,
                'service_id' => 14,
                'tag_id' => 6,
            ),
            22 => 
            array (
                'id' => 23,
                'service_id' => 16,
                'tag_id' => 1,
            ),
            23 => 
            array (
                'id' => 24,
                'service_id' => 16,
                'tag_id' => 3,
            ),
            24 => 
            array (
                'id' => 25,
                'service_id' => 17,
                'tag_id' => 1,
            ),
            25 => 
            array (
                'id' => 26,
                'service_id' => 18,
                'tag_id' => 1,
            ),
            26 => 
            array (
                'id' => 27,
                'service_id' => 18,
                'tag_id' => 3,
            ),
            27 => 
            array (
                'id' => 28,
                'service_id' => 18,
                'tag_id' => 6,
            ),
            28 => 
            array (
                'id' => 29,
                'service_id' => 19,
                'tag_id' => 1,
            ),
            29 => 
            array (
                'id' => 30,
                'service_id' => 19,
                'tag_id' => 4,
            ),
            30 => 
            array (
                'id' => 31,
                'service_id' => 19,
                'tag_id' => 6,
            ),
            31 => 
            array (
                'id' => 32,
                'service_id' => 19,
                'tag_id' => 3,
            ),
            32 => 
            array (
                'id' => 33,
                'service_id' => 20,
                'tag_id' => 3,
            ),
            33 => 
            array (
                'id' => 34,
                'service_id' => 21,
                'tag_id' => 3,
            ),
            34 => 
            array (
                'id' => 35,
                'service_id' => 21,
                'tag_id' => 6,
            ),
            35 => 
            array (
                'id' => 36,
                'service_id' => 22,
                'tag_id' => 1,
            ),
            36 => 
            array (
                'id' => 37,
                'service_id' => 22,
                'tag_id' => 3,
            ),
            37 => 
            array (
                'id' => 38,
                'service_id' => 23,
                'tag_id' => 6,
            ),
            38 => 
            array (
                'id' => 39,
                'service_id' => 24,
                'tag_id' => 1,
            ),
        ));
        
        
    }
}