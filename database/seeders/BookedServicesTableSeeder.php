<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BookedServicesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('booked_services')->delete();
        
        
        
    }
}