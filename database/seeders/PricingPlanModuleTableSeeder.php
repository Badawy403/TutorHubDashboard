<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PricingPlanModuleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pricing_plan_module')->delete();
        
        \DB::table('pricing_plan_module')->insert(array (
            0 => 
            array (
                'id' => 43,
                'module_code' => 'teacher-list-services',
                'pricing_plan_id' => 45,
            ),
            1 => 
            array (
                'id' => 44,
                'module_code' => 'teacher-basic-profile',
                'pricing_plan_id' => 45,
            ),
            2 => 
            array (
                'id' => 45,
                'module_code' => 'teacher-social-info',
                'pricing_plan_id' => 45,
            ),
            3 => 
            array (
                'id' => 46,
                'module_code' => 'teacher-profile-display',
                'pricing_plan_id' => 45,
            ),
            4 => 
            array (
                'id' => 47,
                'module_code' => 'teacher-calendly-integration',
                'pricing_plan_id' => 45,
            ),
            5 => 
            array (
                'id' => 48,
                'module_code' => 'teacher-events',
                'pricing_plan_id' => 45,
            ),
            6 => 
            array (
                'id' => 49,
                'module_code' => 'teacher-broadcasts',
                'pricing_plan_id' => 45,
            ),
            7 => 
            array (
                'id' => 50,
                'module_code' => 'teacher-blogs',
                'pricing_plan_id' => 45,
            ),
            8 => 
            array (
                'id' => 51,
                'module_code' => 'teacher-archives',
                'pricing_plan_id' => 45,
            ),
            9 => 
            array (
                'id' => 52,
                'module_code' => 'teacher-podcasts',
                'pricing_plan_id' => 45,
            ),
            10 => 
            array (
                'id' => 53,
                'module_code' => 'academy-list-services',
                'pricing_plan_id' => 48,
            ),
            11 => 
            array (
                'id' => 54,
                'module_code' => 'academy-basic-profile',
                'pricing_plan_id' => 48,
            ),
            12 => 
            array (
                'id' => 55,
                'module_code' => 'academy-social-info',
                'pricing_plan_id' => 48,
            ),
            13 => 
            array (
                'id' => 56,
                'module_code' => 'academy-profile-display',
                'pricing_plan_id' => 48,
            ),
            14 => 
            array (
                'id' => 57,
                'module_code' => 'academy-calendly-integration',
                'pricing_plan_id' => 48,
            ),
            15 => 
            array (
                'id' => 58,
                'module_code' => 'academy-events',
                'pricing_plan_id' => 48,
            ),
            16 => 
            array (
                'id' => 59,
                'module_code' => 'academy-broadcasts',
                'pricing_plan_id' => 48,
            ),
            17 => 
            array (
                'id' => 60,
                'module_code' => 'academy-blogs',
                'pricing_plan_id' => 48,
            ),
            18 => 
            array (
                'id' => 61,
                'module_code' => 'academy-archives',
                'pricing_plan_id' => 48,
            ),
            19 => 
            array (
                'id' => 62,
                'module_code' => 'academy-podcasts',
                'pricing_plan_id' => 48,
            ),
            20 => 
            array (
                'id' => 120,
                'module_code' => 'academy-list-services',
                'pricing_plan_id' => 2,
            ),
            21 => 
            array (
                'id' => 121,
                'module_code' => 'academy-basic-profile',
                'pricing_plan_id' => 2,
            ),
            22 => 
            array (
                'id' => 122,
                'module_code' => 'academy-social-info',
                'pricing_plan_id' => 2,
            ),
            23 => 
            array (
                'id' => 123,
                'module_code' => 'academy-profile-display',
                'pricing_plan_id' => 2,
            ),
            24 => 
            array (
                'id' => 124,
                'module_code' => 'academy-calendly-integration',
                'pricing_plan_id' => 2,
            ),
            25 => 
            array (
                'id' => 125,
                'module_code' => 'academy-events',
                'pricing_plan_id' => 2,
            ),
            26 => 
            array (
                'id' => 126,
                'module_code' => 'academy-broadcasts',
                'pricing_plan_id' => 2,
            ),
            27 => 
            array (
                'id' => 127,
                'module_code' => 'academy-blogs',
                'pricing_plan_id' => 2,
            ),
            28 => 
            array (
                'id' => 128,
                'module_code' => 'academy-archives',
                'pricing_plan_id' => 2,
            ),
            29 => 
            array (
                'id' => 129,
                'module_code' => 'academy-podcasts',
                'pricing_plan_id' => 2,
            ),
            30 => 
            array (
                'id' => 130,
                'module_code' => 'academy-certifications',
                'pricing_plan_id' => 2,
            ),
            31 => 
            array (
                'id' => 131,
                'module_code' => 'academy-appointment',
                'pricing_plan_id' => 2,
            ),
            32 => 
            array (
                'id' => 180,
                'module_code' => 'teacher-list-services',
                'pricing_plan_id' => 55,
            ),
            33 => 
            array (
                'id' => 181,
                'module_code' => 'teacher-basic-profile',
                'pricing_plan_id' => 55,
            ),
            34 => 
            array (
                'id' => 182,
                'module_code' => 'teacher-social-info',
                'pricing_plan_id' => 55,
            ),
            35 => 
            array (
                'id' => 183,
                'module_code' => 'teacher-profile-display',
                'pricing_plan_id' => 55,
            ),
            36 => 
            array (
                'id' => 184,
                'module_code' => 'teacher-calendly',
                'pricing_plan_id' => 55,
            ),
            37 => 
            array (
                'id' => 185,
                'module_code' => 'teacher-events',
                'pricing_plan_id' => 55,
            ),
            38 => 
            array (
                'id' => 186,
                'module_code' => 'teacher-broadcasts',
                'pricing_plan_id' => 55,
            ),
            39 => 
            array (
                'id' => 187,
                'module_code' => 'teacher-blogs',
                'pricing_plan_id' => 55,
            ),
            40 => 
            array (
                'id' => 188,
                'module_code' => 'teacher-archives',
                'pricing_plan_id' => 55,
            ),
            41 => 
            array (
                'id' => 189,
                'module_code' => 'teacher-podcasts',
                'pricing_plan_id' => 55,
            ),
            42 => 
            array (
                'id' => 190,
                'module_code' => 'teacher-certifications',
                'pricing_plan_id' => 55,
            ),
            43 => 
            array (
                'id' => 191,
                'module_code' => 'teacher-appointment',
                'pricing_plan_id' => 55,
            ),
            44 => 
            array (
                'id' => 192,
                'module_code' => 'teacher-list-services',
                'pricing_plan_id' => 56,
            ),
            45 => 
            array (
                'id' => 193,
                'module_code' => 'teacher-basic-profile',
                'pricing_plan_id' => 56,
            ),
            46 => 
            array (
                'id' => 194,
                'module_code' => 'teacher-social-info',
                'pricing_plan_id' => 56,
            ),
            47 => 
            array (
                'id' => 195,
                'module_code' => 'teacher-profile-display',
                'pricing_plan_id' => 56,
            ),
            48 => 
            array (
                'id' => 196,
                'module_code' => 'teacher-calendly',
                'pricing_plan_id' => 56,
            ),
            49 => 
            array (
                'id' => 197,
                'module_code' => 'teacher-events',
                'pricing_plan_id' => 56,
            ),
            50 => 
            array (
                'id' => 198,
                'module_code' => 'teacher-broadcasts',
                'pricing_plan_id' => 56,
            ),
            51 => 
            array (
                'id' => 199,
                'module_code' => 'teacher-blogs',
                'pricing_plan_id' => 56,
            ),
            52 => 
            array (
                'id' => 200,
                'module_code' => 'teacher-archives',
                'pricing_plan_id' => 56,
            ),
            53 => 
            array (
                'id' => 201,
                'module_code' => 'teacher-podcasts',
                'pricing_plan_id' => 56,
            ),
            54 => 
            array (
                'id' => 202,
                'module_code' => 'teacher-certifications',
                'pricing_plan_id' => 56,
            ),
            55 => 
            array (
                'id' => 203,
                'module_code' => 'teacher-appointment',
                'pricing_plan_id' => 56,
            ),
            56 => 
            array (
                'id' => 216,
                'module_code' => 'teacher-list-services',
                'pricing_plan_id' => 53,
            ),
            57 => 
            array (
                'id' => 217,
                'module_code' => 'teacher-basic-profile',
                'pricing_plan_id' => 53,
            ),
            58 => 
            array (
                'id' => 218,
                'module_code' => 'teacher-social-info',
                'pricing_plan_id' => 53,
            ),
            59 => 
            array (
                'id' => 219,
                'module_code' => 'teacher-profile-display',
                'pricing_plan_id' => 53,
            ),
            60 => 
            array (
                'id' => 220,
                'module_code' => 'teacher-calendly',
                'pricing_plan_id' => 53,
            ),
            61 => 
            array (
                'id' => 221,
                'module_code' => 'teacher-events',
                'pricing_plan_id' => 53,
            ),
            62 => 
            array (
                'id' => 222,
                'module_code' => 'teacher-broadcasts',
                'pricing_plan_id' => 53,
            ),
            63 => 
            array (
                'id' => 223,
                'module_code' => 'teacher-blogs',
                'pricing_plan_id' => 53,
            ),
            64 => 
            array (
                'id' => 224,
                'module_code' => 'teacher-archives',
                'pricing_plan_id' => 53,
            ),
            65 => 
            array (
                'id' => 225,
                'module_code' => 'teacher-podcasts',
                'pricing_plan_id' => 53,
            ),
            66 => 
            array (
                'id' => 226,
                'module_code' => 'teacher-certifications',
                'pricing_plan_id' => 53,
            ),
            67 => 
            array (
                'id' => 227,
                'module_code' => 'teacher-appointment',
                'pricing_plan_id' => 53,
            ),
            68 => 
            array (
                'id' => 276,
                'module_code' => 'teacher-list-services',
                'pricing_plan_id' => 51,
            ),
            69 => 
            array (
                'id' => 277,
                'module_code' => 'teacher-basic-profile',
                'pricing_plan_id' => 51,
            ),
            70 => 
            array (
                'id' => 278,
                'module_code' => 'teacher-social-info',
                'pricing_plan_id' => 51,
            ),
            71 => 
            array (
                'id' => 279,
                'module_code' => 'teacher-profile-display',
                'pricing_plan_id' => 51,
            ),
            72 => 
            array (
                'id' => 280,
                'module_code' => 'teacher-calendly',
                'pricing_plan_id' => 51,
            ),
            73 => 
            array (
                'id' => 281,
                'module_code' => 'teacher-events',
                'pricing_plan_id' => 51,
            ),
            74 => 
            array (
                'id' => 282,
                'module_code' => 'teacher-broadcasts',
                'pricing_plan_id' => 51,
            ),
            75 => 
            array (
                'id' => 283,
                'module_code' => 'teacher-blogs',
                'pricing_plan_id' => 51,
            ),
            76 => 
            array (
                'id' => 284,
                'module_code' => 'teacher-archives',
                'pricing_plan_id' => 51,
            ),
            77 => 
            array (
                'id' => 285,
                'module_code' => 'teacher-podcasts',
                'pricing_plan_id' => 51,
            ),
            78 => 
            array (
                'id' => 286,
                'module_code' => 'teacher-certifications',
                'pricing_plan_id' => 51,
            ),
            79 => 
            array (
                'id' => 287,
                'module_code' => 'teacher-appointment',
                'pricing_plan_id' => 51,
            ),
            80 => 
            array (
                'id' => 288,
                'module_code' => 'teacher-list-services',
                'pricing_plan_id' => 1,
            ),
            81 => 
            array (
                'id' => 289,
                'module_code' => 'teacher-basic-profile',
                'pricing_plan_id' => 1,
            ),
            82 => 
            array (
                'id' => 290,
                'module_code' => 'teacher-social-info',
                'pricing_plan_id' => 1,
            ),
            83 => 
            array (
                'id' => 291,
                'module_code' => 'teacher-profile-display',
                'pricing_plan_id' => 1,
            ),
            84 => 
            array (
                'id' => 292,
                'module_code' => 'teacher-calendly',
                'pricing_plan_id' => 1,
            ),
            85 => 
            array (
                'id' => 293,
                'module_code' => 'teacher-events',
                'pricing_plan_id' => 1,
            ),
            86 => 
            array (
                'id' => 294,
                'module_code' => 'teacher-broadcasts',
                'pricing_plan_id' => 1,
            ),
            87 => 
            array (
                'id' => 295,
                'module_code' => 'teacher-blogs',
                'pricing_plan_id' => 1,
            ),
            88 => 
            array (
                'id' => 296,
                'module_code' => 'teacher-archives',
                'pricing_plan_id' => 1,
            ),
            89 => 
            array (
                'id' => 297,
                'module_code' => 'teacher-podcasts',
                'pricing_plan_id' => 1,
            ),
            90 => 
            array (
                'id' => 298,
                'module_code' => 'teacher-certifications',
                'pricing_plan_id' => 1,
            ),
            91 => 
            array (
                'id' => 299,
                'module_code' => 'teacher-appointment',
                'pricing_plan_id' => 1,
            ),
        ));
        
        
    }
}