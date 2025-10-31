<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TeacherTagTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('teacher_tag')->delete();
        
        \DB::table('teacher_tag')->insert(array (
            0 => 
            array (
                'id' => 2,
                'teacher_id' => 21,
                'tag_id' => 1,
            ),
            1 => 
            array (
                'id' => 3,
                'teacher_id' => 23,
                'tag_id' => 1,
            ),
            2 => 
            array (
                'id' => 4,
                'teacher_id' => 23,
                'tag_id' => 3,
            ),
            3 => 
            array (
                'id' => 5,
                'teacher_id' => 22,
                'tag_id' => 3,
            ),
            4 => 
            array (
                'id' => 6,
                'teacher_id' => 28,
                'tag_id' => 3,
            ),
            5 => 
            array (
                'id' => 7,
                'teacher_id' => 28,
                'tag_id' => 1,
            ),
            6 => 
            array (
                'id' => 8,
                'teacher_id' => 27,
                'tag_id' => 1,
            ),
            7 => 
            array (
                'id' => 10,
                'teacher_id' => 25,
                'tag_id' => 3,
            ),
            8 => 
            array (
                'id' => 11,
                'teacher_id' => 26,
                'tag_id' => 3,
            ),
            9 => 
            array (
                'id' => 12,
                'teacher_id' => 26,
                'tag_id' => 1,
            ),
            10 => 
            array (
                'id' => 13,
                'teacher_id' => 2,
                'tag_id' => 1,
            ),
            11 => 
            array (
                'id' => 14,
                'teacher_id' => 2,
                'tag_id' => 3,
            ),
            12 => 
            array (
                'id' => 15,
                'teacher_id' => 8,
                'tag_id' => 1,
            ),
            13 => 
            array (
                'id' => 16,
                'teacher_id' => 8,
                'tag_id' => 3,
            ),
            14 => 
            array (
                'id' => 17,
                'teacher_id' => 13,
                'tag_id' => 1,
            ),
            15 => 
            array (
                'id' => 18,
                'teacher_id' => 13,
                'tag_id' => 3,
            ),
            16 => 
            array (
                'id' => 19,
                'teacher_id' => 14,
                'tag_id' => 1,
            ),
            17 => 
            array (
                'id' => 20,
                'teacher_id' => 14,
                'tag_id' => 4,
            ),
            18 => 
            array (
                'id' => 22,
                'teacher_id' => 14,
                'tag_id' => 3,
            ),
            19 => 
            array (
                'id' => 23,
                'teacher_id' => 14,
                'tag_id' => 6,
            ),
            20 => 
            array (
                'id' => 24,
                'teacher_id' => 11,
                'tag_id' => 1,
            ),
            21 => 
            array (
                'id' => 25,
                'teacher_id' => 11,
                'tag_id' => 3,
            ),
            22 => 
            array (
                'id' => 27,
                'teacher_id' => 11,
                'tag_id' => 6,
            ),
            23 => 
            array (
                'id' => 28,
                'teacher_id' => 11,
                'tag_id' => 4,
            ),
            24 => 
            array (
                'id' => 29,
                'teacher_id' => 30,
                'tag_id' => 1,
            ),
            25 => 
            array (
                'id' => 32,
                'teacher_id' => 29,
                'tag_id' => 3,
            ),
            26 => 
            array (
                'id' => 33,
                'teacher_id' => 29,
                'tag_id' => 5,
            ),
            27 => 
            array (
                'id' => 34,
                'teacher_id' => 29,
                'tag_id' => 1,
            ),
            28 => 
            array (
                'id' => 38,
                'teacher_id' => 9,
                'tag_id' => 3,
            ),
            29 => 
            array (
                'id' => 39,
                'teacher_id' => 9,
                'tag_id' => 1,
            ),
            30 => 
            array (
                'id' => 40,
                'teacher_id' => 9,
                'tag_id' => 4,
            ),
            31 => 
            array (
                'id' => 42,
                'teacher_id' => 9,
                'tag_id' => 6,
            ),
            32 => 
            array (
                'id' => 43,
                'teacher_id' => 33,
                'tag_id' => 1,
            ),
            33 => 
            array (
                'id' => 44,
                'teacher_id' => 15,
                'tag_id' => 1,
            ),
            34 => 
            array (
                'id' => 45,
                'teacher_id' => 69,
                'tag_id' => 3,
            ),
            35 => 
            array (
                'id' => 46,
                'teacher_id' => 69,
                'tag_id' => 4,
            ),
        ));
        
        
    }
}