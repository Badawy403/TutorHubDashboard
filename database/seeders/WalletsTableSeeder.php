<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WalletsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('wallets')->delete();
        
        \DB::table('wallets')->insert(array (
            0 => 
            array (
                'id' => 1,
                'holder_type' => 'App\\Models\\User',
                'holder_id' => 19,
                'name' => 'Default Wallet',
                'slug' => 'default',
                'uuid' => '00d460ab-9313-4e8e-89e7-702bd9705bfe',
                'description' => NULL,
                'meta' => '[]',
                'balance' => '365',
                'decimal_places' => 2,
                'created_at' => '2024-01-12 13:53:03',
                'updated_at' => '2024-01-17 18:18:48',
            ),
            1 => 
            array (
                'id' => 2,
                'holder_type' => 'App\\Models\\User',
                'holder_id' => 17,
                'name' => 'Default Wallet',
                'slug' => 'default',
                'uuid' => '949353f5-ca80-4e18-bdcf-ee21a0354728',
                'description' => NULL,
                'meta' => '[]',
                'balance' => '500',
                'decimal_places' => 2,
                'created_at' => '2024-01-12 13:57:14',
                'updated_at' => '2024-01-15 13:43:03',
            ),
            2 => 
            array (
                'id' => 3,
                'holder_type' => 'App\\Models\\User',
                'holder_id' => 58,
                'name' => 'Default Wallet',
                'slug' => 'default',
                'uuid' => 'bad5ef1d-a0ac-4cd5-a4db-4a63d7c74ede',
                'description' => NULL,
                'meta' => '[]',
                'balance' => '0',
                'decimal_places' => 2,
                'created_at' => '2024-01-14 03:51:07',
                'updated_at' => '2024-01-14 03:51:07',
            ),
            3 => 
            array (
                'id' => 4,
                'holder_type' => 'App\\Models\\User',
                'holder_id' => 57,
                'name' => 'Default Wallet',
                'slug' => 'default',
                'uuid' => '7f15c35b-c469-49c4-b056-88391650f8bc',
                'description' => NULL,
                'meta' => '[]',
                'balance' => '0',
                'decimal_places' => 2,
                'created_at' => '2024-01-14 22:40:42',
                'updated_at' => '2024-01-14 22:40:42',
            ),
            4 => 
            array (
                'id' => 5,
                'holder_type' => 'App\\Models\\User',
                'holder_id' => 4,
                'name' => 'Default Wallet',
                'slug' => 'default',
                'uuid' => '66581c4e-4a7f-4aa5-b104-4957656bc4c5',
                'description' => NULL,
                'meta' => '[]',
                'balance' => '100',
                'decimal_places' => 2,
                'created_at' => '2024-01-15 13:17:10',
                'updated_at' => '2024-01-15 13:18:16',
            ),
            5 => 
            array (
                'id' => 6,
                'holder_type' => 'App\\Models\\User',
                'holder_id' => 36,
                'name' => 'Default Wallet',
                'slug' => 'default',
                'uuid' => '54ce572a-8cdf-4a68-b4ba-1ea95ebc43ee',
                'description' => NULL,
                'meta' => '[]',
                'balance' => '0',
                'decimal_places' => 2,
                'created_at' => '2024-01-15 13:25:40',
                'updated_at' => '2024-01-15 13:25:40',
            ),
            6 => 
            array (
                'id' => 7,
                'holder_type' => 'App\\Models\\User',
                'holder_id' => 96,
                'name' => 'Default Wallet',
                'slug' => 'default',
                'uuid' => '20835f8b-ef35-4d5d-afb3-86e6c126711d',
                'description' => NULL,
                'meta' => '[]',
                'balance' => '0',
                'decimal_places' => 2,
                'created_at' => '2024-01-31 12:53:38',
                'updated_at' => '2024-01-31 12:53:38',
            ),
            7 => 
            array (
                'id' => 8,
                'holder_type' => 'App\\Models\\User',
                'holder_id' => 2,
                'name' => 'Default Wallet',
                'slug' => 'default',
                'uuid' => '32d3a261-17f0-492f-a5ee-f3a821f56f05',
                'description' => NULL,
                'meta' => '[]',
                'balance' => '0',
                'decimal_places' => 2,
                'created_at' => '2024-02-20 12:56:17',
                'updated_at' => '2024-02-20 12:56:17',
            ),
            8 => 
            array (
                'id' => 9,
                'holder_type' => 'App\\Models\\User',
                'holder_id' => 34,
                'name' => 'Default Wallet',
                'slug' => 'default',
                'uuid' => '39765ec3-46b8-45b6-abba-7b2d5b4eee52',
                'description' => NULL,
                'meta' => '[]',
                'balance' => '10',
                'decimal_places' => 2,
                'created_at' => '2024-02-23 10:36:26',
                'updated_at' => '2024-02-23 10:36:27',
            ),
            9 => 
            array (
                'id' => 10,
                'holder_type' => 'App\\Models\\User',
                'holder_id' => 39,
                'name' => 'Default Wallet',
                'slug' => 'default',
                'uuid' => '471ecb09-498b-43b6-af9c-7c0c11f5cb21',
                'description' => NULL,
                'meta' => '[]',
                'balance' => '0',
                'decimal_places' => 2,
                'created_at' => '2024-03-22 23:54:43',
                'updated_at' => '2024-03-22 23:54:43',
            ),
            10 => 
            array (
                'id' => 11,
                'holder_type' => 'App\\Models\\User',
                'holder_id' => 25,
                'name' => 'Default Wallet',
                'slug' => 'default',
                'uuid' => '4ff22321-5e64-4910-ada9-62c5b158f1a5',
                'description' => NULL,
                'meta' => '[]',
                'balance' => '0',
                'decimal_places' => 2,
                'created_at' => '2024-03-24 13:03:03',
                'updated_at' => '2024-03-24 13:03:03',
            ),
            11 => 
            array (
                'id' => 12,
                'holder_type' => 'App\\Models\\User',
                'holder_id' => 3,
                'name' => 'Default Wallet',
                'slug' => 'default',
                'uuid' => '74a60e71-5182-4af2-8a10-ca3978c694f1',
                'description' => NULL,
                'meta' => '[]',
                'balance' => '0',
                'decimal_places' => 2,
                'created_at' => '2024-05-11 16:59:44',
                'updated_at' => '2024-05-11 16:59:44',
            ),
            12 => 
            array (
                'id' => 13,
                'holder_type' => 'App\\Models\\User',
                'holder_id' => 99,
                'name' => 'Default Wallet',
                'slug' => 'default',
                'uuid' => '2184639a-fd2e-46f3-9ad7-9c15b82a0062',
                'description' => NULL,
                'meta' => '[]',
                'balance' => '0',
                'decimal_places' => 2,
                'created_at' => '2024-05-24 16:30:23',
                'updated_at' => '2024-05-24 16:30:23',
            ),
            13 => 
            array (
                'id' => 14,
                'holder_type' => 'App\\Models\\User',
                'holder_id' => 101,
                'name' => 'Default Wallet',
                'slug' => 'default',
                'uuid' => 'd967bef5-a384-4cac-8637-fc56463f1776',
                'description' => NULL,
                'meta' => '[]',
                'balance' => '0',
                'decimal_places' => 2,
                'created_at' => '2024-05-25 11:40:30',
                'updated_at' => '2024-05-25 11:40:30',
            ),
            14 => 
            array (
                'id' => 15,
                'holder_type' => 'App\\Models\\User',
                'holder_id' => 102,
                'name' => 'Default Wallet',
                'slug' => 'default',
                'uuid' => 'a8463be1-06fe-47bc-b4c3-6a15eb7927fd',
                'description' => NULL,
                'meta' => '[]',
                'balance' => '0',
                'decimal_places' => 2,
                'created_at' => '2024-05-30 13:43:00',
                'updated_at' => '2024-05-30 13:43:00',
            ),
            15 => 
            array (
                'id' => 16,
                'holder_type' => 'App\\Models\\User',
                'holder_id' => 109,
                'name' => 'Default Wallet',
                'slug' => 'default',
                'uuid' => '8b6cc76d-62b2-4bc7-b1fd-e541c3a5b734',
                'description' => NULL,
                'meta' => '[]',
                'balance' => '0',
                'decimal_places' => 2,
                'created_at' => '2024-06-07 18:16:04',
                'updated_at' => '2024-06-07 18:16:04',
            ),
            16 => 
            array (
                'id' => 17,
                'holder_type' => 'App\\Models\\User',
                'holder_id' => 63,
                'name' => 'Default Wallet',
                'slug' => 'default',
                'uuid' => '9e92ce18-c1fb-4bad-a2a1-49a10b734f4b',
                'description' => NULL,
                'meta' => '[]',
                'balance' => '0',
                'decimal_places' => 2,
                'created_at' => '2024-06-11 16:12:12',
                'updated_at' => '2024-06-11 16:12:12',
            ),
            17 => 
            array (
                'id' => 18,
                'holder_type' => 'App\\Models\\User',
                'holder_id' => 110,
                'name' => 'Default Wallet',
                'slug' => 'default',
                'uuid' => '339932dd-bdd9-417b-b3c5-c7fc0686855e',
                'description' => NULL,
                'meta' => '[]',
                'balance' => '0',
                'decimal_places' => 2,
                'created_at' => '2024-06-11 18:56:17',
                'updated_at' => '2024-06-11 18:56:17',
            ),
            18 => 
            array (
                'id' => 19,
                'holder_type' => 'App\\Models\\User',
                'holder_id' => 10,
                'name' => 'Default Wallet',
                'slug' => 'default',
                'uuid' => '04dfb33a-4eee-4be4-8667-a72a94ab2f32',
                'description' => NULL,
                'meta' => '[]',
                'balance' => '0',
                'decimal_places' => 2,
                'created_at' => '2024-06-13 14:12:57',
                'updated_at' => '2024-06-13 14:12:57',
            ),
            19 => 
            array (
                'id' => 20,
                'holder_type' => 'App\\Models\\User',
                'holder_id' => 103,
                'name' => 'Default Wallet',
                'slug' => 'default',
                'uuid' => '2d2d6fc3-253e-4d8b-8ab4-159f03f8037e',
                'description' => NULL,
                'meta' => '[]',
                'balance' => '6486',
                'decimal_places' => 2,
                'created_at' => '2024-06-13 14:25:27',
                'updated_at' => '2024-06-13 14:28:41',
            ),
        ));
        
        
    }
}