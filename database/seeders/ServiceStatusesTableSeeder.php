<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceStatusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_statuses')->delete();
        
        \DB::table('service_statuses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'display_name' => 'Pending',
                'description' => 'Pending',
                'status_code' => 1,
                'is_active' => 1,
                'created_at' => '2023-05-29 16:22:47',
                'updated_at' => '2023-05-29 16:22:47',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'display_name' => 'Accepted',
                'description' => 'Accepted',
                'status_code' => 2,
                'is_active' => 1,
                'created_at' => '2023-05-29 16:24:39',
                'updated_at' => '2023-05-29 16:24:39',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'display_name' => 'Rejected',
                'description' => 'Rejected',
                'status_code' => 3,
                'is_active' => 1,
                'created_at' => '2023-05-29 16:24:56',
                'updated_at' => '2023-05-29 16:24:56',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'display_name' => 'Cancelled',
                'description' => 'Cancelled',
                'status_code' => 4,
                'is_active' => 1,
                'created_at' => '2023-05-29 16:25:18',
                'updated_at' => '2023-05-29 16:25:18',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'display_name' => 'Completed',
                'description' => 'Completed',
                'status_code' => 5,
                'is_active' => 1,
                'created_at' => '2023-06-03 13:04:25',
                'updated_at' => '2023-06-03 13:04:25',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}