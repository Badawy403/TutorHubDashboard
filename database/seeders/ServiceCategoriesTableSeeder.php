<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_categories')->delete();
        
        \DB::table('service_categories')->insert(array (
            0 => 
            array (
                'id' => 7,
                'name' => '{"en":"Trademark Register","hi":"\\u091f\\u094d\\u0930\\u0947\\u0921\\u092e\\u093e\\u0930\\u094d\\u0915 \\u092a\\u0902\\u091c\\u0940\\u0915\\u0930\\u0923","ar":"\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629"}',
                'description' => '{"en":"<p>Legal professionals help clients secure trademarks to protect their brand names, logos, and other identifying marks. This involves conducting trademark searches, preparing and filing trademark applications, and responding to any issues that arise during the registration process.<\\/p>","hi":"<p>\\u0915\\u093e\\u0928\\u0942\\u0928\\u0940 \\u092a\\u0947\\u0936\\u0947\\u0935\\u0930 \\u0917\\u094d\\u0930\\u093e\\u0939\\u0915\\u094b\\u0902 \\u0915\\u094b \\u0909\\u0928\\u0915\\u0947 \\u092c\\u094d\\u0930\\u093e\\u0902\\u0921 \\u0928\\u093e\\u092e, \\u0932\\u094b\\u0917\\u094b \\u0914\\u0930 \\u0905\\u0928\\u094d\\u092f \\u092a\\u0939\\u091a\\u093e\\u0928\\u0928\\u0947 \\u092f\\u094b\\u0917\\u094d\\u092f \\u091a\\u093f\\u0939\\u094d\\u0928\\u094b\\u0902 \\u0915\\u0940 \\u0938\\u0941\\u0930\\u0915\\u094d\\u0937\\u093e \\u0915\\u0947 \\u0932\\u093f\\u090f \\u091f\\u094d\\u0930\\u0947\\u0921\\u092e\\u093e\\u0930\\u094d\\u0915 \\u092a\\u094d\\u0930\\u093e\\u092a\\u094d\\u0924 \\u0915\\u0930\\u0928\\u0947 \\u092e\\u0947\\u0902 \\u0938\\u0939\\u093e\\u092f\\u0924\\u093e \\u0915\\u0930\\u0924\\u0947 \\u0939\\u0948\\u0902\\u0964 \\u0907\\u0938\\u092e\\u0947\\u0902 \\u091f\\u094d\\u0930\\u0947\\u0921\\u092e\\u093e\\u0930\\u094d\\u0915 \\u0916\\u094b\\u091c \\u0915\\u0930\\u0928\\u093e, \\u091f\\u094d\\u0930\\u0947\\u0921\\u092e\\u093e\\u0930\\u094d\\u0915 \\u0906\\u0935\\u0947\\u0926\\u0928 \\u0924\\u0948\\u092f\\u093e\\u0930 \\u0915\\u0930\\u0928\\u093e \\u0914\\u0930 \\u0926\\u093e\\u0916\\u093f\\u0932 \\u0915\\u0930\\u0928\\u093e, \\u0914\\u0930 \\u092a\\u0902\\u091c\\u0940\\u0915\\u0930\\u0923 \\u092a\\u094d\\u0930\\u0915\\u094d\\u0930\\u093f\\u092f\\u093e \\u0915\\u0947 \\u0926\\u094c\\u0930\\u093e\\u0928 \\u0909\\u0924\\u094d\\u092a\\u0928\\u094d\\u0928 \\u0939\\u094b\\u0928\\u0947 \\u0935\\u093e\\u0932\\u0947 \\u0915\\u093f\\u0938\\u0940 \\u092d\\u0940 \\u092e\\u0941\\u0926\\u094d\\u0926\\u0947 \\u0915\\u093e \\u0938\\u092e\\u093e\\u0927\\u093e\\u0928 \\u0915\\u0930\\u0928\\u093e \\u0936\\u093e\\u092e\\u093f\\u0932 \\u0939\\u0948\\u0964<\\/p>","ar":"<p>\\u064a\\u0633\\u0627\\u0639\\u062f \\u0627\\u0644\\u0645\\u062d\\u0627\\u0645\\u0648\\u0646 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0631\\u0641\\u0648\\u0646 \\u0627\\u0644\\u0639\\u0645\\u0644\\u0627\\u0621 \\u0641\\u064a \\u062a\\u0623\\u0645\\u064a\\u0646 \\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629 \\u0644\\u062d\\u0645\\u0627\\u064a\\u0629 \\u0623\\u0633\\u0645\\u0627\\u0621 \\u0639\\u0644\\u0627\\u0645\\u0627\\u062a\\u0647\\u0645 \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629 \\u0648\\u0627\\u0644\\u0634\\u0639\\u0627\\u0631\\u0627\\u062a \\u0648\\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u0623\\u062e\\u0631\\u0649 \\u0627\\u0644\\u0645\\u0645\\u064a\\u0632\\u0629. \\u064a\\u062a\\u0636\\u0645\\u0646 \\u0630\\u0644\\u0643 \\u0625\\u062c\\u0631\\u0627\\u0621 \\u0639\\u0645\\u0644\\u064a\\u0627\\u062a \\u0627\\u0644\\u0628\\u062d\\u062b \\u0639\\u0646 \\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629\\u060c \\u0625\\u0639\\u062f\\u0627\\u062f \\u0648\\u062a\\u0642\\u062f\\u064a\\u0645 \\u0637\\u0644\\u0628\\u0627\\u062a \\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629\\u060c \\u0648\\u0627\\u0644\\u0631\\u062f \\u0639\\u0644\\u0649 \\u0623\\u064a \\u0645\\u0633\\u0627\\u0626\\u0644 \\u0642\\u062f \\u062a\\u0646\\u0634\\u0623 \\u062e\\u0644\\u0627\\u0644 \\u0639\\u0645\\u0644\\u064a\\u0629 \\u0627\\u0644\\u062a\\u0633\\u062c\\u064a\\u0644.<\\/p>"}',
                'slug' => 'trademark-register-7',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => '/images/service_categories/66ebe6c2a3f11.png',
                'created_at' => '2024-05-17 12:01:51',
                'updated_at' => '2024-09-19 08:54:26',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 8,
                'name' => '{"en":"Educational Service","hi":"Educational Service","ar":"Educational Service"}',
                'description' => '{"en":"<p>Educational Service&nbsp;Educational Service&nbsp;Educational Service&nbsp;Educational Service&nbsp;</p>","hi":"<p>Educational Service&nbsp;Educational Service&nbsp;Educational Service&nbsp;Educational Service&nbsp;</p>","ar":"<p>Educational Service&nbsp;Educational Service&nbsp;Educational Service&nbsp;Educational Service&nbsp;</p>"}',
                'slug' => 'educational-service-8',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => '/images/service_categories/6683eef82cdf9.png',
                'created_at' => '2024-07-01 00:20:28',
                'updated_at' => '2024-07-02 07:13:44',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 9,
                'name' => '{"en":"Mathematics Rules","hi":"Mathematics Rules","ar":"Mathematics Rules"}',
                'description' => '{"en":"<p>Mathematics RulesMathematics RulesMathematics RulesMathematics Rules</p>","hi":"<p>Mathematics RulesMathematics RulesMathematics RulesMathematics Rules</p>","ar":"<p>Mathematics RulesMathematics RulesMathematics RulesMathematics RulesMathematics Rules</p>"}',
                'slug' => 'mathematics-rules-9',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => '/images/service_categories/6683ef92820d3.png',
                'created_at' => '2024-07-02 07:16:18',
                'updated_at' => '2024-07-02 07:16:18',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 10,
                'name' => '{"en":"Mathematics","hi":"गणित","ar":"رياضيات"}',
                'description' => '{"en":"<p>Mathematics</p>","hi":"<p>गणित</p>","ar":"<p>رياضيات</p>"}',
                'slug' => 'mathematics-10',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => '/images/service_categories/66ebe67d1884f.png',
                'created_at' => '2024-09-19 08:53:17',
                'updated_at' => '2024-09-19 08:53:17',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}