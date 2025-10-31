<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BroadcastCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('broadcast_categories')->delete();
        
        \DB::table('broadcast_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '{"en":"asdas","hi":"asd","ar":"sadasd"}',
                'description' => '{"en":"dasd","hi":"asdasd","ar":"asdasd"}',
                'slug' => 'asdas-1',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => NULL,
                'created_at' => '2023-11-01 19:23:02',
                'updated_at' => '2023-11-02 14:47:36',
                'deleted_at' => '2023-11-02 14:47:36',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '{"en":"Advertising Law","hi":"asdasda","ar":"asdasda"}',
                'description' => '{"en":"sadasdasd","hi":"sdasd","ar":"sdasdsad"}',
                'slug' => 'advertising-law-2',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => '/images/broadcast_categories/654371319f4e8.png',
                'created_at' => '2023-11-02 14:51:45',
                'updated_at' => '2023-11-02 14:56:23',
                'deleted_at' => '2023-11-02 14:56:23',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '{"en":"asdasd","hi":"dasdasd","ar":"dasdasd"}',
                'description' => '{"en":"asdasd","hi":"dasdasdasdasd","ar":"asdasd"}',
                'slug' => 'asdasd-3',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => '/images/broadcast_categories/6543a69f3490c.png',
                'created_at' => '2023-11-02 18:39:43',
                'updated_at' => '2023-11-02 18:39:52',
                'deleted_at' => '2023-11-02 18:39:52',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => '{"en":"asdas","hi":"asdasd","ar":"asdasd"}',
                'description' => '{"en":"dasdasd","hi":"asdasd","ar":"asdasdasdasd"}',
                'slug' => 'asdas-4',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => NULL,
                'created_at' => '2023-11-02 18:48:48',
                'updated_at' => '2023-11-02 18:54:16',
                'deleted_at' => '2023-11-02 18:54:16',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => '{"en":"dsfdsdf","hi":"ertret","ar":"ertert"}',
                'description' => '{"en":"fdfdfgd","hi":"retret","ar":"retretrt"}',
                'slug' => 'dsfdsdf-5',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => '/images/broadcast_categories/6543b1196299a.png',
                'created_at' => '2023-11-02 19:24:25',
                'updated_at' => '2023-11-02 19:24:32',
                'deleted_at' => '2023-11-02 19:24:32',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => '{"en":"wewe","hi":"wewe","ar":"wewewe"}',
                'description' => '{"en":"wewe","hi":"wewewe","ar":"wewewe"}',
                'slug' => 'wewe-6',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => '/images/broadcast_categories/6543b5e9596de.png',
                'created_at' => '2023-11-02 19:44:57',
                'updated_at' => '2023-11-02 19:46:11',
                'deleted_at' => '2023-11-02 19:46:11',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => '{"en":"erter","hi":"tt","ar":"ertert"}',
                'description' => '{"en":"ert","hi":"rert","ar":"ertret"}',
                'slug' => 'erter-7',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => '/images/broadcast_categories/6543b601c8ba1.png',
                'created_at' => '2023-11-02 19:45:21',
                'updated_at' => '2023-11-02 19:46:06',
                'deleted_at' => '2023-11-02 19:46:06',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => '{"en":"aa","hi":"aa","ar":"aa"}',
                'description' => '{"en":"aa","hi":"aa","ar":"aaa"}',
                'slug' => 'aa-8',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => '/images/broadcast_categories/6543b694e5b4c.png',
                'created_at' => '2023-11-02 19:47:48',
                'updated_at' => '2023-11-02 19:47:55',
                'deleted_at' => '2023-11-02 19:47:55',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => '{"en":"Religious Freedom and Expression","hi":"\\u0936\\u093f\\u0915\\u094d\\u0937\\u093e \\u0915\\u093e\\u0928\\u0942\\u0928","ar":"\\u0627\\u0644\\u062d\\u0631\\u064a\\u0629 \\u0627\\u0644\\u062f\\u064a\\u0646\\u064a\\u0629 \\u0648\\u0627\\u0644\\u062a\\u0639\\u0628\\u064a\\u0631"}',
                'description' => '{"en":"Upon successfully creating a new student, you gain the additional capability to \'View Student\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each student\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing student data whenever the need arises","hi":"Upon successfully creating a new student, you gain the additional capability to \'View Student\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each student\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing student data whenever the need arises","ar":"Upon successfully creating a new student, you gain the additional capability to \'View Student\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each student\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing student data whenever the need arises"}',
                'slug' => 'religious-freedom-and-expression-9',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => '/images/broadcast_categories/6543b874c326c.png',
                'created_at' => '2023-11-02 19:55:48',
                'updated_at' => '2023-11-02 19:56:33',
                'deleted_at' => '2023-11-02 19:56:33',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => '{"en":"Upon successfully creating a new student, you gain the additional capability to \'View Student\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each student\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing student data whenever the need arises","hi":"Upon successfully creating a new student, you gain the additional capability to \'View Student\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each student\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing student data whenever the need arises","ar":"Upon successfully creating a new student, you gain the additional capability to \'View Student\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each student\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing student data whenever the need arises"}',
                'description' => '{"en":"Upon successfully creating a new student, you gain the additional capability to \'View Student\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each student\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing student data whenever the need arises","hi":"Upon successfully creating a new student, you gain the additional capability to \'View Student\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each student\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing student data whenever the need arises","ar":"Upon successfully creating a new student, you gain the additional capability to \'View Student\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each student\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing student data whenever the need arises"}',
                'slug' => 'upon-successfully-creating-a-new-student-you-gain-the-additional-capability-to-view-student-after-the-profile-has-been-generated-this-function-grants-you-access-to-a-detailed-profile-view-offering-a-comprehensive-overview-of-each-students-information-this-invaluable-feature-streamlines-the-process-of-swiftly-retrieving-and-reviewing-student-data-whenever-the-need-arises-10',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => '/images/broadcast_categories/6543c38e92040.png',
                'created_at' => '2023-11-02 20:43:10',
                'updated_at' => '2023-11-02 20:44:05',
                'deleted_at' => '2023-11-02 20:44:05',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => '{"en":"Upon successfully creating a new student, you gain the additional capability to \'View Student\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each student\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing student data whenever the need arises","hi":"Upon successfully creating a new student, you gain the additional capability to \'View Student\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each student\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing student data whenever the need arises","ar":"Upon successfully creating a new student, you gain the additional capability to \'View Student\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each student\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing student data whenever the need arises"}',
                'description' => '{"en":"Upon successfully creating a new student, you gain the additional capability to \'View Student\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each student\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing student data whenever the need arises","hi":"Upon successfully creating a new student, you gain the additional capability to \'View Student\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each student\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing student data whenever the need arises","ar":"Upon successfully creating a new student, you gain the additional capability to \'View Student\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each student\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing student data whenever the need arises"}',
                'slug' => 'upon-successfully-creating-a-new-student-you-gain-the-additional-capability-to-view-student-after-the-profile-has-been-generated-this-function-grants-you-access-to-a-detailed-profile-view-offering-a-comprehensive-overview-of-each-students-information-this-invaluable-feature-streamlines-the-process-of-swiftly-retrieving-and-reviewing-student-data-whenever-the-need-arises-11',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => '/images/broadcast_categories/6543c3b69abc1.png',
                'created_at' => '2023-11-02 20:43:50',
                'updated_at' => '2023-11-02 20:44:10',
                'deleted_at' => '2023-11-02 20:44:10',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => '{"en":"Religious Freedom and Expression","hi":"\\u0927\\u093e\\u0930\\u094d\\u092e\\u093f\\u0915 \\u0938\\u094d\\u0935\\u0924\\u0902\\u0924\\u094d\\u0930\\u0924\\u093e \\u0914\\u0930 \\u0905\\u092d\\u093f\\u0935\\u094d\\u092f\\u0915\\u094d\\u0924\\u093f","ar":"\\u0627\\u0644\\u062d\\u0631\\u064a\\u0629 \\u0627\\u0644\\u062f\\u064a\\u0646\\u064a\\u0629 \\u0648\\u0627\\u0644\\u062a\\u0639\\u0628\\u064a\\u0631"}',
                'description' => '{"en":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.","hi":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.","ar":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur."}',
                'slug' => 'religious-freedom-and-expression-12',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => '/images/broadcast_categories/6544c53b1476f.png',
                'created_at' => '2023-11-03 15:02:35',
                'updated_at' => '2023-11-03 15:03:07',
                'deleted_at' => '2023-11-03 15:03:07',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => '{"en":"Educational media","hi":"\\u0936\\u0948\\u0915\\u094d\\u0937\\u093f\\u0915 \\u092e\\u0940\\u0921\\u093f\\u092f\\u093e","ar":"\\u0627\\u0644\\u0648\\u0633\\u0627\\u0626\\u0637 \\u0627\\u0644\\u062a\\u0639\\u0644\\u064a\\u0645\\u064a\\u0629"}',
                'description' => '{"en":"Educational media","hi":"\\u0936\\u0948\\u0915\\u094d\\u0937\\u093f\\u0915 \\u092e\\u0940\\u0921\\u093f\\u092f\\u093e","ar":"\\u0627\\u0644\\u0648\\u0633\\u0627\\u0626\\u0637 \\u0627\\u0644\\u062a\\u0639\\u0644\\u064a\\u0645\\u064a\\u0629"}',
                'slug' => 'educational-media-13',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => NULL,
                'created_at' => '2024-03-26 15:43:09',
                'updated_at' => '2024-03-26 15:43:09',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}