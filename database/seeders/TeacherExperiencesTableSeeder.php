<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TeacherExperiencesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('teacher_experiences')->delete();
        
        \DB::table('teacher_experiences')->insert(array (
            0 => 
            array (
                'id' => 1,
                'teacher_id' => 2,
                'company' => 'gjkgjkg',
                'description' => NULL,
                'from' => NULL,
                'to' => NULL,
                'image' => NULL,
                'is_active' => 0,
                'created_at' => '2023-08-04 16:41:20',
                'updated_at' => '2023-08-04 17:03:41',
                'deleted_at' => '2023-08-04 17:03:41',
            ),
            1 => 
            array (
                'id' => 2,
                'teacher_id' => 2,
                'company' => 'Updated',
                'description' => '<p>updatewd</p><p>&nbsp;</p>',
                'from' => '2023-08-02 00:00:00',
                'to' => '2023-08-16 00:00:00',
            'image' => '/files/teacher_experiences/1691167378download (2).jpeg',
                'is_active' => 1,
                'created_at' => '2023-08-04 16:42:58',
                'updated_at' => '2023-08-04 16:59:18',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'teacher_id' => 2,
                'company' => 'Trigno',
                'description' => '<p>experiences</p>',
                'from' => '2020-08-29 16:50:00',
                'to' => '2023-08-26 16:50:00',
            'image' => '/files/teacher_experiences/1691167844download (1).jpeg',
                'is_active' => 1,
                'created_at' => '2023-08-04 16:50:44',
                'updated_at' => '2023-08-04 16:50:44',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'teacher_id' => 15,
                'company' => 'Isabella Law',
                'description' => '<p>test experience&nbsp;</p>',
                'from' => '2008-08-16 12:17:00',
                'to' => '2023-08-16 12:17:00',
                'image' => '/files/teacher_experiences/1691572697Isabella Carrington .jpg',
                'is_active' => 1,
                'created_at' => '2023-08-09 12:18:17',
                'updated_at' => '2023-08-09 12:18:17',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'teacher_id' => 14,
                'company' => 'Law Advisor',
                'description' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>',
                'from' => '2014-10-18 18:10:00',
                'to' => '2023-10-06 18:10:00',
                'image' => '/files/teacher_experiences/1697203435law-template-poster-design_23-2149194024.pdf',
                'is_active' => 1,
                'created_at' => '2023-10-13 18:23:55',
                'updated_at' => '2023-10-13 18:23:55',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'teacher_id' => 15,
                'company' => 'ok',
                'description' => 'as',
                'from' => '1970-01-01 05:00:12',
                'to' => '1970-01-01 05:00:23',
                'image' => '/files/teacher_experiences/1705494882images.jpeg',
                'is_active' => 1,
                'created_at' => '2024-01-17 17:34:42',
                'updated_at' => '2024-01-17 17:34:42',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'teacher_id' => 15,
                'company' => 'Khan exp',
                'description' => 'desc',
                'from' => '1970-01-01 05:33:41',
                'to' => '1970-01-01 05:33:42',
                'image' => '/files/teacher_experiences/1718292093images.jpeg',
                'is_active' => 1,
                'created_at' => '2024-06-13 20:21:33',
                'updated_at' => '2024-06-13 20:21:33',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}