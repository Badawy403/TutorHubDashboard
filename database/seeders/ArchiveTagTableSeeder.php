<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ArchiveTagTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('archive_tag')->delete();
        
        \DB::table('archive_tag')->insert(array (
            0 => 
            array (
                'id' => 6,
                'archive_id' => 8,
                'tag_id' => 3,
            ),
            1 => 
            array (
                'id' => 7,
                'archive_id' => 8,
                'tag_id' => 6,
            ),
            2 => 
            array (
                'id' => 8,
                'archive_id' => 8,
                'tag_id' => 1,
            ),
            3 => 
            array (
                'id' => 9,
                'archive_id' => 8,
                'tag_id' => 4,
            ),
            4 => 
            array (
                'id' => 10,
                'archive_id' => 9,
                'tag_id' => 3,
            ),
            5 => 
            array (
                'id' => 11,
                'archive_id' => 10,
                'tag_id' => 3,
            ),
            6 => 
            array (
                'id' => 12,
                'archive_id' => 10,
                'tag_id' => 1,
            ),
            7 => 
            array (
                'id' => 13,
                'archive_id' => 10,
                'tag_id' => 5,
            ),
            8 => 
            array (
                'id' => 14,
                'archive_id' => 10,
                'tag_id' => 4,
            ),
            9 => 
            array (
                'id' => 15,
                'archive_id' => 11,
                'tag_id' => 3,
            ),
            10 => 
            array (
                'id' => 16,
                'archive_id' => 11,
                'tag_id' => 1,
            ),
            11 => 
            array (
                'id' => 17,
                'archive_id' => 11,
                'tag_id' => 5,
            ),
            12 => 
            array (
                'id' => 18,
                'archive_id' => 11,
                'tag_id' => 6,
            ),
            13 => 
            array (
                'id' => 19,
                'archive_id' => 225,
                'tag_id' => 3,
            ),
            14 => 
            array (
                'id' => 20,
                'archive_id' => 225,
                'tag_id' => 4,
            ),
            15 => 
            array (
                'id' => 21,
                'archive_id' => 225,
                'tag_id' => 1,
            ),
            16 => 
            array (
                'id' => 22,
                'archive_id' => 225,
                'tag_id' => 5,
            ),
            17 => 
            array (
                'id' => 23,
                'archive_id' => 226,
                'tag_id' => 3,
            ),
            18 => 
            array (
                'id' => 24,
                'archive_id' => 226,
                'tag_id' => 4,
            ),
            19 => 
            array (
                'id' => 25,
                'archive_id' => 226,
                'tag_id' => 1,
            ),
            20 => 
            array (
                'id' => 26,
                'archive_id' => 226,
                'tag_id' => 5,
            ),
            21 => 
            array (
                'id' => 27,
                'archive_id' => 226,
                'tag_id' => 6,
            ),
            22 => 
            array (
                'id' => 28,
                'archive_id' => 227,
                'tag_id' => 3,
            ),
            23 => 
            array (
                'id' => 29,
                'archive_id' => 227,
                'tag_id' => 1,
            ),
            24 => 
            array (
                'id' => 30,
                'archive_id' => 227,
                'tag_id' => 4,
            ),
            25 => 
            array (
                'id' => 31,
                'archive_id' => 227,
                'tag_id' => 5,
            ),
            26 => 
            array (
                'id' => 32,
                'archive_id' => 227,
                'tag_id' => 6,
            ),
        ));
        
        
    }
}