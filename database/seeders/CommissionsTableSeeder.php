<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('commissions')->delete();
        
        \DB::table('commissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'appointment_type_id' => 1,
                'service_type_id' => NULL,
                'rate' => 20.0,
                'commission_type' => 'percentage',
                'created_at' => '2024-05-14 12:59:08',
                'updated_at' => '2024-05-14 12:59:08',
            ),
            1 => 
            array (
                'id' => 2,
                'appointment_type_id' => 2,
                'service_type_id' => NULL,
                'rate' => 20.0,
                'commission_type' => 'fixed_rate',
                'created_at' => '2024-05-14 12:59:08',
                'updated_at' => '2024-05-14 12:59:08',
            ),
            2 => 
            array (
                'id' => 3,
                'appointment_type_id' => 3,
                'service_type_id' => NULL,
                'rate' => 20.0,
                'commission_type' => 'fixed_rate',
                'created_at' => '2024-05-14 12:59:08',
                'updated_at' => '2024-05-14 12:59:08',
            ),
        ));
        
        
    }
}