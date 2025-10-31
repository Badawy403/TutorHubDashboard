<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CurrencyCodesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('currency_codes')->delete();
        
        \DB::table('currency_codes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'ALL',
                'symbol' => 'Lek',
            ),
            1 => 
            array (
                'id' => 2,
                'code' => 'USD',
                'symbol' => '$',
            ),
            2 => 
            array (
                'id' => 3,
                'code' => 'AFN',
                'symbol' => '?',
            ),
            3 => 
            array (
                'id' => 4,
                'code' => 'ARS',
                'symbol' => '$',
            ),
            4 => 
            array (
                'id' => 5,
                'code' => 'AWG',
                'symbol' => 'ƒ',
            ),
            5 => 
            array (
                'id' => 6,
                'code' => 'AUD',
                'symbol' => '$',
            ),
            6 => 
            array (
                'id' => 7,
                'code' => 'AZN',
                'symbol' => '???',
            ),
            7 => 
            array (
                'id' => 8,
                'code' => 'BSD',
                'symbol' => '$',
            ),
            8 => 
            array (
                'id' => 9,
                'code' => 'BBD',
                'symbol' => '$',
            ),
            9 => 
            array (
                'id' => 10,
                'code' => 'BYR',
                'symbol' => 'p.',
            ),
            10 => 
            array (
                'id' => 11,
                'code' => 'EUR',
                'symbol' => '€',
            ),
            11 => 
            array (
                'id' => 12,
                'code' => 'BZD',
                'symbol' => 'BZ$',
            ),
            12 => 
            array (
                'id' => 13,
                'code' => 'BMD',
                'symbol' => '$',
            ),
            13 => 
            array (
                'id' => 14,
                'code' => 'BOB',
                'symbol' => '$b',
            ),
            14 => 
            array (
                'id' => 15,
                'code' => 'BAM',
                'symbol' => 'KM',
            ),
            15 => 
            array (
                'id' => 16,
                'code' => 'BWP',
                'symbol' => 'P',
            ),
            16 => 
            array (
                'id' => 17,
                'code' => 'BGN',
                'symbol' => '??',
            ),
            17 => 
            array (
                'id' => 18,
                'code' => 'BRL',
                'symbol' => 'R$',
            ),
            18 => 
            array (
                'id' => 19,
                'code' => 'GBP',
                'symbol' => '£',
            ),
            19 => 
            array (
                'id' => 20,
                'code' => 'BND',
                'symbol' => '$',
            ),
            20 => 
            array (
                'id' => 21,
                'code' => 'KHR',
                'symbol' => '?',
            ),
            21 => 
            array (
                'id' => 22,
                'code' => 'CAD',
                'symbol' => '$',
            ),
            22 => 
            array (
                'id' => 23,
                'code' => 'KYD',
                'symbol' => '$',
            ),
            23 => 
            array (
                'id' => 24,
                'code' => 'CLP',
                'symbol' => '$',
            ),
            24 => 
            array (
                'id' => 25,
                'code' => 'CNY',
                'symbol' => '¥',
            ),
            25 => 
            array (
                'id' => 26,
                'code' => 'COP',
                'symbol' => '$',
            ),
            26 => 
            array (
                'id' => 27,
                'code' => 'CRC',
                'symbol' => '?',
            ),
            27 => 
            array (
                'id' => 28,
                'code' => 'HRK',
                'symbol' => 'kn',
            ),
            28 => 
            array (
                'id' => 29,
                'code' => 'CUP',
                'symbol' => '?',
            ),
            29 => 
            array (
                'id' => 30,
                'code' => 'EUR',
                'symbol' => '€',
            ),
            30 => 
            array (
                'id' => 31,
                'code' => 'CZK',
                'symbol' => 'K?',
            ),
            31 => 
            array (
                'id' => 32,
                'code' => 'DKK',
                'symbol' => 'kr',
            ),
            32 => 
            array (
                'id' => 33,
                'code' => 'DOP ',
                'symbol' => 'RD$',
            ),
            33 => 
            array (
                'id' => 34,
                'code' => 'XCD',
                'symbol' => '$',
            ),
            34 => 
            array (
                'id' => 35,
                'code' => 'EGP',
                'symbol' => '£',
            ),
            35 => 
            array (
                'id' => 36,
                'code' => 'SVC',
                'symbol' => '$',
            ),
            36 => 
            array (
                'id' => 37,
                'code' => 'GBP',
                'symbol' => '£',
            ),
            37 => 
            array (
                'id' => 38,
                'code' => 'EUR',
                'symbol' => '€',
            ),
            38 => 
            array (
                'id' => 39,
                'code' => 'FKP',
                'symbol' => '£',
            ),
            39 => 
            array (
                'id' => 40,
                'code' => 'FJD',
                'symbol' => '$',
            ),
            40 => 
            array (
                'id' => 41,
                'code' => 'EUR',
                'symbol' => '€',
            ),
            41 => 
            array (
                'id' => 42,
                'code' => 'GHC',
                'symbol' => '¢',
            ),
            42 => 
            array (
                'id' => 43,
                'code' => 'GIP',
                'symbol' => '£',
            ),
            43 => 
            array (
                'id' => 44,
                'code' => 'EUR',
                'symbol' => '€',
            ),
            44 => 
            array (
                'id' => 45,
                'code' => 'GTQ',
                'symbol' => 'Q',
            ),
            45 => 
            array (
                'id' => 46,
                'code' => 'GGP',
                'symbol' => '£',
            ),
            46 => 
            array (
                'id' => 47,
                'code' => 'GYD',
                'symbol' => '$',
            ),
            47 => 
            array (
                'id' => 48,
                'code' => 'EUR',
                'symbol' => '€',
            ),
            48 => 
            array (
                'id' => 49,
                'code' => 'HNL',
                'symbol' => 'L',
            ),
            49 => 
            array (
                'id' => 50,
                'code' => 'IDR',
                'symbol' => 'Rp',
            ),
        ));
        
        
    }
}