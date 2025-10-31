<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PodcastCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('podcast_categories')->delete();
        
        \DB::table('podcast_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Blog Category',
                'description' => '<p>Blog Category</p>',
                'slug' => 'blog-category-1',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => NULL,
                'created_at' => '2023-09-19 13:09:05',
                'updated_at' => '2023-09-20 15:17:26',
                'deleted_at' => '2023-09-20 15:17:26',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '{"en":"Education and Learning","hi":"\\u0936\\u093f\\u0915\\u094d\\u0937\\u093e \\u0914\\u0930 \\u0905\\u0927\\u094d\\u092f\\u092f\\u0928","ar":"\\u0627\\u0644\\u062a\\u0639\\u0644\\u064a\\u0645 \\u0648\\u0627\\u0644\\u062a\\u0639\\u0644\\u0645"}',
                'description' => '{"en":"Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi, id debitis. Error cumque sint deserunt suscipit. Quos similique iusto necessitatibus eligendi laudantium rem fugiat nostrum, nihil blanditiis dolores maxime ut!","hi":"\\u0932\\u094b\\u0930\\u0947\\u092e \\u0907\\u092a\\u094d\\u0938\\u092e \\u0926\\u0930\\u094d\\u0926 \\u0938\\u0940\\u091f \\u0905\\u092e\\u0947\\u091f \\u0915\\u0949\\u0928\\u094d\\u0938\\u0947\\u0915\\u094d\\u091f\\u0947\\u091f\\u0930 \\u0905\\u0921\\u093c\\u093f\\u092a\\u093f\\u0938\\u093f\\u0902\\u0917 \\u090f\\u0932\\u093f\\u091f\\u0964 \\u0915\\u094b\\u092e\\u094d\\u092e\\u094b\\u0921\\u0940, \\u0906\\u0908\\u0921\\u0940 \\u0921\\u0947\\u092c\\u093f\\u0924\\u093f\\u0938\\u0964 \\u090f\\u0930\\u0930 \\u0915\\u0941\\u092e\\u094d\\u0915\\u094d\\u0935\\u0947 \\u0938\\u093f\\u0902\\u0924 \\u0921\\u0947\\u0938\\u0930\\u0941\\u0928\\u094d\\u0924 \\u0938\\u0941\\u0938\\u094d\\u0938\\u093f\\u092a\\u093f\\u0924\\u0964 \\u0915\\u094d\\u0935\\u094b\\u0938 \\u0938\\u093f\\u092e\\u093f\\u0932\\u093f\\u0915\\u094d\\u0935\\u0941 \\u0907\\u091c\\u094d\\u0924\\u094b \\u0928\\u0947\\u0938\\u094d\\u0938\\u093f\\u091f\\u093e\\u091f\\u093f\\u092c\\u0941\\u0938 \\u090f\\u0932\\u093f\\u0917\\u0947\\u0902\\u0926\\u0940 \\u0932\\u094c\\u0926\\u093e\\u0902\\u0924\\u093f\\u092f\\u0941\\u092e \\u0930\\u0947\\u092e \\u092b\\u0941\\u0917\\u093f\\u0905\\u0924 \\u0928\\u094b\\u0938\\u094d\\u0924\\u094d\\u0930\\u0941\\u092e, \\u0928\\u093f\\u0939\\u093f\\u0932 \\u092c\\u094d\\u0932\\u093e\\u0902\\u0921\\u093f\\u0924\\u093f\\u092f\\u0941\\u0938 \\u0926\\u094b\\u0932\\u094b\\u0930\\u0947\\u0938 \\u092e\\u093e\\u0915\\u094d\\u0938\\u093f\\u092e\\u0947 \\u0909\\u0924!","ar":"\\u0644\\u0648\\u0631\\u064a\\u0645 \\u0625\\u0628\\u0633\\u0648\\u0645 \\u062f\\u0648\\u0644\\u0648\\u0631 \\u0633\\u064a\\u062a \\u0623\\u0645\\u064a\\u062a\\u060c \\u0643\\u0648\\u0646\\u0633\\u064a\\u0643\\u062a\\u064a\\u062a\\u0648\\u0631 \\u0623\\u062f\\u0628\\u0627\\u064a\\u0633\\u064a\\u0633\\u064a\\u0646\\u063a \\u0623\\u064a\\u0644\\u064a\\u062a. \\u0643\\u0648\\u0645\\u0648\\u062f\\u064a\\u060c \\u0625\\u064a\\u062f \\u062f\\u064a\\u0628\\u064a\\u062a\\u064a\\u0633. \\u0625\\u0631\\u0648\\u0631 \\u0643\\u0648\\u0645\\u0643\\u0648\\u064a \\u0633\\u0646\\u062a \\u062f\\u064a\\u0633\\u064a\\u0631\\u0648\\u0646\\u062a \\u0633\\u0648\\u0633\\u064a\\u0628\\u064a\\u062a. \\u0643\\u0648\\u0633 \\u0633\\u064a\\u0645\\u064a\\u0644\\u064a\\u0643\\u0648 \\u0625\\u064a\\u0648\\u0633\\u062a\\u0648 \\u0646\\u064a\\u0633\\u064a\\u0633\\u064a\\u062a\\u0627\\u062a\\u064a\\u0628\\u0648\\u0633 \\u0625\\u064a\\u0644\\u064a\\u062c\\u064a\\u0646\\u062f\\u064a \\u0644\\u0627\\u0648\\u062f\\u0627\\u0646\\u062a\\u064a\\u0648\\u0645 \\u0631\\u064a\\u0645 \\u0641\\u0648\\u063a\\u064a\\u0627\\u062a \\u0646\\u0648\\u0633\\u062a\\u0631\\u0648\\u0645\\u060c \\u0646\\u064a\\u0647\\u064a\\u0644 \\u0628\\u0644\\u0627\\u0646\\u062f\\u064a\\u062a\\u064a\\u0648\\u0633 \\u062f\\u0648\\u0644\\u0648\\u0631\\u064a\\u0633 \\u0645\\u0627\\u0643\\u0633\\u064a\\u0645\\u064a \\u0627\\u062a!"}',
                'slug' => 'education-and-learning-2',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => '/images/podcast_categories/650b0c9a0db44.png',
                'created_at' => '2023-09-20 15:15:38',
                'updated_at' => '2024-04-02 14:14:59',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '{"en":"Podcast Category","hi":"\\u092a\\u0949\\u0921\\u0915\\u093e\\u0938\\u094d\\u091f \\u0936\\u094d\\u0930\\u0947\\u0923\\u0940","ar":"\\u0641\\u0626\\u0629 \\u0627\\u0644\\u0628\\u0648\\u062f\\u0643\\u0627\\u0633\\u062a"}',
                'description' => '{"en":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.sdasda","hi":"\\u0932\\u094b\\u0930\\u0947\\u092e \\u0907\\u092a\\u094d\\u0938\\u092e \\u0921\\u094b\\u0932\\u0930 \\u0938\\u093f\\u091f \\u0905\\u092e\\u0947\\u0924, \\u0915\\u0949\\u0928\\u094d\\u0938\\u0947\\u0915\\u094d\\u091f\\u0947\\u0924\\u0941\\u0930 \\u090f\\u0921\\u093f\\u092a\\u093f\\u0938\\u093f\\u0902\\u0917 \\u090f\\u0932\\u093f\\u0924\\u0964 \\u0938\\u0947\\u0926 \\u0926\\u094b \\u090f\\u0938\\u092e\\u094b\\u0926 \\u0924\\u0947\\u092e\\u094d\\u092a\\u094b\\u0930 \\u0907\\u0928\\u094d\\u0926\\u093f\\u0921\\u0941\\u0902\\u091f \\u0909\\u0924 \\u0932\\u092c\\u094b\\u0930\\u0947 \\u090f\\u0924 \\u0926\\u094b\\u0932\\u094b\\u0930\\u0947 \\u092e\\u0917\\u094d\\u0928\\u093e \\u0905\\u0932\\u093f\\u0915\\u094d\\u0935\\u093e\\u0964 \\u0909\\u0924 \\u090f\\u0928\\u093f\\u092e \\u0905\\u0926 \\u092e\\u093f\\u0928\\u093f\\u092e \\u0935\\u0947\\u0928\\u093f\\u092f\\u093e\\u092e, \\u0915\\u094d\\u0935\\u093f\\u0938 \\u0928\\u094b\\u0938\\u094d\\u0924\\u094d\\u0930\\u0941\\u0926 \\u090f\\u0915\\u094d\\u0938\\u0947\\u0930\\u094d\\u0938\\u093f\\u091f\\u0947\\u0936\\u0928 \\u0909\\u0932\\u094d\\u0932\\u093e\\u092e\\u094d\\u0915\\u094b \\u0932\\u093e\\u092c\\u094b\\u0930\\u093f\\u0938 \\u0928\\u093f\\u0938\\u093f \\u0909\\u0924 \\u0905\\u0932\\u093f\\u0915\\u094d\\u0935\\u093f\\u092a \\u090f\\u0915\\u094d\\u0938 \\u0908\\u0906 \\u0915\\u094b\\u092e\\u094d\\u092e\\u094b\\u0926\\u094b \\u0915\\u0949\\u0928\\u094d\\u0938\\u0947\\u0915\\u094d\\u0935\\u093e\\u0924\\u0964","ar":"\\u0648\\u0631\\u064a\\u0645 \\u0625\\u064a\\u0628\\u0633\\u0648\\u0645 \\u062f\\u0648\\u0644\\u0648\\u0631 \\u0633\\u064a\\u062a \\u0622\\u0645\\u064a\\u062a\\u060c \\u0643\\u0648\\u0646\\u0633\\u064a\\u0643\\u062a\\u064a\\u062a\\u0648\\u0631 \\u0623\\u062f\\u064a\\u0628\\u064a\\u0633\\u064a\\u0646\\u063a \\u0625\\u0644\\u064a\\u062a. \\u0633\\u062f \\u062f\\u0648 \\u0623\\u064a\\u0648\\u0633\\u0645\\u0648\\u062f \\u062a\\u0645\\u0628\\u0648\\u0631 \\u0625\\u0646\\u0633\\u064a\\u062f\\u064a\\u0648\\u0646\\u062a \\u0623\\u0648\\u062a \\u0644\\u0627\\u0628\\u0648\\u0631 \\u0622\\u062a \\u062f\\u0648\\u0644\\u0648\\u0631\\u064a \\u0645\\u0627\\u062c\\u0646\\u0627 \\u0623\\u0644\\u064a\\u0643\\u0648\\u0627. \\u0623\\u062a \\u0625\\u0646\\u064a\\u0645 \\u0622\\u062f \\u0645\\u064a\\u0646\\u064a\\u0645 \\u0641\\u064a\\u0646\\u064a\\u0627\\u0645\\u060c \\u0643\\u0648\\u064a\\u0633 \\u0646\\u0648\\u0633\\u062a\\u0631\\u0648\\u062f \\u0625\\u0643\\u0633\\u064a\\u0631\\u0633\\u064a\\u062a\\u0627\\u062a\\u064a\\u0648\\u0646 \\u0623\\u0644\\u0627\\u0645\\u0643\\u0648 \\u0644\\u0627\\u0628\\u0648\\u0631\\u064a\\u0633 \\u0646\\u064a\\u0633\\u064a \\u0623\\u0648\\u062a \\u0623\\u0644\\u064a\\u0643\\u0648\\u064a\\u0628 \\u0625\\u0643\\u0633 \\u0625\\u064a\\u0627 \\u0643\\u0648\\u0645\\u0648\\u062f\\u0648 \\u0643\\u0648\\u0646\\u0633\\u064a\\u0643\\u0648\\u0627\\u062a."}',
                'slug' => 'podcast-category-3',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => '/images/podcast_categories/65425b26bd69c.png',
                'created_at' => '2023-11-01 19:05:26',
                'updated_at' => '2023-11-01 19:06:09',
                'deleted_at' => '2023-11-01 19:06:09',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => '{"en":"Religious Freedom and Expression","hi":"\\u0927\\u093e\\u0930\\u094d\\u092e\\u093f\\u0915 \\u0938\\u094d\\u0935\\u0924\\u0902\\u0924\\u094d\\u0930\\u0924\\u093e \\u0914\\u0930 \\u0905\\u092d\\u093f\\u0935\\u094d\\u092f\\u0915\\u094d\\u0924\\u093f","ar":"\\u0627\\u0644\\u062d\\u0631\\u064a\\u0629 \\u0627\\u0644\\u062f\\u064a\\u0646\\u064a\\u0629 \\u0648\\u0627\\u0644\\u062a\\u0639\\u0628\\u064a\\u0631"}',
                'description' => '{"en":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.1222","hi":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.","ar":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur."}',
                'slug' => 'religious-freedom-and-expression-4',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => '/images/podcast_categories/65436d287f042.png',
                'created_at' => '2023-11-02 14:34:32',
                'updated_at' => '2023-11-02 14:35:10',
                'deleted_at' => '2023-11-02 14:35:10',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => '{"en":"Science and Technology","hi":"\\u0935\\u093f\\u091c\\u094d\\u091e\\u093e\\u0928 \\u0914\\u0930 \\u092a\\u094d\\u0930\\u094c\\u0926\\u094d\\u092f\\u094b\\u0917\\u093f\\u0915\\u0940","ar":"\\u0627\\u0644\\u0639\\u0644\\u0648\\u0645 \\u0648\\u0627\\u0644\\u062a\\u0643\\u0646\\u0648\\u0644\\u0648\\u062c\\u064a\\u0627"}',
                'description' => '{"en":"Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi, id debitis. Error cumque sint deserunt suscipit. Quos similique iusto necessitatibus eligendi laudantium rem fugiat nostrum, nihil blanditiis dolores maxime ut!","hi":"\\u0932\\u094b\\u0930\\u0947\\u092e \\u0907\\u092a\\u094d\\u0938\\u092e \\u0926\\u0930\\u094d\\u0926 \\u0938\\u0940\\u091f \\u0905\\u092e\\u0947\\u091f \\u0915\\u0949\\u0928\\u094d\\u0938\\u0947\\u0915\\u094d\\u091f\\u0947\\u091f\\u0930 \\u0905\\u0921\\u093c\\u093f\\u092a\\u093f\\u0938\\u093f\\u0902\\u0917 \\u090f\\u0932\\u093f\\u091f\\u0964 \\u0915\\u094b\\u092e\\u094d\\u092e\\u094b\\u0921\\u0940, \\u0906\\u0908\\u0921\\u0940 \\u0921\\u0947\\u092c\\u093f\\u0924\\u093f\\u0938\\u0964 \\u090f\\u0930\\u0930 \\u0915\\u0941\\u092e\\u094d\\u0915\\u094d\\u0935\\u0947 \\u0938\\u093f\\u0902\\u0924 \\u0921\\u0947\\u0938\\u0930\\u0941\\u0928\\u094d\\u0924 \\u0938\\u0941\\u0938\\u094d\\u0938\\u093f\\u092a\\u093f\\u0924\\u0964 \\u0915\\u094d\\u0935\\u094b\\u0938 \\u0938\\u093f\\u092e\\u093f\\u0932\\u093f\\u0915\\u094d\\u0935\\u0941 \\u0907\\u091c\\u094d\\u0924\\u094b \\u0928\\u0947\\u0938\\u094d\\u0938\\u093f\\u091f\\u093e\\u091f\\u093f\\u092c\\u0941\\u0938 \\u090f\\u0932\\u093f\\u0917\\u0947\\u0902\\u0926\\u0940 \\u0932\\u094c\\u0926\\u093e\\u0902\\u0924\\u093f\\u092f\\u0941\\u092e \\u0930\\u0947\\u092e \\u092b\\u0941\\u0917\\u093f\\u0905\\u0924 \\u0928\\u094b\\u0938\\u094d\\u0924\\u094d\\u0930\\u0941\\u092e, \\u0928\\u093f\\u0939\\u093f\\u0932 \\u092c\\u094d\\u0932\\u093e\\u0902\\u0921\\u093f\\u0924\\u093f\\u092f\\u0941\\u0938 \\u0926\\u094b\\u0932\\u094b\\u0930\\u0947\\u0938 \\u092e\\u093e\\u0915\\u094d\\u0938\\u093f\\u092e\\u0947 \\u0909\\u0924!","ar":"\\u0644\\u0648\\u0631\\u064a\\u0645 \\u0625\\u0628\\u0633\\u0648\\u0645 \\u062f\\u0648\\u0644\\u0648\\u0631 \\u0633\\u064a\\u062a \\u0623\\u0645\\u064a\\u062a\\u060c \\u0643\\u0648\\u0646\\u0633\\u064a\\u0643\\u062a\\u064a\\u062a\\u0648\\u0631 \\u0623\\u062f\\u0628\\u0627\\u064a\\u0633\\u064a\\u0633\\u064a\\u0646\\u063a \\u0623\\u064a\\u0644\\u064a\\u062a. \\u0643\\u0648\\u0645\\u0648\\u062f\\u064a\\u060c \\u0625\\u064a\\u062f \\u062f\\u064a\\u0628\\u064a\\u062a\\u064a\\u0633. \\u0625\\u0631\\u0648\\u0631 \\u0643\\u0648\\u0645\\u0643\\u0648\\u064a \\u0633\\u0646\\u062a \\u062f\\u064a\\u0633\\u064a\\u0631\\u0648\\u0646\\u062a \\u0633\\u0648\\u0633\\u064a\\u0628\\u064a\\u062a. \\u0643\\u0648\\u0633 \\u0633\\u064a\\u0645\\u064a\\u0644\\u064a\\u0643\\u0648 \\u0625\\u064a\\u0648\\u0633\\u062a\\u0648 \\u0646\\u064a\\u0633\\u064a\\u0633\\u064a\\u062a\\u0627\\u062a\\u064a\\u0628\\u0648\\u0633 \\u0625\\u064a\\u0644\\u064a\\u062c\\u064a\\u0646\\u062f\\u064a \\u0644\\u0627\\u0648\\u062f\\u0627\\u0646\\u062a\\u064a\\u0648\\u0645 \\u0631\\u064a\\u0645 \\u0641\\u0648\\u063a\\u064a\\u0627\\u062a \\u0646\\u0648\\u0633\\u062a\\u0631\\u0648\\u0645\\u060c \\u0646\\u064a\\u0647\\u064a\\u0644 \\u0628\\u0644\\u0627\\u0646\\u062f\\u064a\\u062a\\u064a\\u0648\\u0633 \\u062f\\u0648\\u0644\\u0648\\u0631\\u064a\\u0633 \\u0645\\u0627\\u0643\\u0633\\u064a\\u0645\\u064a \\u0627\\u062a!"}',
                'slug' => 'science-and-technology-5',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => NULL,
                'created_at' => '2024-04-02 14:16:57',
                'updated_at' => '2024-04-02 14:17:07',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => '{"en":"Literature","hi":"\\u0938\\u093e\\u0939\\u093f\\u0924\\u094d\\u092f","ar":"\\u0627\\u0644\\u0623\\u062f\\u0628"}',
                'description' => '{"en":"Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi, id debitis. Error cumque sint deserunt suscipit. Quos similique iusto necessitatibus eligendi laudantium rem fugiat nostrum, nihil blanditiis dolores maxime ut!","hi":"\\u0932\\u094b\\u0930\\u0947\\u092e \\u0907\\u092a\\u094d\\u0938\\u092e \\u0926\\u0930\\u094d\\u0926 \\u0938\\u0940\\u091f \\u0905\\u092e\\u0947\\u091f \\u0915\\u0949\\u0928\\u094d\\u0938\\u0947\\u0915\\u094d\\u091f\\u0947\\u091f\\u0930 \\u0905\\u0921\\u093c\\u093f\\u092a\\u093f\\u0938\\u093f\\u0902\\u0917 \\u090f\\u0932\\u093f\\u091f\\u0964 \\u0915\\u094b\\u092e\\u094d\\u092e\\u094b\\u0921\\u0940, \\u0906\\u0908\\u0921\\u0940 \\u0921\\u0947\\u092c\\u093f\\u0924\\u093f\\u0938\\u0964 \\u090f\\u0930\\u0930 \\u0915\\u0941\\u092e\\u094d\\u0915\\u094d\\u0935\\u0947 \\u0938\\u093f\\u0902\\u0924 \\u0921\\u0947\\u0938\\u0930\\u0941\\u0928\\u094d\\u0924 \\u0938\\u0941\\u0938\\u094d\\u0938\\u093f\\u092a\\u093f\\u0924\\u0964 \\u0915\\u094d\\u0935\\u094b\\u0938 \\u0938\\u093f\\u092e\\u093f\\u0932\\u093f\\u0915\\u094d\\u0935\\u0941 \\u0907\\u091c\\u094d\\u0924\\u094b \\u0928\\u0947\\u0938\\u094d\\u0938\\u093f\\u091f\\u093e\\u091f\\u093f\\u092c\\u0941\\u0938 \\u090f\\u0932\\u093f\\u0917\\u0947\\u0902\\u0926\\u0940 \\u0932\\u094c\\u0926\\u093e\\u0902\\u0924\\u093f\\u092f\\u0941\\u092e \\u0930\\u0947\\u092e \\u092b\\u0941\\u0917\\u093f\\u0905\\u0924 \\u0928\\u094b\\u0938\\u094d\\u0924\\u094d\\u0930\\u0941\\u092e, \\u0928\\u093f\\u0939\\u093f\\u0932 \\u092c\\u094d\\u0932\\u093e\\u0902\\u0921\\u093f\\u0924\\u093f\\u092f\\u0941\\u0938 \\u0926\\u094b\\u0932\\u094b\\u0930\\u0947\\u0938 \\u092e\\u093e\\u0915\\u094d\\u0938\\u093f\\u092e\\u0947 \\u0909\\u0924!","ar":"\\u0644\\u0648\\u0631\\u064a\\u0645 \\u0625\\u0628\\u0633\\u0648\\u0645 \\u062f\\u0648\\u0644\\u0648\\u0631 \\u0633\\u064a\\u062a \\u0623\\u0645\\u064a\\u062a\\u060c \\u0643\\u0648\\u0646\\u0633\\u064a\\u0643\\u062a\\u064a\\u062a\\u0648\\u0631 \\u0623\\u062f\\u0628\\u0627\\u064a\\u0633\\u064a\\u0633\\u064a\\u0646\\u063a \\u0623\\u064a\\u0644\\u064a\\u062a. \\u0643\\u0648\\u0645\\u0648\\u062f\\u064a\\u060c \\u0625\\u064a\\u062f \\u062f\\u064a\\u0628\\u064a\\u062a\\u064a\\u0633. \\u0625\\u0631\\u0648\\u0631 \\u0643\\u0648\\u0645\\u0643\\u0648\\u064a \\u0633\\u0646\\u062a \\u062f\\u064a\\u0633\\u064a\\u0631\\u0648\\u0646\\u062a \\u0633\\u0648\\u0633\\u064a\\u0628\\u064a\\u062a. \\u0643\\u0648\\u0633 \\u0633\\u064a\\u0645\\u064a\\u0644\\u064a\\u0643\\u0648 \\u0625\\u064a\\u0648\\u0633\\u062a\\u0648 \\u0646\\u064a\\u0633\\u064a\\u0633\\u064a\\u062a\\u0627\\u062a\\u064a\\u0628\\u0648\\u0633 \\u0625\\u064a\\u0644\\u064a\\u062c\\u064a\\u0646\\u062f\\u064a \\u0644\\u0627\\u0648\\u062f\\u0627\\u0646\\u062a\\u064a\\u0648\\u0645 \\u0631\\u064a\\u0645 \\u0641\\u0648\\u063a\\u064a\\u0627\\u062a \\u0646\\u0648\\u0633\\u062a\\u0631\\u0648\\u0645\\u060c \\u0646\\u064a\\u0647\\u064a\\u0644 \\u0628\\u0644\\u0627\\u0646\\u062f\\u064a\\u062a\\u064a\\u0648\\u0633 \\u062f\\u0648\\u0644\\u0648\\u0631\\u064a\\u0633 \\u0645\\u0627\\u0643\\u0633\\u064a\\u0645\\u064a \\u0627\\u062a!"}',
                'slug' => 'literature-6',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => NULL,
                'created_at' => '2024-04-02 14:18:24',
                'updated_at' => '2024-04-02 14:18:24',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}