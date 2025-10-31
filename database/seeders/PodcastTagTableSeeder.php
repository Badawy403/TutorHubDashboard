<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PodcastTagTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('podcast_tag')->delete();
        
        \DB::table('podcast_tag')->insert(array (
            0 => 
            array (
                'id' => 24,
                'podcast_id' => 16,
                'tag_id' => 3,
            ),
            1 => 
            array (
                'id' => 25,
                'podcast_id' => 16,
                'tag_id' => 1,
            ),
            2 => 
            array (
                'id' => 26,
                'podcast_id' => 16,
                'tag_id' => 5,
            ),
            3 => 
            array (
                'id' => 27,
                'podcast_id' => 17,
                'tag_id' => 3,
            ),
            4 => 
            array (
                'id' => 28,
                'podcast_id' => 17,
                'tag_id' => 1,
            ),
            5 => 
            array (
                'id' => 29,
                'podcast_id' => 17,
                'tag_id' => 6,
            ),
            6 => 
            array (
                'id' => 30,
                'podcast_id' => 17,
                'tag_id' => 4,
            ),
            7 => 
            array (
                'id' => 31,
                'podcast_id' => 18,
                'tag_id' => 1,
            ),
            8 => 
            array (
                'id' => 32,
                'podcast_id' => 18,
                'tag_id' => 3,
            ),
            9 => 
            array (
                'id' => 33,
                'podcast_id' => 18,
                'tag_id' => 5,
            ),
            10 => 
            array (
                'id' => 34,
                'podcast_id' => 18,
                'tag_id' => 6,
            ),
            11 => 
            array (
                'id' => 35,
                'podcast_id' => 19,
                'tag_id' => 3,
            ),
            12 => 
            array (
                'id' => 36,
                'podcast_id' => 19,
                'tag_id' => 1,
            ),
            13 => 
            array (
                'id' => 37,
                'podcast_id' => 19,
                'tag_id' => 5,
            ),
            14 => 
            array (
                'id' => 38,
                'podcast_id' => 19,
                'tag_id' => 4,
            ),
            15 => 
            array (
                'id' => 39,
                'podcast_id' => 144,
                'tag_id' => 1,
            ),
            16 => 
            array (
                'id' => 40,
                'podcast_id' => 144,
                'tag_id' => 4,
            ),
            17 => 
            array (
                'id' => 41,
                'podcast_id' => 144,
                'tag_id' => 5,
            ),
            18 => 
            array (
                'id' => 42,
                'podcast_id' => 144,
                'tag_id' => 3,
            ),
            19 => 
            array (
                'id' => 43,
                'podcast_id' => 144,
                'tag_id' => 6,
            ),
            20 => 
            array (
                'id' => 44,
                'podcast_id' => 145,
                'tag_id' => 3,
            ),
            21 => 
            array (
                'id' => 45,
                'podcast_id' => 145,
                'tag_id' => 1,
            ),
            22 => 
            array (
                'id' => 46,
                'podcast_id' => 145,
                'tag_id' => 5,
            ),
            23 => 
            array (
                'id' => 47,
                'podcast_id' => 145,
                'tag_id' => 4,
            ),
            24 => 
            array (
                'id' => 48,
                'podcast_id' => 145,
                'tag_id' => 6,
            ),
            25 => 
            array (
                'id' => 49,
                'podcast_id' => 146,
                'tag_id' => 1,
            ),
            26 => 
            array (
                'id' => 50,
                'podcast_id' => 146,
                'tag_id' => 3,
            ),
            27 => 
            array (
                'id' => 51,
                'podcast_id' => 146,
                'tag_id' => 4,
            ),
            28 => 
            array (
                'id' => 52,
                'podcast_id' => 146,
                'tag_id' => 5,
            ),
            29 => 
            array (
                'id' => 53,
                'podcast_id' => 146,
                'tag_id' => 6,
            ),
            30 => 
            array (
                'id' => 54,
                'podcast_id' => 147,
                'tag_id' => 3,
            ),
            31 => 
            array (
                'id' => 55,
                'podcast_id' => 147,
                'tag_id' => 1,
            ),
            32 => 
            array (
                'id' => 56,
                'podcast_id' => 147,
                'tag_id' => 5,
            ),
            33 => 
            array (
                'id' => 57,
                'podcast_id' => 147,
                'tag_id' => 4,
            ),
            34 => 
            array (
                'id' => 60,
                'podcast_id' => 150,
                'tag_id' => 1,
            ),
            35 => 
            array (
                'id' => 61,
                'podcast_id' => 151,
                'tag_id' => 1,
            ),
            36 => 
            array (
                'id' => 65,
                'podcast_id' => 155,
                'tag_id' => 3,
            ),
            37 => 
            array (
                'id' => 66,
                'podcast_id' => 156,
                'tag_id' => 1,
            ),
            38 => 
            array (
                'id' => 67,
                'podcast_id' => 157,
                'tag_id' => 1,
            ),
            39 => 
            array (
                'id' => 69,
                'podcast_id' => 159,
                'tag_id' => 3,
            ),
            40 => 
            array (
                'id' => 70,
                'podcast_id' => 160,
                'tag_id' => 3,
            ),
            41 => 
            array (
                'id' => 71,
                'podcast_id' => 161,
                'tag_id' => 3,
            ),
            42 => 
            array (
                'id' => 72,
                'podcast_id' => 162,
                'tag_id' => 3,
            ),
            43 => 
            array (
                'id' => 73,
                'podcast_id' => 163,
                'tag_id' => 3,
            ),
            44 => 
            array (
                'id' => 74,
                'podcast_id' => 164,
                'tag_id' => 3,
            ),
            45 => 
            array (
                'id' => 75,
                'podcast_id' => 165,
                'tag_id' => 1,
            ),
            46 => 
            array (
                'id' => 76,
                'podcast_id' => 166,
                'tag_id' => 1,
            ),
            47 => 
            array (
                'id' => 77,
                'podcast_id' => 167,
                'tag_id' => 1,
            ),
            48 => 
            array (
                'id' => 78,
                'podcast_id' => 168,
                'tag_id' => 1,
            ),
            49 => 
            array (
                'id' => 79,
                'podcast_id' => 169,
                'tag_id' => 6,
            ),
            50 => 
            array (
                'id' => 80,
                'podcast_id' => 170,
                'tag_id' => 6,
            ),
            51 => 
            array (
                'id' => 81,
                'podcast_id' => 171,
                'tag_id' => 6,
            ),
            52 => 
            array (
                'id' => 82,
                'podcast_id' => 172,
                'tag_id' => 6,
            ),
            53 => 
            array (
                'id' => 83,
                'podcast_id' => 173,
                'tag_id' => 4,
            ),
            54 => 
            array (
                'id' => 84,
                'podcast_id' => 174,
                'tag_id' => 4,
            ),
            55 => 
            array (
                'id' => 85,
                'podcast_id' => 175,
                'tag_id' => 4,
            ),
            56 => 
            array (
                'id' => 87,
                'podcast_id' => 177,
                'tag_id' => 1,
            ),
            57 => 
            array (
                'id' => 88,
                'podcast_id' => 178,
                'tag_id' => 1,
            ),
            58 => 
            array (
                'id' => 89,
                'podcast_id' => 179,
                'tag_id' => 3,
            ),
            59 => 
            array (
                'id' => 90,
                'podcast_id' => 180,
                'tag_id' => 3,
            ),
            60 => 
            array (
                'id' => 91,
                'podcast_id' => 181,
                'tag_id' => 1,
            ),
            61 => 
            array (
                'id' => 92,
                'podcast_id' => 182,
                'tag_id' => 1,
            ),
            62 => 
            array (
                'id' => 93,
                'podcast_id' => 183,
                'tag_id' => 1,
            ),
            63 => 
            array (
                'id' => 94,
                'podcast_id' => 184,
                'tag_id' => 1,
            ),
            64 => 
            array (
                'id' => 95,
                'podcast_id' => 185,
                'tag_id' => 6,
            ),
            65 => 
            array (
                'id' => 96,
                'podcast_id' => 186,
                'tag_id' => 1,
            ),
            66 => 
            array (
                'id' => 97,
                'podcast_id' => 187,
                'tag_id' => 1,
            ),
            67 => 
            array (
                'id' => 98,
                'podcast_id' => 188,
                'tag_id' => 1,
            ),
            68 => 
            array (
                'id' => 101,
                'podcast_id' => 191,
                'tag_id' => 3,
            ),
            69 => 
            array (
                'id' => 102,
                'podcast_id' => 192,
                'tag_id' => 4,
            ),
            70 => 
            array (
                'id' => 116,
                'podcast_id' => 206,
                'tag_id' => 4,
            ),
            71 => 
            array (
                'id' => 117,
                'podcast_id' => 207,
                'tag_id' => 6,
            ),
            72 => 
            array (
                'id' => 151,
                'podcast_id' => 241,
                'tag_id' => 1,
            ),
            73 => 
            array (
                'id' => 152,
                'podcast_id' => 242,
                'tag_id' => 1,
            ),
            74 => 
            array (
                'id' => 153,
                'podcast_id' => 243,
                'tag_id' => 1,
            ),
        ));
        
        
    }
}