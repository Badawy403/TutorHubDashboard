<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ChangeLogsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('change_logs')->delete();
        
        
        
    }
}