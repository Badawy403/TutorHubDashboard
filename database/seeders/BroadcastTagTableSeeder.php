<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BroadcastTagTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('broadcast_tag')->delete();
        
        \DB::table('broadcast_tag')->insert(array (
            0 => 
            array (
                'id' => 1,
                'broadcast_id' => 6,
                'tag_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'broadcast_id' => 7,
                'tag_id' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'broadcast_id' => 8,
                'tag_id' => 3,
            ),
            3 => 
            array (
                'id' => 4,
                'broadcast_id' => 9,
                'tag_id' => 3,
            ),
            4 => 
            array (
                'id' => 5,
                'broadcast_id' => 10,
                'tag_id' => 3,
            ),
            5 => 
            array (
                'id' => 6,
                'broadcast_id' => 11,
                'tag_id' => 3,
            ),
            6 => 
            array (
                'id' => 7,
                'broadcast_id' => 11,
                'tag_id' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'broadcast_id' => 12,
                'tag_id' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'broadcast_id' => 12,
                'tag_id' => 3,
            ),
            9 => 
            array (
                'id' => 10,
                'broadcast_id' => 13,
                'tag_id' => 1,
            ),
            10 => 
            array (
                'id' => 11,
                'broadcast_id' => 13,
                'tag_id' => 3,
            ),
            11 => 
            array (
                'id' => 12,
                'broadcast_id' => 14,
                'tag_id' => 1,
            ),
            12 => 
            array (
                'id' => 16,
                'broadcast_id' => 17,
                'tag_id' => 3,
            ),
            13 => 
            array (
                'id' => 17,
                'broadcast_id' => 17,
                'tag_id' => 4,
            ),
            14 => 
            array (
                'id' => 18,
                'broadcast_id' => 17,
                'tag_id' => 5,
            ),
            15 => 
            array (
                'id' => 19,
                'broadcast_id' => 17,
                'tag_id' => 1,
            ),
            16 => 
            array (
                'id' => 24,
                'broadcast_id' => 19,
                'tag_id' => 4,
            ),
            17 => 
            array (
                'id' => 25,
                'broadcast_id' => 19,
                'tag_id' => 1,
            ),
            18 => 
            array (
                'id' => 26,
                'broadcast_id' => 19,
                'tag_id' => 5,
            ),
            19 => 
            array (
                'id' => 27,
                'broadcast_id' => 19,
                'tag_id' => 3,
            ),
            20 => 
            array (
                'id' => 28,
                'broadcast_id' => 19,
                'tag_id' => 6,
            ),
            21 => 
            array (
                'id' => 29,
                'broadcast_id' => 20,
                'tag_id' => 3,
            ),
            22 => 
            array (
                'id' => 30,
                'broadcast_id' => 20,
                'tag_id' => 1,
            ),
            23 => 
            array (
                'id' => 31,
                'broadcast_id' => 20,
                'tag_id' => 4,
            ),
            24 => 
            array (
                'id' => 32,
                'broadcast_id' => 20,
                'tag_id' => 6,
            ),
            25 => 
            array (
                'id' => 33,
                'broadcast_id' => 20,
                'tag_id' => 5,
            ),
            26 => 
            array (
                'id' => 43,
                'broadcast_id' => 101,
                'tag_id' => 3,
            ),
            27 => 
            array (
                'id' => 44,
                'broadcast_id' => 101,
                'tag_id' => 1,
            ),
            28 => 
            array (
                'id' => 45,
                'broadcast_id' => 101,
                'tag_id' => 5,
            ),
            29 => 
            array (
                'id' => 46,
                'broadcast_id' => 101,
                'tag_id' => 4,
            ),
            30 => 
            array (
                'id' => 103,
                'broadcast_id' => 158,
                'tag_id' => 3,
            ),
            31 => 
            array (
                'id' => 104,
                'broadcast_id' => 158,
                'tag_id' => 4,
            ),
            32 => 
            array (
                'id' => 114,
                'broadcast_id' => 167,
                'tag_id' => 1,
            ),
            33 => 
            array (
                'id' => 118,
                'broadcast_id' => 171,
                'tag_id' => 3,
            ),
        ));
        
        
    }
}