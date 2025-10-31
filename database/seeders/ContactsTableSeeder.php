<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contacts')->delete();
        
        \DB::table('contacts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Contact',
                'email' => 'Contact@gg.com',
                'phone' => '31231231',
                'message' => 'ljksdfjksdgdh kjsdfh skjdfhs skjdfh sdkh f',
                'created_at' => '2023-09-19 11:17:43',
                'updated_at' => '2023-09-19 11:17:43',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Name',
                'email' => 'Name@ss.com',
                'phone' => '234234234234',
                'message' => 'sadfsdfsdfdsf',
                'created_at' => '2023-09-19 11:19:29',
                'updated_at' => '2023-09-19 11:19:29',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'In',
                'email' => 'In@gg.com',
                'phone' => '23423423',
                'message' => 'sdnbfsfbgsfsj kdjhjkdfh kdfhg',
                'created_at' => '2023-09-19 11:20:09',
                'updated_at' => '2023-09-19 11:20:09',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Faizan',
                'email' => 'fazfaizan22@gmail.com',
                'phone' => '03143923536',
                'message' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                'created_at' => '2023-11-02 15:06:33',
                'updated_at' => '2023-11-02 15:06:33',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Faizan',
                'email' => 'fazfaizan22@gmail.com',
                'phone' => '232232',
                'message' => 'eQWEQWEQWEQWEQWEQWEQWE',
                'created_at' => '2023-11-02 15:07:38',
                'updated_at' => '2023-11-02 15:07:38',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Faizan',
                'email' => 'fazfaizan22@gmail.com',
                'phone' => '232232',
                'message' => 'eQWEQWEQWEQWEQWEQWEQWE',
                'created_at' => '2023-11-02 15:47:11',
                'updated_at' => '2023-11-02 15:47:11',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'jack deen',
                'email' => 'jack@gmail.com',
                'phone' => '121211 1121',
            'message' => '"The Total Teachers section currently lists 5 active teachers within the system, as indicated by the accompanying dashboard image (dashboard-image-1.png). Moving on to Total Users, there are presently 8 registered users on the platform, as depicted by the associated image (total-users.png). As for Total Subscriptions, there are currently no active subscriptions at this time.

In addition, the system boasts a total of 92 upcoming events, all ready to be showcased on the dashboard for easy access and reference. The Total Appointments stand at 53, showcasing the busy schedule of consultations and meetings. Furthermore, the platform serves a total of 8 students who rely on the services provided."',
                'created_at' => '2023-11-02 17:05:37',
                'updated_at' => '2023-11-02 17:05:37',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'sdas',
                'email' => 'faizan@gmail.com',
                'phone' => '121212',
                'message' => 'asdaddsadsdadad',
                'created_at' => '2023-11-02 18:38:35',
                'updated_at' => '2023-11-02 18:38:35',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'BILAL',
                'email' => 'BILAL@GMAIL.COM',
                'phone' => '231234324342',
                'message' => 'HELLO CHECKING',
                'created_at' => '2024-05-30 12:55:19',
                'updated_at' => '2024-05-30 12:55:19',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'BILAL',
                'email' => 'BILAL@GMAI',
                'phone' => '231234324342',
                'message' => 'HELLO CHECKING',
                'created_at' => '2024-05-30 12:55:35',
                'updated_at' => '2024-05-30 12:55:35',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Bilal',
                'email' => 'bilal@gmail.com',
                'phone' => '08376382(73+4-73',
                    'message' => 'hdghdhdbdbdhhdf',
                    'created_at' => '2024-06-12 13:39:22',
                    'updated_at' => '2024-06-12 13:39:22',
                    'deleted_at' => NULL,
                ),
                11 => 
                array (
                    'id' => 12,
                    'name' => 'Bilal',
                    'email' => 'bilal@gmail.com',
                    'phone' => '08376382(73+4-73',
                        'message' => 'hdghdhdbdbdhhdf',
                        'created_at' => '2024-06-12 13:39:22',
                        'updated_at' => '2024-06-12 13:39:22',
                        'deleted_at' => NULL,
                    ),
                    12 => 
                    array (
                        'id' => 13,
                        'name' => 'Bilal',
                        'email' => 'bilal@gmail.com',
                        'phone' => '08376382(73+4-73',
                            'message' => 'hdghdhdbdbdhhdf',
                            'created_at' => '2024-06-12 13:39:24',
                            'updated_at' => '2024-06-12 13:39:24',
                            'deleted_at' => NULL,
                        ),
                        13 => 
                        array (
                            'id' => 14,
                            'name' => 'Bilal',
                            'email' => 'bilal@gmail.com',
                            'phone' => '08376382(73+4-73',
                                'message' => 'hdghdhdbdbdhhdf',
                                'created_at' => '2024-06-12 13:39:25',
                                'updated_at' => '2024-06-12 13:39:25',
                                'deleted_at' => NULL,
                            ),
                            14 => 
                            array (
                                'id' => 15,
                                'name' => 'Bilal',
                                'email' => 'bilal@gmail.com',
                                'phone' => '08376382(73+4-73',
                                    'message' => 'hdghdhdbdbdhhdf',
                                    'created_at' => '2024-06-12 13:39:25',
                                    'updated_at' => '2024-06-12 13:39:25',
                                    'deleted_at' => NULL,
                                ),
                                15 => 
                                array (
                                    'id' => 16,
                                    'name' => 'Bilal',
                                    'email' => 'bilal@gmail.com',
                                    'phone' => '08376382(73+4-73',
                                        'message' => 'hdghdhdbdbdhhdf',
                                        'created_at' => '2024-06-12 13:39:25',
                                        'updated_at' => '2024-06-12 13:39:25',
                                        'deleted_at' => NULL,
                                    ),
                                    16 => 
                                    array (
                                        'id' => 17,
                                        'name' => 'Bilal',
                                        'email' => 'bilal@gmail.com',
                                        'phone' => '08376382(73+4-73',
                                            'message' => 'hdghdhdbdbdhhdf',
                                            'created_at' => '2024-06-12 13:39:25',
                                            'updated_at' => '2024-06-12 13:39:25',
                                            'deleted_at' => NULL,
                                        ),
                                        17 => 
                                        array (
                                            'id' => 18,
                                            'name' => 'Bilal',
                                            'email' => 'bilal@gmail.com',
                                            'phone' => '08376382(73+4-73',
                                                'message' => 'hdghdhdbdbdhhdf',
                                                'created_at' => '2024-06-12 13:39:26',
                                                'updated_at' => '2024-06-12 13:39:26',
                                                'deleted_at' => NULL,
                                            ),
                                            18 => 
                                            array (
                                                'id' => 19,
                                                'name' => 'Bilal',
                                                'email' => 'bilal@gmail.com',
                                                'phone' => '08376382(73+4-73',
                                                    'message' => 'hdghdhdbdbdhhdf',
                                                    'created_at' => '2024-06-12 13:39:26',
                                                    'updated_at' => '2024-06-12 13:39:26',
                                                    'deleted_at' => NULL,
                                                ),
                                                19 => 
                                                array (
                                                    'id' => 20,
                                                    'name' => 'Bilal',
                                                    'email' => 'bilal@gmail.com',
                                                    'phone' => '08376382(73+4-73',
                                                        'message' => 'hdghdhdbdbdhhdf',
                                                        'created_at' => '2024-06-12 13:39:26',
                                                        'updated_at' => '2024-06-12 13:39:26',
                                                        'deleted_at' => NULL,
                                                    ),
                                                    20 => 
                                                    array (
                                                        'id' => 21,
                                                        'name' => 'Bilal',
                                                        'email' => 'bilal@gmail.com',
                                                        'phone' => '08376382(73+4-73',
                                                            'message' => 'hdghdhdbdbdhhdf',
                                                            'created_at' => '2024-06-12 13:39:26',
                                                            'updated_at' => '2024-06-12 13:39:26',
                                                            'deleted_at' => NULL,
                                                        ),
                                                        21 => 
                                                        array (
                                                            'id' => 22,
                                                            'name' => 'Bilal',
                                                            'email' => 'bilal@gmail.com',
                                                            'phone' => '08376382(73+4-73',
                                                                'message' => 'hdghdhdbdbdhhdf',
                                                                'created_at' => '2024-06-12 13:39:26',
                                                                'updated_at' => '2024-06-12 13:39:26',
                                                                'deleted_at' => NULL,
                                                            ),
                                                            22 => 
                                                            array (
                                                                'id' => 23,
                                                                'name' => 'Bilal',
                                                                'email' => 'bilal@gmail.com',
                                                                'phone' => '08376382(73+4-73',
                                                                    'message' => 'hdghdhdbdbdhhdf',
                                                                    'created_at' => '2024-06-12 13:39:27',
                                                                    'updated_at' => '2024-06-12 13:39:27',
                                                                    'deleted_at' => NULL,
                                                                ),
                                                                23 => 
                                                                array (
                                                                    'id' => 24,
                                                                    'name' => 'Bilal',
                                                                    'email' => 'bilal@gmail.com',
                                                                    'phone' => '08376382(73+4-73',
                                                                        'message' => 'hdghdhdbdbdhhdf',
                                                                        'created_at' => '2024-06-12 13:39:27',
                                                                        'updated_at' => '2024-06-12 13:39:27',
                                                                        'deleted_at' => NULL,
                                                                    ),
                                                                    24 => 
                                                                    array (
                                                                        'id' => 25,
                                                                        'name' => 'Bilal',
                                                                        'email' => 'bilal@gmail.com',
                                                                        'phone' => '08376382(73+4-73',
                                                                            'message' => 'hdghdhdbdbdhhdf',
                                                                            'created_at' => '2024-06-12 13:39:27',
                                                                            'updated_at' => '2024-06-12 13:39:27',
                                                                            'deleted_at' => NULL,
                                                                        ),
                                                                        25 => 
                                                                        array (
                                                                            'id' => 26,
                                                                            'name' => 'Bilal',
                                                                            'email' => 'bilal@gmail.com',
                                                                            'phone' => '08376382(73+4-73',
                                                                                'message' => 'hdghdhdbdbdhhdf',
                                                                                'created_at' => '2024-06-12 13:39:27',
                                                                                'updated_at' => '2024-06-12 13:39:27',
                                                                                'deleted_at' => NULL,
                                                                            ),
                                                                            26 => 
                                                                            array (
                                                                                'id' => 27,
                                                                                'name' => 'Bilal',
                                                                                'email' => 'bilal@gmail.com',
                                                                                'phone' => '08376382(73+4-73',
                                                                                    'message' => 'hdghdhdbdbdhhdf',
                                                                                    'created_at' => '2024-06-12 13:39:27',
                                                                                    'updated_at' => '2024-06-12 13:39:27',
                                                                                    'deleted_at' => NULL,
                                                                                ),
                                                                                27 => 
                                                                                array (
                                                                                    'id' => 28,
                                                                                    'name' => 'Bilal',
                                                                                    'email' => 'bilal@gmail.com',
                                                                                    'phone' => '03434404044',
                                                                                    'message' => 'hdghdhdbdbdhhdf',
                                                                                    'created_at' => '2024-06-12 13:39:36',
                                                                                    'updated_at' => '2024-06-12 13:39:36',
                                                                                    'deleted_at' => NULL,
                                                                                ),
                                                                                28 => 
                                                                                array (
                                                                                    'id' => 29,
                                                                                    'name' => 'Bilal',
                                                                                    'email' => 'bilal@gmail.com',
                                                                                    'phone' => '03434404044',
                                                                                    'message' => 'hdghdhdbdbdhhdf',
                                                                                    'created_at' => '2024-06-12 13:39:37',
                                                                                    'updated_at' => '2024-06-12 13:39:37',
                                                                                    'deleted_at' => NULL,
                                                                                ),
                                                                                29 => 
                                                                                array (
                                                                                    'id' => 30,
                                                                                    'name' => 'Bilal',
                                                                                    'email' => 'bilal@gmail.com',
                                                                                    'phone' => '03434404044',
                                                                                    'message' => 'hdghdhdbdbdhhdf',
                                                                                    'created_at' => '2024-06-12 13:39:38',
                                                                                    'updated_at' => '2024-06-12 13:39:38',
                                                                                    'deleted_at' => NULL,
                                                                                ),
                                                                                30 => 
                                                                                array (
                                                                                    'id' => 31,
                                                                                    'name' => 'Bilal',
                                                                                    'email' => 'bilal@gmail.com',
                                                                                    'phone' => '03434404044',
                                                                                    'message' => 'hdghdhdbdbdhhdf',
                                                                                    'created_at' => '2024-06-12 13:39:38',
                                                                                    'updated_at' => '2024-06-12 13:39:38',
                                                                                    'deleted_at' => NULL,
                                                                                ),
                                                                                31 => 
                                                                                array (
                                                                                    'id' => 32,
                                                                                    'name' => 'Bilal',
                                                                                    'email' => 'bilal@gmail.com',
                                                                                    'phone' => '03434404044',
                                                                                    'message' => 'hdghdhdbdbdhhdf',
                                                                                    'created_at' => '2024-06-12 13:39:39',
                                                                                    'updated_at' => '2024-06-12 13:39:39',
                                                                                    'deleted_at' => NULL,
                                                                                ),
                                                                                32 => 
                                                                                array (
                                                                                    'id' => 33,
                                                                                    'name' => 'Bilal',
                                                                                    'email' => 'bilal@gmail.com',
                                                                                    'phone' => '03434404044',
                                                                                    'message' => 'hdghdhdbdbdhhdf',
                                                                                    'created_at' => '2024-06-12 13:39:39',
                                                                                    'updated_at' => '2024-06-12 13:39:39',
                                                                                    'deleted_at' => NULL,
                                                                                ),
                                                                                33 => 
                                                                                array (
                                                                                    'id' => 34,
                                                                                    'name' => 'Bilal',
                                                                                    'email' => 'bilal@gmail.com',
                                                                                    'phone' => '03434404044',
                                                                                    'message' => 'hdghdhdbdbdhhdf',
                                                                                    'created_at' => '2024-06-12 13:39:40',
                                                                                    'updated_at' => '2024-06-12 13:39:40',
                                                                                    'deleted_at' => NULL,
                                                                                ),
                                                                                34 => 
                                                                                array (
                                                                                    'id' => 35,
                                                                                    'name' => 'Mirza',
                                                                                    'email' => 'ms@gmail.com',
                                                                                    'phone' => '12355213',
                                                                                    'message' => 'Hey 1',
                                                                                    'created_at' => '2024-06-13 17:34:06',
                                                                                    'updated_at' => '2024-06-13 17:34:06',
                                                                                    'deleted_at' => NULL,
                                                                                ),
                                                                                35 => 
                                                                                array (
                                                                                    'id' => 36,
                                                                                    'name' => 'Mirza',
                                                                                    'email' => 'ms@gmail.com',
                                                                                    'phone' => '12355213',
                                                                                    'message' => 'Hey',
                                                                                    'created_at' => '2024-06-13 17:34:32',
                                                                                    'updated_at' => '2024-06-13 17:34:32',
                                                                                    'deleted_at' => NULL,
                                                                                ),
                                                                                36 => 
                                                                                array (
                                                                                    'id' => 37,
                                                                                    'name' => 'Mirza',
                                                                                    'email' => 'ms@gmail.com',
                                                                                    'phone' => '12355213',
                                                                                    'message' => 'Hey',
                                                                                    'created_at' => '2024-06-13 17:34:45',
                                                                                    'updated_at' => '2024-06-13 17:34:45',
                                                                                    'deleted_at' => NULL,
                                                                                ),
                                                                            ));
        
        
    }
}