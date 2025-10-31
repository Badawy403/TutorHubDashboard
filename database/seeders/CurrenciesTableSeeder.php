<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('currencies')->delete();
        
        \DB::table('currencies')->insert(array (
            0 => 
            array (
                'id' => 8,
                'name' => 'USA Dollar',
                'code' => 'AUD',
                'symbol' => '€',
                'direction' => 'ltr',
                'decimal_places' => 4,
                'value' => 1.0,
                'is_default' => 1,
                'is_active' => 1,
                'created_at' => '2021-03-19 06:57:02',
                'updated_at' => '2024-01-09 15:27:32',
            ),
        ));
        
        
    }
}