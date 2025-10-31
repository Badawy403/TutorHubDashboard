<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AppointmentTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('appointment_types')->delete();
        
        \DB::table('appointment_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'display_name' => 'Video Call',
                'description' => 'Video Call',
                'type' => 'video',
                'is_schedule_required' => 1,
                'is_paid' => 1,
                'is_active' => 1,
                'created_at' => '2023-05-21 17:21:25',
                'updated_at' => '2023-05-21 17:21:25',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'display_name' => 'Audio Call',
                'description' => 'Audio Call',
                'type' => 'audio',
                'is_schedule_required' => 1,
                'is_paid' => 1,
                'is_active' => 1,
                'created_at' => '2023-05-21 17:21:51',
                'updated_at' => '2023-05-21 17:21:51',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'display_name' => 'Live Chat',
                'description' => 'Live Chat',
                'type' => 'chat',
                'is_schedule_required' => 0,
                'is_paid' => 1,
                'is_active' => 1,
                'created_at' => '2023-05-21 17:22:16',
                'updated_at' => '2023-05-21 17:22:16',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}