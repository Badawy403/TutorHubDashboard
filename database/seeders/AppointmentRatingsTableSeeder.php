<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AppointmentRatingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('appointment_ratings')->delete();
        
        \DB::table('appointment_ratings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'booked_appointment_id' => 5,
                'fromable_id' => 4,
                'fromable_type' => 'App\\Models\\Student',
                'to_id' => 15,
                'to_type' => 'App\\Models\\Teacher',
                'rating' => 3.0,
                'comment' => 'fgg',
                'created_at' => '2023-08-16 16:25:36',
                'updated_at' => '2023-08-16 16:25:36',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'booked_appointment_id' => 8,
                'fromable_id' => 15,
                'fromable_type' => 'App\\Models\\Teacher',
                'to_id' => 4,
                'to_type' => 'App\\Models\\Student',
                'rating' => 5.0,
                'comment' => 'thanks',
                'created_at' => '2023-08-29 15:41:19',
                'updated_at' => '2023-08-29 15:41:19',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'booked_appointment_id' => 8,
                'fromable_id' => 4,
                'fromable_type' => 'App\\Models\\Student',
                'to_id' => 15,
                'to_type' => 'App\\Models\\Teacher',
                'rating' => 5.0,
                'comment' => 'good',
                'created_at' => '2023-08-29 15:41:22',
                'updated_at' => '2023-08-29 15:41:22',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'booked_appointment_id' => 46,
                'fromable_id' => 31,
                'fromable_type' => 'App\\Models\\Teacher',
                'to_id' => 4,
                'to_type' => 'App\\Models\\Student',
                'rating' => 5.0,
                'comment' => 'good communication',
                'created_at' => '2023-10-12 13:44:19',
                'updated_at' => '2023-10-12 13:44:19',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'booked_appointment_id' => 46,
                'fromable_id' => 4,
                'fromable_type' => 'App\\Models\\Student',
                'to_id' => 31,
                'to_type' => 'App\\Models\\Teacher',
                'rating' => 5.0,
                'comment' => 'Helpful',
                'created_at' => '2023-10-12 13:46:52',
                'updated_at' => '2023-10-12 13:46:52',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}