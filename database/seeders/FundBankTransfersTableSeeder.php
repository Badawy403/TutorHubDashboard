<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FundBankTransfersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('fund_bank_transfers')->delete();
        
        \DB::table('fund_bank_transfers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'bank_account_id' => 1,
                'fund_id' => NULL,
                'date' => NULL,
                'attachment' => NULL,
                'created_at' => '2024-05-11 04:56:59',
                'updated_at' => '2024-05-11 04:56:59',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'bank_account_id' => 1,
                'fund_id' => 237,
                'date' => NULL,
                'attachment' => NULL,
                'created_at' => '2024-05-11 05:05:20',
                'updated_at' => '2024-05-11 05:05:20',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'bank_account_id' => 3,
                'fund_id' => 237,
                'date' => NULL,
                'attachment' => NULL,
                'created_at' => '2024-05-11 05:06:09',
                'updated_at' => '2024-05-11 05:06:09',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'bank_account_id' => 3,
                'fund_id' => 237,
                'date' => NULL,
                'attachment' => '/private/var/folders/ck/2t30ht_s2374bknm0d14v3vr0000gn/T/phpfTqexs',
                'created_at' => '2024-05-11 05:09:24',
                'updated_at' => '2024-05-11 05:09:24',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'bank_account_id' => 3,
                'fund_id' => 237,
                'date' => '2024-05-11 10:10:38',
                'attachment' => '/private/var/folders/ck/2t30ht_s2374bknm0d14v3vr0000gn/T/phpUjhqfa',
                'created_at' => '2024-05-11 05:10:38',
                'updated_at' => '2024-05-11 05:10:38',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'bank_account_id' => 3,
                'fund_id' => 301,
                'date' => NULL,
            'attachment' => '/files/bank_transactions/1718272430footer (1).png',
                'created_at' => '2024-06-13 04:53:50',
                'updated_at' => '2024-06-13 04:53:50',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'bank_account_id' => 3,
                'fund_id' => 302,
                'date' => NULL,
                'attachment' => '/files/bank_transactions/1718279236ray-so-export.png',
                'created_at' => '2024-06-13 06:47:16',
                'updated_at' => '2024-06-13 06:47:16',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'bank_account_id' => NULL,
                'fund_id' => 132,
                'date' => NULL,
                'attachment' => '/files/bank_transactions/1719396473tutorhub.png',
                'created_at' => '2024-06-26 05:07:53',
                'updated_at' => '2024-06-26 05:07:53',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'bank_account_id' => 1,
                'fund_id' => 133,
                'date' => NULL,
                'attachment' => '/files/bank_transactions/1719397631ray-so-export.png',
                'created_at' => '2024-06-26 05:27:11',
                'updated_at' => '2024-06-26 05:27:11',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'bank_account_id' => 3,
                'fund_id' => 135,
                'date' => NULL,
                'attachment' => '/files/bank_transactions/1719474784video2.png',
                'created_at' => '2024-06-27 02:53:04',
                'updated_at' => '2024-06-27 02:53:04',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'bank_account_id' => 1,
                'fund_id' => 136,
                'date' => NULL,
            'attachment' => '/files/bank_transactions/1719475439chat (2).jpg',
                'created_at' => '2024-06-27 03:03:59',
                'updated_at' => '2024-06-27 03:03:59',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'bank_account_id' => 1,
                'fund_id' => 137,
                'date' => NULL,
                'attachment' => '/files/bank_transactions/1719908828Vector.png',
                'created_at' => '2024-07-02 03:27:08',
                'updated_at' => '2024-07-02 03:27:08',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'bank_account_id' => 3,
                'fund_id' => 138,
                'date' => NULL,
                'attachment' => '/files/bank_transactions/1719918418ray-so-export.png',
                'created_at' => '2024-07-02 06:06:58',
                'updated_at' => '2024-07-02 06:06:58',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'bank_account_id' => 1,
                'fund_id' => 139,
                'date' => NULL,
                'attachment' => '/files/bank_transactions/1720081152EducationalServices.jpg',
                'created_at' => '2024-07-04 03:19:12',
                'updated_at' => '2024-07-04 03:19:12',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'bank_account_id' => 1,
                'fund_id' => 140,
                'date' => NULL,
                'attachment' => '/files/bank_transactions/1720095650screencapture-127-0-0-1-8000-super-admin-booked-appointments-2024-06-21-12_29_09.png',
                'created_at' => '2024-07-04 07:20:50',
                'updated_at' => '2024-07-04 07:20:50',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}