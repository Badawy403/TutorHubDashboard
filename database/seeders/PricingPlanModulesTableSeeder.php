<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PricingPlanModulesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pricing_plan_modules')->delete();
        
        \DB::table('pricing_plan_modules')->insert(array (
            0 => 
            array (
                'id' => 1,
                'display_name' => 'Lists their services & Location.',
                'module_code' => 'teacher-list-services',
                'type' => 'teacher',
                'sort_order' => 2,
                'created_at' => '2023-02-18 21:31:24',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            1 => 
            array (
                'id' => 2,
                'display_name' => 'Basic Profile',
                'module_code' => 'teacher-basic-profile',
                'type' => 'teacher',
                'sort_order' => 1,
                'created_at' => '2023-03-15 22:22:13',
                'updated_at' => '2023-02-13 20:12:11',
            ),
            2 => 
            array (
                'id' => 4,
                'display_name' => 'Add Social Media contact information
',
                'module_code' => 'teacher-social-info',
                'type' => 'teacher',
                'sort_order' => 4,
                'created_at' => '2023-02-18 21:32:05',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            3 => 
            array (
                'id' => 5,
                'display_name' => 'Profile displays',
                'module_code' => 'teacher-profile-display',
                'type' => 'teacher',
                'sort_order' => 5,
                'created_at' => '2023-02-18 21:32:07',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            4 => 
            array (
                'id' => 6,
                'display_name' => 'Calendly Integration',
                'module_code' => 'teacher-calendly',
                'type' => 'teacher',
                'sort_order' => 6,
                'created_at' => '2023-09-13 15:25:27',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            5 => 
            array (
                'id' => 7,
                'display_name' => 'List Events',
                'module_code' => 'teacher-events',
                'type' => 'teacher',
                'sort_order' => 7,
                'created_at' => '2023-03-14 23:52:59',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            6 => 
            array (
                'id' => 8,
                'display_name' => 'List Media',
                'module_code' => 'teacher-broadcasts',
                'type' => 'teacher',
                'sort_order' => 8,
                'created_at' => '2023-10-05 14:50:50',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            7 => 
            array (
                'id' => 9,
                'display_name' => 'Blogs',
                'module_code' => 'teacher-blogs',
                'type' => 'teacher',
                'sort_order' => 9,
                'created_at' => '2023-02-18 21:32:21',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            8 => 
            array (
                'id' => 10,
                'display_name' => 'List Courses',
                'module_code' => 'teacher-archives',
                'type' => 'teacher',
                'sort_order' => 9,
                'created_at' => '2023-02-18 21:32:21',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            9 => 
            array (
                'id' => 11,
                'display_name' => 'list podcasts',
                'module_code' => 'teacher-podcasts',
                'type' => 'teacher',
                'sort_order' => 9,
                'created_at' => '2023-02-18 21:32:21',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            10 => 
            array (
                'id' => 12,
                'display_name' => 'Lists their services & Location.',
                'module_code' => 'academy-list-services',
                'type' => 'academy',
                'sort_order' => 2,
                'created_at' => '2023-02-18 21:31:24',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            11 => 
            array (
                'id' => 13,
                'display_name' => 'Basic Profile',
                'module_code' => 'academy-basic-profile',
                'type' => 'academy',
                'sort_order' => 3,
                'created_at' => '2023-02-18 21:32:02',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            12 => 
            array (
                'id' => 14,
                'display_name' => 'Add Social Media contact information
',
                'module_code' => 'academy-social-info',
                'type' => 'academy',
                'sort_order' => 4,
                'created_at' => '2023-02-18 21:32:05',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            13 => 
            array (
                'id' => 15,
                'display_name' => 'Profile displays',
                'module_code' => 'academy-profile-display',
                'type' => 'academy',
                'sort_order' => 5,
                'created_at' => '2023-02-18 21:32:07',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            14 => 
            array (
                'id' => 16,
                'display_name' => 'Calendly Integration',
                'module_code' => 'academy-calendly-integration',
                'type' => 'academy',
                'sort_order' => 6,
                'created_at' => '2023-02-18 21:32:11',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            15 => 
            array (
                'id' => 17,
                'display_name' => 'List Events',
                'module_code' => 'academy-events',
                'type' => 'academy',
                'sort_order' => 7,
                'created_at' => '2023-03-14 23:52:59',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            16 => 
            array (
                'id' => 18,
                'display_name' => 'List Media',
                'module_code' => 'academy-broadcasts',
                'type' => 'academy',
                'sort_order' => 8,
                'created_at' => '2023-10-05 14:51:04',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            17 => 
            array (
                'id' => 19,
                'display_name' => 'Blogs',
                'module_code' => 'academy-blogs',
                'type' => 'academy',
                'sort_order' => 9,
                'created_at' => '2023-02-18 21:32:21',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            18 => 
            array (
                'id' => 20,
                'display_name' => 'List Courses',
                'module_code' => 'academy-archives',
                'type' => 'academy',
                'sort_order' => 9,
                'created_at' => '2023-02-18 21:32:21',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            19 => 
            array (
                'id' => 21,
                'display_name' => 'list podcasts',
                'module_code' => 'academy-podcasts',
                'type' => 'academy',
                'sort_order' => 9,
                'created_at' => '2023-02-18 21:32:21',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            20 => 
            array (
                'id' => 22,
                'display_name' => 'Teacher Certifications',
                'module_code' => 'teacher-certifications',
                'type' => 'teacher',
                'sort_order' => 9,
                'created_at' => '2023-02-18 21:32:21',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            21 => 
            array (
                'id' => 23,
                'display_name' => 'Teacher Appointments',
                'module_code' => 'teacher-appointment',
                'type' => 'teacher',
                'sort_order' => 9,
                'created_at' => '2023-02-18 21:32:21',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            22 => 
            array (
                'id' => 24,
                'display_name' => 'Teacher Certifications',
                'module_code' => 'academy-certifications',
                'type' => 'academy',
                'sort_order' => 9,
                'created_at' => '2023-09-13 15:36:38',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            23 => 
            array (
                'id' => 25,
                'display_name' => 'Teacher Appointments',
                'module_code' => 'academy-appointment',
                'type' => 'academy',
                'sort_order' => 9,
                'created_at' => '2023-09-13 15:36:44',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            24 => 
            array (
                'id' => 26,
                'display_name' => 'Certifications',
                'module_code' => 'academy-certifications',
                'type' => 'academy',
                'sort_order' => 9,
                'created_at' => '2023-02-19 02:32:21',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            25 => 
            array (
                'id' => 27,
                'display_name' => 'Broadcasts',
                'module_code' => 'academy-broadcasts',
                'type' => 'academy',
                'sort_order' => 9,
                'created_at' => '2023-02-19 02:32:21',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            26 => 
            array (
                'id' => 28,
                'display_name' => 'Certifications',
                'module_code' => 'academy-certifications',
                'type' => 'academy',
                'sort_order' => 9,
                'created_at' => '2023-02-19 02:32:21',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            27 => 
            array (
                'id' => 29,
                'display_name' => 'Broadcasts',
                'module_code' => 'academy-broadcasts',
                'type' => 'academy',
                'sort_order' => 9,
                'created_at' => '2023-02-19 02:32:21',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            28 => 
            array (
                'id' => 30,
                'display_name' => 'List Products',
                'module_code' => 'healer-products',
                'type' => 'healer',
                'sort_order' => 8,
                'created_at' => '2023-03-15 04:52:25',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            29 => 
            array (
                'id' => 31,
                'display_name' => 'List Products',
                'module_code' => 'business-products',
                'type' => 'business',
                'sort_order' => 8,
                'created_at' => '2023-03-15 04:52:25',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            30 => 
            array (
                'id' => 32,
                'display_name' => 'Academy Services',
                'module_code' => 'academy-services',
                'type' => 'academy',
                'sort_order' => 9,
                'created_at' => '2023-02-19 02:32:21',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            31 => 
            array (
                'id' => 33,
                'display_name' => 'Teacher Services',
                'module_code' => 'teacher-services',
                'type' => 'teacher',
                'sort_order' => 9,
                'created_at' => '2023-02-19 02:32:21',
                'updated_at' => '2023-02-13 20:11:58',
            ),
        ));
        
        
    }
}