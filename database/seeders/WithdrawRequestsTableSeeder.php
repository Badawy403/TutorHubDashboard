<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WithdrawRequestsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('withdraw_requests')->delete();
        
        \DB::table('withdraw_requests')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 17,
                'amount' => 500,
                'account_holder' => 'Isabella',
                'account_number' => '4025123456784500',
                'bank' => 'ALfalah',
                'additional_note' => 'Thanks For Pamyent',
                'status' => 'approved',
                'rejected_reason' => NULL,
                'created_at' => '2024-01-15 13:40:09',
                'updated_at' => '2024-01-15 13:43:03',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 17,
                'amount' => 20,
                'account_holder' => 'Isabella',
                'account_number' => '4512451245124512',
                'bank' => 'AFL',
                'additional_note' => 'Thanks',
                'status' => 'pending',
                'rejected_reason' => NULL,
                'created_at' => '2024-01-15 13:49:23',
                'updated_at' => '2024-01-15 13:49:23',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 17,
                'amount' => 20,
                'account_holder' => 'Isabella',
                'account_number' => '4512451245124512',
                'bank' => 'AFL',
                'additional_note' => 'Thanks',
                'status' => 'pending',
                'rejected_reason' => NULL,
                'created_at' => '2024-01-15 13:50:11',
                'updated_at' => '2024-01-15 13:50:11',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 17,
                'amount' => 50,
                'account_holder' => 'Isabella',
                'account_number' => '4512451265326532',
                'bank' => 'HBL',
                'additional_note' => 'Withdraw',
                'status' => 'pending',
                'rejected_reason' => NULL,
                'created_at' => '2024-01-15 13:51:53',
                'updated_at' => '2024-01-15 13:51:53',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 17,
                'amount' => 50,
                'account_holder' => 'Mono',
                'account_number' => '4215421562536253',
                'bank' => 'HBL',
                'additional_note' => 'Testing',
                'status' => 'pending',
                'rejected_reason' => NULL,
                'created_at' => '2024-01-16 13:39:54',
                'updated_at' => '2024-01-16 13:39:54',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 17,
                'amount' => 20,
                'account_holder' => 'Mono',
                'account_number' => '123456789987654321',
                'bank' => 'fgl',
                'additional_note' => 'from mobile',
                'status' => 'pending',
                'rejected_reason' => NULL,
                'created_at' => '2024-01-16 13:41:25',
                'updated_at' => '2024-01-16 13:41:25',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 17,
                'amount' => 45,
                'account_holder' => 'gnnn',
                'account_number' => '56hh',
                'bank' => 'hhh',
                'additional_note' => 'vbnff',
                'status' => 'pending',
                'rejected_reason' => NULL,
                'created_at' => '2024-01-16 14:58:16',
                'updated_at' => '2024-01-16 14:58:16',
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 17,
                'amount' => 20,
                'account_holder' => 'Ali',
                'account_number' => '050505012',
                'bank' => 'ALfalah',
                'additional_note' => 'Thanks',
                'status' => 'pending',
                'rejected_reason' => NULL,
                'created_at' => '2024-06-13 17:12:08',
                'updated_at' => '2024-06-13 17:12:08',
            ),
            8 => 
            array (
                'id' => 9,
                'user_id' => 17,
                'amount' => 200,
                'account_holder' => 'Ali',
                'account_number' => '5050505050',
                'bank' => 'Alfalah',
                'additional_note' => 'Thanks 2',
                'status' => 'pending',
                'rejected_reason' => NULL,
                'created_at' => '2024-06-13 17:17:22',
                'updated_at' => '2024-06-13 17:17:22',
            ),
            9 => 
            array (
                'id' => 10,
                'user_id' => 17,
                'amount' => 100,
                'account_holder' => 'ali',
                'account_number' => 'asdaf',
                'bank' => 'alfa',
                'additional_note' => 'thanks 3',
                'status' => 'pending',
                'rejected_reason' => NULL,
                'created_at' => '2024-06-13 17:22:04',
                'updated_at' => '2024-06-13 17:22:04',
            ),
        ));
        
        
    }
}