<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubscriptionItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('subscription_items')->delete();
        
        \DB::table('subscription_items')->insert(array (
            0 => 
            array (
                'id' => 1,
                'subscription_id' => 1,
                'stripe_id' => 'si_P0K0E065xYNh52',
                'stripe_product' => 'prod_NVQ6mrb4RxpwQx',
                'stripe_price' => 'price_1MkPGfHTAHWwyrB6thyCbJXk',
                'quantity' => 1,
                'created_at' => '2023-11-14 14:56:57',
                'updated_at' => '2023-11-14 14:56:57',
            ),
            1 => 
            array (
                'id' => 2,
                'subscription_id' => 2,
                'stripe_id' => 'si_P0KbZeKmkhio7m',
                'stripe_product' => 'prod_NVQ6mrb4RxpwQx',
                'stripe_price' => 'price_1MkPGfHTAHWwyrB6thyCbJXk',
                'quantity' => 1,
                'created_at' => '2023-11-14 15:33:53',
                'updated_at' => '2023-11-14 15:33:53',
            ),
            2 => 
            array (
                'id' => 3,
                'subscription_id' => 3,
                'stripe_id' => 'si_P3iFLQpYUxw1nW',
                'stripe_product' => 'prod_NVQ6mrb4RxpwQx',
                'stripe_price' => 'price_1MkPGfHTAHWwyrB6thyCbJXk',
                'quantity' => 1,
                'created_at' => '2023-11-23 16:11:47',
                'updated_at' => '2023-11-23 16:11:47',
            ),
            3 => 
            array (
                'id' => 4,
                'subscription_id' => 4,
                'stripe_id' => 'si_P3lPrRwzY3pws4',
                'stripe_product' => 'prod_NVQ6mrb4RxpwQx',
                'stripe_price' => 'price_1MkPGfHTAHWwyrB6thyCbJXk',
                'quantity' => 1,
                'created_at' => '2023-11-23 19:27:33',
                'updated_at' => '2023-11-23 19:27:33',
            ),
            4 => 
            array (
                'id' => 5,
                'subscription_id' => 5,
                'stripe_id' => 'si_P3sX3xQtd168uw',
                'stripe_product' => 'prod_NVQ6mrb4RxpwQx',
                'stripe_price' => 'price_1MkPGfHTAHWwyrB6thyCbJXk',
                'quantity' => 1,
                'created_at' => '2023-11-24 02:50:13',
                'updated_at' => '2023-11-24 02:50:13',
            ),
            5 => 
            array (
                'id' => 6,
                'subscription_id' => 6,
                'stripe_id' => 'si_QAHHhuSAS4E9nQ',
                'stripe_product' => 'prod_NVQ6mrb4RxpwQx',
                'stripe_price' => 'price_1MkPGfHTAHWwyrB6thyCbJXk',
                'quantity' => 1,
                'created_at' => '2024-05-24 16:56:15',
                'updated_at' => '2024-05-24 16:56:15',
            ),
            6 => 
            array (
                'id' => 7,
                'subscription_id' => 7,
                'stripe_id' => 'si_QF6FXlDkFVDM3m',
                'stripe_product' => 'prod_NVQ6mrb4RxpwQx',
                'stripe_price' => 'price_1MkPGfHTAHWwyrB6thyCbJXk',
                'quantity' => 1,
                'created_at' => '2024-06-06 13:51:31',
                'updated_at' => '2024-06-06 13:51:31',
            ),
        ));
        
        
    }
}