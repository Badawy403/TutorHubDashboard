<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('post_tag')->delete();
        
        \DB::table('post_tag')->insert(array (
            0 => 
            array (
                'id' => 17,
                'post_id' => 20,
                'tag_id' => 3,
            ),
            1 => 
            array (
                'id' => 18,
                'post_id' => 20,
                'tag_id' => 4,
            ),
            2 => 
            array (
                'id' => 19,
                'post_id' => 20,
                'tag_id' => 6,
            ),
            3 => 
            array (
                'id' => 20,
                'post_id' => 20,
                'tag_id' => 1,
            ),
            4 => 
            array (
                'id' => 25,
                'post_id' => 131,
                'tag_id' => 1,
            ),
            5 => 
            array (
                'id' => 26,
                'post_id' => 131,
                'tag_id' => 3,
            ),
            6 => 
            array (
                'id' => 27,
                'post_id' => 131,
                'tag_id' => 4,
            ),
            7 => 
            array (
                'id' => 28,
                'post_id' => 131,
                'tag_id' => 5,
            ),
            8 => 
            array (
                'id' => 29,
                'post_id' => 131,
                'tag_id' => 6,
            ),
            9 => 
            array (
                'id' => 30,
                'post_id' => 132,
                'tag_id' => 3,
            ),
            10 => 
            array (
                'id' => 31,
                'post_id' => 132,
                'tag_id' => 1,
            ),
            11 => 
            array (
                'id' => 32,
                'post_id' => 132,
                'tag_id' => 4,
            ),
            12 => 
            array (
                'id' => 33,
                'post_id' => 132,
                'tag_id' => 5,
            ),
            13 => 
            array (
                'id' => 34,
                'post_id' => 132,
                'tag_id' => 6,
            ),
            14 => 
            array (
                'id' => 37,
                'post_id' => 226,
                'tag_id' => 3,
            ),
            15 => 
            array (
                'id' => 38,
                'post_id' => 226,
                'tag_id' => 4,
            ),
        ));
        
        
    }
}