<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TransactionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('transactions')->delete();
        
        \DB::table('transactions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'payable_type' => 'App\\Models\\User',
                'payable_id' => 19,
                'wallet_id' => 1,
                'type' => 'deposit',
                'amount' => '5',
                'confirmed' => 1,
                'details' => NULL,
                'meta' => '{"details": "Top Up on Wallet"}',
                'uuid' => 'dba5a031-10ee-4121-b822-71da29e315e6',
                'created_at' => '2024-01-12 13:55:56',
                'updated_at' => '2024-01-12 13:55:56',
            ),
            1 => 
            array (
                'id' => 2,
                'payable_type' => 'App\\Models\\User',
                'payable_id' => 4,
                'wallet_id' => 5,
                'type' => 'deposit',
                'amount' => '100',
                'confirmed' => 1,
                'details' => NULL,
                'meta' => '{"details":"Top Up on Wallet"}',
                'uuid' => 'cbd37bf1-8d27-4d25-972b-45e48d922f0c',
                'created_at' => '2024-01-15 13:18:16',
                'updated_at' => '2024-01-15 13:18:16',
            ),
            2 => 
            array (
                'id' => 3,
                'payable_type' => 'App\\Models\\User',
                'payable_id' => 17,
                'wallet_id' => 2,
                'type' => 'deposit',
                'amount' => '1000',
                'confirmed' => 1,
                'details' => NULL,
                'meta' => '{"details":"Top Up on Wallet"}',
                'uuid' => '89a1b1bd-2319-4c61-aab6-ef6577261187',
                'created_at' => '2024-01-15 13:37:32',
                'updated_at' => '2024-01-15 13:37:32',
            ),
            3 => 
            array (
                'id' => 4,
                'payable_type' => 'App\\Models\\User',
                'payable_id' => 17,
                'wallet_id' => 2,
                'type' => 'withdraw',
                'amount' => '-500',
                'confirmed' => 1,
                'details' => NULL,
                'meta' => '{"details":"WithDraw Amount from Wallet"}',
                'uuid' => '484edf5a-f479-4996-8dda-34a8480a0c28',
                'created_at' => '2024-01-15 13:43:03',
                'updated_at' => '2024-01-15 13:43:03',
            ),
            4 => 
            array (
                'id' => 5,
                'payable_type' => 'App\\Models\\User',
                'payable_id' => 19,
                'wallet_id' => 1,
                'type' => 'deposit',
                'amount' => '150',
                'confirmed' => 1,
                'details' => NULL,
                'meta' => '{"details":"Top Up on Wallet"}',
                'uuid' => '226edac8-d21b-424e-90ac-9555281060b6',
                'created_at' => '2024-01-15 14:16:37',
                'updated_at' => '2024-01-15 14:16:37',
            ),
            5 => 
            array (
                'id' => 6,
                'payable_type' => 'App\\Models\\User',
                'payable_id' => 19,
                'wallet_id' => 1,
                'type' => 'deposit',
                'amount' => '150',
                'confirmed' => 1,
                'details' => NULL,
                'meta' => '{"details":"Top Up on Wallet"}',
                'uuid' => '3a046873-f8de-428e-b4f3-9f0dca4d11ff',
                'created_at' => '2024-01-15 14:24:22',
                'updated_at' => '2024-01-15 14:24:22',
            ),
            6 => 
            array (
                'id' => 7,
                'payable_type' => 'App\\Models\\User',
                'payable_id' => 19,
                'wallet_id' => 1,
                'type' => 'deposit',
                'amount' => '60',
                'confirmed' => 1,
                'details' => NULL,
                'meta' => '{"details":"Top Up on Wallet"}',
                'uuid' => '23f47abc-0960-4d85-aa82-acb99de38893',
                'created_at' => '2024-01-17 18:18:48',
                'updated_at' => '2024-01-17 18:18:48',
            ),
            7 => 
            array (
                'id' => 8,
                'payable_type' => 'App\\Models\\User',
                'payable_id' => 34,
                'wallet_id' => 9,
                'type' => 'deposit',
                'amount' => '10',
                'confirmed' => 1,
                'details' => NULL,
                'meta' => NULL,
                'uuid' => '85461e5b-3e66-4cc4-8609-5b89186d8b99',
                'created_at' => '2024-02-23 10:36:27',
                'updated_at' => '2024-02-23 10:36:27',
            ),
            8 => 
            array (
                'id' => 9,
                'payable_type' => 'App\\Models\\User',
                'payable_id' => 103,
                'wallet_id' => 20,
                'type' => 'deposit',
                'amount' => '4354',
                'confirmed' => 1,
                'details' => NULL,
                'meta' => '{"details":"Top Up on Wallet"}',
                'uuid' => '406a3cc9-0c3f-4a3f-a1ad-1d740135fb5c',
                'created_at' => '2024-06-13 14:27:23',
                'updated_at' => '2024-06-13 14:27:23',
            ),
            9 => 
            array (
                'id' => 10,
                'payable_type' => 'App\\Models\\User',
                'payable_id' => 103,
                'wallet_id' => 20,
                'type' => 'deposit',
                'amount' => '2132',
                'confirmed' => 1,
                'details' => NULL,
                'meta' => '{"details":"Top Up on Wallet"}',
                'uuid' => '92334b50-10bb-422d-9681-31e6c712c576',
                'created_at' => '2024-06-13 14:28:41',
                'updated_at' => '2024-06-13 14:28:41',
            ),
        ));
        
        
    }
}