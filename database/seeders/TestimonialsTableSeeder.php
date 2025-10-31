<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestimonialsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('testimonials')->delete();
        
        \DB::table('testimonials')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Jeff Carter',
                'description' => '<p>&quot;I hired Benjamin Mark His dedication, professionalism, and attention to detail have truly impressed me. Benjamin&#39;s ability to think outside the box and come up with creative solutions has greatly contributed to the success of our project. I highly recommend Benjamin to anyone looking for a talented and reliable professional.&quot;</p>',
                'slug' => 'jeff-carter-1',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => '/images/testimonials/6613bb1cd4ae9.png',
                'category' => 'Student',
                'created_at' => '2023-10-04 16:43:25',
                'updated_at' => '2024-04-08 14:38:36',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'john kane',
                'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.12</p>',
                'slug' => 'john-kane-2',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => '/images/testimonials/65426709021d5.png',
                'category' => 'student',
                'created_at' => '2023-11-01 19:56:09',
                'updated_at' => '2023-11-01 19:57:06',
                'deleted_at' => '2023-11-01 19:57:06',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'admin',
                'description' => '<p>asdasdasdasdasdas</p>',
                'slug' => 'admin-3',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => '/images/testimonials/65426ecb68ff7.png',
                'category' => 'student',
                'created_at' => '2023-11-01 20:29:15',
                'updated_at' => '2023-11-01 20:30:04',
                'deleted_at' => '2023-11-01 20:30:04',
            ),
        ));
        
        
    }
}