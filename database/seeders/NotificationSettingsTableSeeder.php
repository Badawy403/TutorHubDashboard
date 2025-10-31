<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NotificationSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notification_settings')->delete();
        
        \DB::table('notification_settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'display_name' => 'New SignUp Student',
                'setting_name' => 'new-signup-student',
                'is_email_send' => 0,
                'is_push_notification_send' => 0,
                'is_in_app_notification_send' => 0,
                'notification_category' => 'Register',
                'is_active' => 1,
                'created_at' => '2024-04-29 09:03:30',
                'updated_at' => '2024-06-27 03:54:46',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'display_name' => 'New SignUp Teacher',
                'setting_name' => 'new-signup-teacher',
                'is_email_send' => 0,
                'is_push_notification_send' => 0,
                'is_in_app_notification_send' => 0,
                'notification_category' => 'Register',
                'is_active' => 1,
                'created_at' => '2024-04-29 09:03:30',
                'updated_at' => '2024-06-27 03:54:46',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'display_name' => 'New SignUp Academy',
                'setting_name' => 'new-signup-academy',
                'is_email_send' => 0,
                'is_push_notification_send' => 0,
                'is_in_app_notification_send' => 0,
                'notification_category' => 'Register',
                'is_active' => 1,
                'created_at' => '2024-04-29 09:03:30',
                'updated_at' => '2024-06-27 03:54:46',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'display_name' => 'Change Password',
                'setting_name' => 'change_password',
                'is_email_send' => 0,
                'is_push_notification_send' => 0,
                'is_in_app_notification_send' => 0,
                'notification_category' => 'Register',
                'is_active' => 1,
                'created_at' => '2024-04-29 09:03:30',
                'updated_at' => '2024-06-27 03:54:46',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'display_name' => 'Reset Password',
                'setting_name' => 'reset_password',
                'is_email_send' => 0,
                'is_push_notification_send' => 0,
                'is_in_app_notification_send' => 0,
                'notification_category' => 'Register',
                'is_active' => 1,
                'created_at' => '2024-04-29 09:03:30',
                'updated_at' => '2024-06-27 03:54:46',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'display_name' => 'Approve/Reject Student',
                'setting_name' => 'approve_or_reject_student',
                'is_email_send' => 1,
                'is_push_notification_send' => 0,
                'is_in_app_notification_send' => 0,
                'notification_category' => 'Register',
                'is_active' => 1,
                'created_at' => '2024-04-29 09:03:30',
                'updated_at' => '2024-06-27 03:54:46',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'display_name' => 'Approve/Reject Academy',
                'setting_name' => 'approve_or_reject_academy',
                'is_email_send' => 0,
                'is_push_notification_send' => 0,
                'is_in_app_notification_send' => 0,
                'notification_category' => 'Register',
                'is_active' => 1,
                'created_at' => '2024-04-29 09:03:30',
                'updated_at' => '2024-06-27 03:54:46',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'display_name' => 'New Appointment Registration',
                'setting_name' => 'new_appointment_registration',
                'is_email_send' => 1,
                'is_push_notification_send' => 0,
                'is_in_app_notification_send' => 1,
                'notification_category' => 'Appointment',
                'is_active' => 1,
                'created_at' => '2024-04-29 09:03:30',
                'updated_at' => '2024-06-27 03:54:46',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'display_name' => 'Change Appointment Status',
                'setting_name' => 'change_appointment_status',
                'is_email_send' => 1,
                'is_push_notification_send' => 0,
                'is_in_app_notification_send' => 1,
                'notification_category' => 'Appointment',
                'is_active' => 1,
                'created_at' => '2024-04-29 09:03:30',
                'updated_at' => '2024-06-27 03:54:46',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'display_name' => 'Before One Hour Appointment Notification',
                'setting_name' => 'before_hour_appointment_notification',
                'is_email_send' => 1,
                'is_push_notification_send' => 0,
                'is_in_app_notification_send' => 0,
                'notification_category' => 'Appointment',
                'is_active' => 1,
                'created_at' => '2024-04-29 09:03:30',
                'updated_at' => '2024-06-27 03:54:46',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'display_name' => 'Quick Service Registered',
                'setting_name' => 'book_quick_service',
                'is_email_send' => 0,
                'is_push_notification_send' => 0,
                'is_in_app_notification_send' => 0,
                'notification_category' => 'Quick Services',
                'is_active' => 1,
                'created_at' => '2024-04-29 14:03:30',
                'updated_at' => '2024-06-27 03:54:46',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'display_name' => 'Approve/Reject Tutor',
                'setting_name' => 'approve_or_reject_tutor',
                'is_email_send' => 1,
                'is_push_notification_send' => 0,
                'is_in_app_notification_send' => 0,
                'notification_category' => 'Register',
                'is_active' => 1,
                'created_at' => '2024-04-29 09:03:30',
                'updated_at' => '2024-06-27 03:54:46',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}