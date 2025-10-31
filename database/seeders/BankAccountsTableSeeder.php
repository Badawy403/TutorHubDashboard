<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BankAccountsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('bank_accounts')->delete();
        
        \DB::table('bank_accounts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Habib Bank Limited',
                'description' => 'Habib Bank Limited',
                'account_number' => '0321654987123654789',
                'account_holder_name' => 'Joe Doe',
                'iban_number' => 'abcd1235458798751dsad',
                'bic_swift' => 'bicswift15451435',
                'sort_code' => '1',
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Al Habib',
                'description' => NULL,
                'account_number' => '12132154548474564',
                'account_holder_name' => 'Rhea Baxter updated',
                'iban_number' => 'ABC123654789',
                'bic_swift' => 'adsdasd',
                'sort_code' => NULL,
                'is_active' => 1,
                'created_at' => '2024-05-10 08:44:02',
                'updated_at' => '2024-05-11 00:03:54',
                'deleted_at' => '2024-05-11 00:03:54',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Meezan Bank',
                'description' => '<p>asdaqdasdasdasd</p>',
                'account_number' => '78965412332145',
                'account_holder_name' => 'Mr.Haseeb',
                'iban_number' => '594651654976516njgdasd',
                'bic_swift' => 'dadasd',
                'sort_code' => NULL,
                'is_active' => 1,
                'created_at' => '2024-05-11 00:06:30',
                'updated_at' => '2024-05-11 00:06:30',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}