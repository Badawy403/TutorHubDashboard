<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceReviewsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_reviews')->delete();
        
        \DB::table('service_reviews')->insert(array (
            0 => 
            array (
                'id' => 1,
                'booked_service_id' => 2,
                'service_id' => NULL,
                'student_id' => NULL,
                'teacher_id' => NULL,
                'academy_id' => NULL,
                'rating' => 3.0,
                'experience' => 0.0,
                'communication' => 0.0,
                'service' => 0.0,
                'comment' => 'Service Reviews',
                'is_active' => 1,
                'is_approved' => 0,
                'is_featured' => 0,
                'created_at' => '2024-07-04 01:12:44',
                'updated_at' => '2024-07-04 01:12:44',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'booked_service_id' => 2,
                'service_id' => NULL,
                'student_id' => NULL,
                'teacher_id' => NULL,
                'academy_id' => NULL,
                'rating' => 3.0,
                'experience' => 0.0,
                'communication' => 0.0,
                'service' => 0.0,
                'comment' => 'Service Reviews',
                'is_active' => 1,
                'is_approved' => 0,
                'is_featured' => 0,
                'created_at' => '2024-07-04 01:13:21',
                'updated_at' => '2024-07-04 01:13:21',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'booked_service_id' => 2,
                'service_id' => NULL,
                'student_id' => 1,
                'teacher_id' => NULL,
                'academy_id' => NULL,
                'rating' => 3.0,
                'experience' => 0.0,
                'communication' => 0.0,
                'service' => 0.0,
                'comment' => 'Service Reviews',
                'is_active' => 1,
                'is_approved' => 0,
                'is_featured' => 0,
                'created_at' => '2024-07-04 01:16:41',
                'updated_at' => '2024-07-04 01:16:41',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'booked_service_id' => 2,
                'service_id' => NULL,
                'student_id' => 45,
                'teacher_id' => 1,
                'academy_id' => NULL,
                'rating' => 3.0,
                'experience' => 0.0,
                'communication' => 0.0,
                'service' => 0.0,
                'comment' => 'Excellent',
                'is_active' => 1,
                'is_approved' => 0,
                'is_featured' => 0,
                'created_at' => '2024-07-04 01:50:17',
                'updated_at' => '2024-07-04 01:50:17',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'booked_service_id' => 1,
                'service_id' => NULL,
                'student_id' => 45,
                'teacher_id' => 15,
                'academy_id' => NULL,
                'rating' => 3.0,
                'experience' => 0.0,
                'communication' => 0.0,
                'service' => 0.0,
                'comment' => 'dsasas',
                'is_active' => 1,
                'is_approved' => 0,
                'is_featured' => 0,
                'created_at' => '2024-07-04 01:52:06',
                'updated_at' => '2024-07-04 01:52:06',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'booked_service_id' => 2,
                'service_id' => 18,
                'student_id' => 45,
                'teacher_id' => NULL,
                'academy_id' => 1,
                'rating' => 4.0,
                'experience' => 0.0,
                'communication' => 0.0,
                'service' => 0.0,
                'comment' => 'GGGGGGGGGGOOOOOOOODDDD',
                'is_active' => 1,
                'is_approved' => 0,
                'is_featured' => 0,
                'created_at' => '2024-07-04 03:35:30',
                'updated_at' => '2024-07-04 03:35:30',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'booked_service_id' => 3,
                'service_id' => 21,
                'student_id' => 45,
                'teacher_id' => 15,
                'academy_id' => NULL,
                'rating' => 1.0,
                'experience' => 0.0,
                'communication' => 0.0,
                'service' => 0.0,
                'comment' => 'Bad Behavi',
                'is_active' => 1,
                'is_approved' => 0,
                'is_featured' => 0,
                'created_at' => '2024-07-04 03:46:42',
                'updated_at' => '2024-07-04 03:46:42',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}