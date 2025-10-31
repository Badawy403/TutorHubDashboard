<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BlogCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('blog_categories')->delete();
        
        \DB::table('blog_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '{"en":"Education blogs","hi":"\\u0936\\u093f\\u0915\\u094d\\u0937\\u093e","ar":"\\u062a\\u0639\\u0644\\u064a\\u0645"}',
                'description' => '{"en":"<p><strong>Lorem Ipsum<\\/strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&nbsp;<\\/p>","hi":"<p><strong>\\u0932\\u094b\\u0930\\u092e \\u0907\\u092a\\u094d\\u0938\\u092e<\\/strong>&nbsp;\\u0915\\u0947\\u0935\\u0932 \\u092e\\u0941\\u0926\\u094d\\u0930\\u0923 \\u0914\\u0930 \\u091f\\u093e\\u0907\\u092a\\u0938\\u0947\\u091f\\u093f\\u0902\\u0917 \\u0909\\u0926\\u094d\\u092f\\u094b\\u0917 \\u0915\\u093e \\u0921\\u092e\\u0940 \\u092a\\u093e\\u0920 \\u0939\\u0948\\u0964 \\u0932\\u094b\\u0930\\u092e \\u0907\\u092a\\u094d\\u0938\\u092e \\u0915\\u093e \\u0909\\u0926\\u094d\\u092f\\u094b\\u0917 \\u0924\\u092c \\u0938\\u0947 \\u0939\\u0948, 1500 \\u0915\\u0947 \\u0926\\u0936\\u0915 \\u0938\\u0947, \\u091c\\u092c \\u090f\\u0915 \\u0905\\u091c\\u094d\\u091e\\u093e\\u0924 \\u092e\\u0941\\u0926\\u094d\\u0930\\u0915 \\u0928\\u0947 \\u090f\\u0915 \\u0917\\u0948\\u0932\\u0940 \\u0911\\u092b \\u091f\\u093e\\u0907\\u092a \\u0932\\u0947\\u0915\\u0930 \\u0907\\u0938\\u0947 \\u092e\\u093f\\u0936\\u094d\\u0930\\u093f\\u0924 \\u0915\\u093f\\u092f\\u093e \\u0925\\u093e \\u0924\\u093e\\u0915\\u093f \\u090f\\u0915 \\u092a\\u094d\\u0930\\u0915\\u093e\\u0930 \\u0915\\u0940 \\u0928\\u092e\\u0942\\u0928\\u093e \\u092a\\u0941\\u0938\\u094d\\u0924\\u0915 \\u092c\\u0928\\u093e \\u0938\\u0915\\u0947\\u0964&nbsp;<\\/p>","ar":"<p><strong>\\u0644\\u0648\\u0631\\u064a\\u0645 \\u0625\\u064a\\u0628\\u0633\\u0648\\u0645<\\/strong>&nbsp;\\u0647\\u0648 \\u0645\\u062c\\u0631\\u062f \\u0646\\u0635 \\u062f\\u0645\\u064a\\u0629 \\u0645\\u0646 \\u0635\\u0646\\u0627\\u0639\\u0629 \\u0627\\u0644\\u0637\\u0628\\u0627\\u0639\\u0629 \\u0648\\u0627\\u0644\\u062a\\u0635\\u0641\\u064a\\u062d. \\u0648\\u0642\\u062f \\u0643\\u0627\\u0646 \\u0644\\u0648\\u0631\\u064a\\u0645 \\u0625\\u064a\\u0628\\u0633\\u0648\\u0645 \\u0627\\u0644\\u0646\\u0635 \\u0627\\u0644\\u062f\\u0645\\u064a\\u0629 \\u0627\\u0644\\u0642\\u064a\\u0627\\u0633\\u064a \\u0641\\u064a \\u0627\\u0644\\u0635\\u0646\\u0627\\u0639\\u0629 \\u0645\\u0646\\u0630 \\u0627\\u0644\\u0642\\u0631\\u0646 \\u0627\\u0644\\u062e\\u0627\\u0645\\u0633 \\u0639\\u0634\\u0631\\u060c \\u0639\\u0646\\u062f\\u0645\\u0627 \\u0623\\u062e\\u0630\\u062a \\u0637\\u0627\\u0628\\u0639\\u0629 \\u0645\\u062c\\u0647\\u0648\\u0644\\u0629 \\u0645\\u062c\\u0645\\u0648\\u0639\\u0629 \\u0645\\u0646 \\u0627\\u0644\\u0646\\u0648\\u0639 \\u0648\\u0623\\u0639\\u0637\\u062a\\u0647\\u0627 \\u0644\\u0632\\u064a\\u0627\\u062f\\u0629 \\u0639\\u064a\\u0646\\u0629 \\u0646\\u0648\\u0639.&nbsp;<\\/p>"}',
                'slug' => 'education-blogs-1',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => NULL,
                'created_at' => '2023-10-05 11:46:28',
                'updated_at' => '2024-03-26 16:17:28',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '{"en":"Teacher Toolkit Blog","hi":"\\u0936\\u093f\\u0915\\u094d\\u0937\\u0915 \\u0909\\u092a\\u0915\\u0930\\u0923 \\u092c\\u094d\\u0932\\u0949\\u0917","ar":"\\u0645\\u062f\\u0648\\u0646\\u0629 \\u0623\\u062f\\u0648\\u0627\\u062a \\u0627\\u0644\\u0645\\u0639\\u0644\\u0645"}',
                'description' => '{"en":"<p><strong>Lorem Ipsum<\\/strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&nbsp;<\\/p>","hi":"<p><strong>\\u0932\\u094b\\u0930\\u092e \\u0907\\u092a\\u094d\\u0938\\u092e<\\/strong>&nbsp;\\u0915\\u0947\\u0935\\u0932 \\u092e\\u0941\\u0926\\u094d\\u0930\\u0923 \\u0914\\u0930 \\u091f\\u093e\\u0907\\u092a\\u0938\\u0947\\u091f\\u093f\\u0902\\u0917 \\u0909\\u0926\\u094d\\u092f\\u094b\\u0917 \\u0915\\u093e \\u0921\\u092e\\u0940 \\u092a\\u093e\\u0920 \\u0939\\u0948\\u0964 \\u0932\\u094b\\u0930\\u092e \\u0907\\u092a\\u094d\\u0938\\u092e \\u0915\\u093e \\u0909\\u0926\\u094d\\u092f\\u094b\\u0917 \\u0924\\u092c \\u0938\\u0947 \\u0939\\u0948, 1500 \\u0915\\u0947 \\u0926\\u0936\\u0915 \\u0938\\u0947, \\u091c\\u092c \\u090f\\u0915 \\u0905\\u091c\\u094d\\u091e\\u093e\\u0924 \\u092e\\u0941\\u0926\\u094d\\u0930\\u0915 \\u0928\\u0947 \\u090f\\u0915 \\u0917\\u0948\\u0932\\u0940 \\u0911\\u092b \\u091f\\u093e\\u0907\\u092a \\u0932\\u0947\\u0915\\u0930 \\u0907\\u0938\\u0947 \\u092e\\u093f\\u0936\\u094d\\u0930\\u093f\\u0924 \\u0915\\u093f\\u092f\\u093e \\u0925\\u093e \\u0924\\u093e\\u0915\\u093f \\u090f\\u0915 \\u092a\\u094d\\u0930\\u0915\\u093e\\u0930 \\u0915\\u0940 \\u0928\\u092e\\u0942\\u0928\\u093e \\u092a\\u0941\\u0938\\u094d\\u0924\\u0915 \\u092c\\u0928\\u093e \\u0938\\u0915\\u0947\\u0964&nbsp;<\\/p>","ar":"<p><strong>\\u0644\\u0648\\u0631\\u064a\\u0645 \\u0625\\u064a\\u0628\\u0633\\u0648\\u0645<\\/strong>&nbsp;\\u0647\\u0648 \\u0645\\u062c\\u0631\\u062f \\u0646\\u0635 \\u062f\\u0645\\u064a\\u0629 \\u0645\\u0646 \\u0635\\u0646\\u0627\\u0639\\u0629 \\u0627\\u0644\\u0637\\u0628\\u0627\\u0639\\u0629 \\u0648\\u0627\\u0644\\u062a\\u0635\\u0641\\u064a\\u062d. \\u0648\\u0642\\u062f \\u0643\\u0627\\u0646 \\u0644\\u0648\\u0631\\u064a\\u0645 \\u0625\\u064a\\u0628\\u0633\\u0648\\u0645 \\u0627\\u0644\\u0646\\u0635 \\u0627\\u0644\\u062f\\u0645\\u064a\\u0629 \\u0627\\u0644\\u0642\\u064a\\u0627\\u0633\\u064a \\u0641\\u064a \\u0627\\u0644\\u0635\\u0646\\u0627\\u0639\\u0629 \\u0645\\u0646\\u0630 \\u0627\\u0644\\u0642\\u0631\\u0646 \\u0627\\u0644\\u062e\\u0627\\u0645\\u0633 \\u0639\\u0634\\u0631\\u060c \\u0639\\u0646\\u062f\\u0645\\u0627 \\u0623\\u062e\\u0630\\u062a \\u0637\\u0627\\u0628\\u0639\\u0629 \\u0645\\u062c\\u0647\\u0648\\u0644\\u0629 \\u0645\\u062c\\u0645\\u0648\\u0639\\u0629 \\u0645\\u0646 \\u0627\\u0644\\u0646\\u0648\\u0639 \\u0648\\u0623\\u0639\\u0637\\u062a\\u0647\\u0627 \\u0644\\u0632\\u064a\\u0627\\u062f\\u0629 \\u0639\\u064a\\u0646\\u0629 \\u0646\\u0648\\u0639.&nbsp;<\\/p>"}',
                'slug' => 'teacher-toolkit-blog-2',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => NULL,
                'created_at' => '2023-10-05 11:46:48',
                'updated_at' => '2024-03-26 16:17:13',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '{"en":"sadasd","hi":"asdasdas","ar":"asdasdas"}',
                'description' => '{"en":"asdasda","hi":"dasdasdasd","ar":"dasdasdasd"}',
                'slug' => 'sadasd-3',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => '/images/blog_categories/654265dc3c72d.png',
                'created_at' => '2023-11-01 19:51:08',
                'updated_at' => '2023-11-01 19:51:24',
                'deleted_at' => '2023-11-01 19:51:24',
            ),
        ));
        
        
    }
}