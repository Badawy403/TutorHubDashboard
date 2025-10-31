<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InAppNotificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('in_app_notifications')->delete();
        
        \DB::table('in_app_notifications')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 44,
                'name' => 'approve_or_reject_lawyer',
                'description' => 'approve_or_reject_lawyer',
                'redirect_url' => NULL,
                'is_seen' => 1,
                'created_at' => '2024-05-02 06:33:56',
                'updated_at' => '2024-05-07 06:13:19',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 1,
                'name' => 'Lawyer Approved Successfully',
                'description' => 'You have a new notification',
                'redirect_url' => 'super_admin/lawyers',
                'is_seen' => 0,
                'created_at' => '2024-05-02 07:05:47',
                'updated_at' => '2024-05-02 07:05:47',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 1,
                'name' => 'Lawyer Approved Successfully',
                'description' => 'You have a new notification',
                'redirect_url' => 'super_admin/lawyers',
                'is_seen' => 0,
                'created_at' => '2024-05-02 07:06:03',
                'updated_at' => '2024-05-02 07:06:03',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 47,
                'name' => 'Appointment Booked Successfully',
                'description' => 'You have a new notification',
                'redirect_url' => '/appointment_log/detail/256',
                'is_seen' => 0,
                'created_at' => '2024-05-02 08:00:37',
                'updated_at' => '2024-05-02 08:00:37',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 17,
                'name' => 'Appointment Booked Successfully',
                'description' => 'You have a new notification',
                'redirect_url' => '/appointment_log/detail/256',
                'is_seen' => 0,
                'created_at' => '2024-05-02 08:00:37',
                'updated_at' => '2024-05-02 08:00:37',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 47,
                'name' => 'Lawyer Approved Successfully',
                'description' => 'You have a new notification',
                'redirect_url' => 'super_admin/lawyers',
                'is_seen' => 0,
                'created_at' => '2024-05-06 01:16:06',
                'updated_at' => '2024-05-06 01:16:06',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 17,
                'name' => 'Appointment Booked Successfully',
                'description' => 'You have a new notification',
                'redirect_url' => '/appointment_log/detail/261',
                'is_seen' => 0,
                'created_at' => '2024-05-06 01:21:50',
                'updated_at' => '2024-05-06 01:21:50',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 17,
                'name' => 'Appointment Booked Successfully',
                'description' => 'You have a new notification',
                'redirect_url' => '/appointment_log/detail/261',
                'is_seen' => 0,
                'created_at' => '2024-05-06 01:21:50',
                'updated_at' => '2024-05-06 01:21:50',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'user_id' => 58,
                'name' => 'Lawyer Approved Successfully',
                'description' => 'You have a new notification',
                'redirect_url' => 'super_admin/lawyers',
                'is_seen' => 0,
                'created_at' => '2024-05-06 01:28:15',
                'updated_at' => '2024-05-06 01:28:15',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'user_id' => 48,
                'name' => 'Lawyer Approved Successfully',
                'description' => 'You have a new notification',
                'redirect_url' => 'super_admin/lawyers',
                'is_seen' => 0,
                'created_at' => '2024-05-17 05:33:07',
                'updated_at' => '2024-05-17 05:33:07',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}