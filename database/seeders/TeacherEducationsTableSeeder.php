<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TeacherEducationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('teacher_educations')->delete();
        
        \DB::table('teacher_educations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'teacher_id' => 2,
                'institute' => 'trigno updated',
                'degree' => 'bscs updated',
                'description' => '<p>trignotrignotrignotrignotrignotrignotrigno</p>',
                'subject' => 'computer updated',
                'from' => '2017-08-16 00:00:00',
                'to' => '2023-08-05 00:00:00',
            'image' => '/files/teacher_educations/1691225626download (1).jpeg',
                'is_active' => 1,
                'created_at' => '2023-08-05 08:53:46',
                'updated_at' => '2023-08-05 09:00:57',
                'deleted_at' => '2023-08-05 09:00:57',
            ),
            1 => 
            array (
                'id' => 2,
                'teacher_id' => 15,
                'institute' => 'Law university  of london',
                'degree' => 'LLB',
                'description' => '<p>test educations&nbsp;</p>',
                'subject' => 'Education Law',
                'from' => '2008-08-29 08:19:00',
                'to' => '2014-08-15 09:19:00',
                'image' => '/files/teacher_educations/1691572788Isabella Carrington .jpg',
                'is_active' => 1,
                'created_at' => '2023-08-09 12:19:48',
                'updated_at' => '2023-08-09 12:19:48',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'teacher_id' => 14,
                'institute' => 'Law Advisor',
                'degree' => 'FSC',
                'description' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>',
                'subject' => 'Teacher',
                'from' => '2020-09-18 13:29:00',
                'to' => '2023-10-10 13:29:00',
                'image' => '/files/teacher_educations/1697203874law-template-poster-design_23-2149194024.pdf',
                'is_active' => 1,
                'created_at' => '2023-10-13 18:31:14',
                'updated_at' => '2023-10-13 18:31:14',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'teacher_id' => 15,
                'institute' => 'The Company',
                'degree' => 'BS',
                'description' => NULL,
                'subject' => 'CS',
                'from' => '2023-12-08 00:00:00',
                'to' => '2023-12-08 00:00:00',
            'image' => '/files/teacher_educations/1704716826Monosnap 785fdf29a9c17894b66d4f9e1970cf70_jpg_750x750_jpg_1024x1024.webp (750×750) 2023-12-20 17-18-47.png',
                'is_active' => 1,
                'created_at' => '2024-01-08 17:27:06',
                'updated_at' => '2024-01-08 17:27:06',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'teacher_id' => 15,
                'institute' => 'The Company',
                'degree' => 'BS',
                'description' => NULL,
                'subject' => 'CS',
                'from' => '2023-12-08 00:00:00',
                'to' => '2023-12-08 00:00:00',
            'image' => '/files/teacher_educations/1704720470Monosnap 785fdf29a9c17894b66d4f9e1970cf70_jpg_750x750_jpg_1024x1024.webp (750×750) 2023-12-20 17-18-47.png',
                'is_active' => 1,
                'created_at' => '2024-01-08 18:27:50',
                'updated_at' => '2024-01-08 18:27:50',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'teacher_id' => 15,
                'institute' => 'asd',
                'degree' => 'sd',
                'description' => 'asd',
                'subject' => 'asd',
                'from' => '1970-01-01 00:00:12',
                'to' => '1970-01-01 00:00:12',
                'image' => '/files/teacher_educations/1705493053images.jpeg',
                'is_active' => 1,
                'created_at' => '2024-01-17 17:04:13',
                'updated_at' => '2024-01-17 17:04:13',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'teacher_id' => 15,
                'institute' => 'sdf',
                'degree' => 'sdf',
                'description' => 'sdf',
                'subject' => 'sf',
                'from' => '1970-01-01 00:00:12',
                'to' => '1970-01-01 00:00:32',
                'image' => '/files/teacher_educations/1705493107pexels-pixabay-268533.jpg',
                'is_active' => 1,
                'created_at' => '2024-01-17 17:05:07',
                'updated_at' => '2024-01-17 17:05:07',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'teacher_id' => 15,
                'institute' => 'sdf',
                'degree' => 'sdf',
                'description' => 'sdf',
                'subject' => 'sf',
                'from' => '1970-01-01 00:00:12',
                'to' => '1970-01-01 00:00:32',
                'image' => '/files/teacher_educations/1705493140pexels-pixabay-268533.jpg',
                'is_active' => 1,
                'created_at' => '2024-01-17 17:05:40',
                'updated_at' => '2024-01-17 17:05:40',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'teacher_id' => 15,
                'institute' => 'The Company',
                'degree' => 'BS',
                'description' => NULL,
                'subject' => 'CS',
                'from' => '2023-12-08 00:00:00',
                'to' => '2023-12-08 00:00:00',
                'image' => '/files/teacher_educations/1705493199009861_09_Jan_2024.pdf',
                'is_active' => 1,
                'created_at' => '2024-01-17 17:06:39',
                'updated_at' => '2024-01-17 17:06:39',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'teacher_id' => 15,
                'institute' => 'sdf',
                'degree' => 'sdf',
                'description' => 'sdf',
                'subject' => 'sf',
                'from' => '1970-01-01 00:00:12',
                'to' => '1970-01-01 00:00:32',
                'image' => '/files/teacher_educations/1705493474pexels-pixabay-268533.jpg',
                'is_active' => 1,
                'created_at' => '2024-01-17 17:11:14',
                'updated_at' => '2024-01-17 17:56:19',
                'deleted_at' => '2024-01-17 17:56:19',
            ),
            10 => 
            array (
                'id' => 11,
                'teacher_id' => 15,
                'institute' => 'test',
                'degree' => 'gbb',
                'description' => 'ghb',
                'subject' => 'xvb',
                'from' => '1970-01-01 00:10:46',
                'to' => '1970-01-01 00:09:27',
                'image' => '/files/teacher_educations/1705496212Screenshot_2024-01-16-14-57-03-911_com.lawadvisor.teacher.jpg',
                'is_active' => 1,
                'created_at' => '2024-01-17 17:56:52',
                'updated_at' => '2024-01-17 17:56:52',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'teacher_id' => 71,
                'institute' => 'education dgree',
                'degree' => 'BSC',
                'description' => 'sgdhdbhdhdbbd',
                'subject' => 'education added',
                'from' => '2024-12-05 00:00:00',
                'to' => '2027-12-05 00:00:00',
                'image' => '/files/teacher_educations/1718113242IMG-20240103-WA0049.jpg',
                'is_active' => 1,
                'created_at' => '2024-06-11 18:40:42',
                'updated_at' => '2024-06-11 18:42:58',
                'deleted_at' => '2024-06-11 18:42:58',
            ),
            12 => 
            array (
                'id' => 13,
                'teacher_id' => 15,
                'institute' => 'Edu',
                'degree' => 'BS',
                'description' => 'desc',
                'subject' => 'BS',
                'from' => '1970-01-01 00:33:41',
                'to' => '1970-01-01 00:33:46',
                'image' => '/files/teacher_educations/1718292019images.jpeg',
                'is_active' => 1,
                'created_at' => '2024-06-13 20:20:19',
                'updated_at' => '2024-06-13 20:20:19',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}