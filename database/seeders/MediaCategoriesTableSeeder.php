<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MediaCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('media_categories')->delete();
        
        
        
    }
}