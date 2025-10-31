<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EventTagTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('event_tag')->delete();
        
        \DB::table('event_tag')->insert(array (
            0 => 
            array (
                'id' => 13,
                'event_id' => 19,
                'tag_id' => 1,
            ),
            1 => 
            array (
                'id' => 14,
                'event_id' => 19,
                'tag_id' => 3,
            ),
            2 => 
            array (
                'id' => 15,
                'event_id' => 20,
                'tag_id' => 3,
            ),
            3 => 
            array (
                'id' => 16,
                'event_id' => 21,
                'tag_id' => 3,
            ),
            4 => 
            array (
                'id' => 17,
                'event_id' => 22,
                'tag_id' => 3,
            ),
            5 => 
            array (
                'id' => 38,
                'event_id' => 209,
                'tag_id' => 1,
            ),
            6 => 
            array (
                'id' => 39,
                'event_id' => 209,
                'tag_id' => 3,
            ),
            7 => 
            array (
                'id' => 40,
                'event_id' => 209,
                'tag_id' => 4,
            ),
            8 => 
            array (
                'id' => 41,
                'event_id' => 209,
                'tag_id' => 5,
            ),
            9 => 
            array (
                'id' => 42,
                'event_id' => 209,
                'tag_id' => 6,
            ),
            10 => 
            array (
                'id' => 43,
                'event_id' => 177,
                'tag_id' => 3,
            ),
            11 => 
            array (
                'id' => 44,
                'event_id' => 177,
                'tag_id' => 4,
            ),
            12 => 
            array (
                'id' => 45,
                'event_id' => 177,
                'tag_id' => 1,
            ),
            13 => 
            array (
                'id' => 46,
                'event_id' => 177,
                'tag_id' => 5,
            ),
            14 => 
            array (
                'id' => 47,
                'event_id' => 177,
                'tag_id' => 6,
            ),
            15 => 
            array (
                'id' => 53,
                'event_id' => 167,
                'tag_id' => 3,
            ),
            16 => 
            array (
                'id' => 54,
                'event_id' => 167,
                'tag_id' => 4,
            ),
            17 => 
            array (
                'id' => 55,
                'event_id' => 167,
                'tag_id' => 1,
            ),
            18 => 
            array (
                'id' => 56,
                'event_id' => 167,
                'tag_id' => 6,
            ),
            19 => 
            array (
                'id' => 57,
                'event_id' => 167,
                'tag_id' => 5,
            ),
            20 => 
            array (
                'id' => 86,
                'event_id' => 236,
                'tag_id' => 3,
            ),
            21 => 
            array (
                'id' => 105,
                'event_id' => 256,
                'tag_id' => 1,
            ),
        ));
        
        
    }
}