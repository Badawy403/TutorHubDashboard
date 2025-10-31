<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TeacherPaymentsHistoryTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('teacher_payments_history')->delete();
        
        
        
    }
}