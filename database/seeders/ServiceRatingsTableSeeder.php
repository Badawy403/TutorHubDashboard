<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceRatingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_ratings')->delete();
        
        \DB::table('service_ratings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'booked_service_id' => 1,
                'fromable_id' => 45,
                'fromable_type' => 'App\\Models\\Student',
                'to_id' => 15,
                'to_type' => 'App\\Models\\Teacher',
                'rating' => 4.0,
                'comment' => 'good',
                'created_at' => '2024-07-04 01:03:17',
                'updated_at' => '2024-07-04 01:03:17',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'booked_service_id' => 1,
                'fromable_id' => 45,
                'fromable_type' => 'App\\Models\\Student',
                'to_id' => 15,
                'to_type' => 'App\\Models\\Teacher',
                'rating' => 3.0,
                'comment' => 'sasa',
                'created_at' => '2024-07-04 01:56:19',
                'updated_at' => '2024-07-04 01:56:19',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'booked_service_id' => 3,
                'fromable_id' => 45,
                'fromable_type' => 'App\\Models\\Student',
                'to_id' => 15,
                'to_type' => 'App\\Models\\Teacher',
                'rating' => 4.0,
                'comment' => 'hhg',
                'created_at' => '2024-07-04 03:20:29',
                'updated_at' => '2024-07-04 03:20:29',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}