<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SocialAccountsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('social_accounts')->delete();
        
        \DB::table('social_accounts')->insert(array (
            0 => 
            array (
                'id' => 2,
                'user_id' => 249,
                'provider_name' => 'facebook',
                'provider_id' => '3236273933184827',
                'created_at' => '2023-01-10 18:52:12',
                'updated_at' => '2023-01-10 18:52:12',
            ),
            1 => 
            array (
                'id' => 3,
                'user_id' => 250,
                'provider_name' => 'google',
                'provider_id' => '103935128277036738360',
                'created_at' => '2023-01-10 20:46:00',
                'updated_at' => '2023-01-10 20:46:00',
            ),
            2 => 
            array (
                'id' => 4,
                'user_id' => 267,
                'provider_name' => 'google',
                'provider_id' => '105431641228825580963',
                'created_at' => '2023-01-21 16:52:50',
                'updated_at' => '2023-01-21 16:52:50',
            ),
            3 => 
            array (
                'id' => 5,
                'user_id' => 274,
                'provider_name' => 'google',
                'provider_id' => '105723566399447041160',
                'created_at' => '2023-03-01 03:12:13',
                'updated_at' => '2023-03-01 03:12:13',
            ),
            4 => 
            array (
                'id' => 6,
                'user_id' => 294,
                'provider_name' => 'google',
                'provider_id' => '108733358469025002263',
                'created_at' => '2023-03-02 19:00:55',
                'updated_at' => '2023-03-02 19:00:55',
            ),
        ));
        
        
    }
}