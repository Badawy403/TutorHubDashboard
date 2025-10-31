<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_role')->delete();
        
        \DB::table('user_role')->insert(array (
            0 => 
            array (
                'id' => 1915,
                'role_code' => 'super_admin',
                'user_id' => 1,
            ),
            1 => 
            array (
                'id' => 1925,
                'role_code' => 'teacher',
                'user_id' => 258,
            ),
            2 => 
            array (
                'id' => 1926,
                'role_code' => 'teacher',
                'user_id' => 259,
            ),
            3 => 
            array (
                'id' => 1927,
                'role_code' => 'teacher',
                'user_id' => 260,
            ),
            4 => 
            array (
                'id' => 1928,
                'role_code' => 'teacher',
                'user_id' => 261,
            ),
            5 => 
            array (
                'id' => 1929,
                'role_code' => 'student',
                'user_id' => 262,
            ),
            6 => 
            array (
                'id' => 1930,
                'role_code' => 'teacher',
                'user_id' => 263,
            ),
            7 => 
            array (
                'id' => 1931,
                'role_code' => 'student',
                'user_id' => 264,
            ),
            8 => 
            array (
                'id' => 1932,
                'role_code' => 'student',
                'user_id' => 265,
            ),
            9 => 
            array (
                'id' => 1933,
                'role_code' => 'teacher',
                'user_id' => 266,
            ),
            10 => 
            array (
                'id' => 1934,
                'role_code' => 'student',
                'user_id' => 248,
            ),
            11 => 
            array (
                'id' => 1935,
                'role_code' => 'student',
                'user_id' => 267,
            ),
            12 => 
            array (
                'id' => 1936,
                'role_code' => 'teacher',
                'user_id' => 267,
            ),
            13 => 
            array (
                'id' => 1937,
                'role_code' => 'academy',
                'user_id' => 268,
            ),
            14 => 
            array (
                'id' => 1938,
                'role_code' => 'academy',
                'user_id' => 269,
            ),
            15 => 
            array (
                'id' => 1939,
                'role_code' => 'teacher',
                'user_id' => 269,
            ),
            16 => 
            array (
                'id' => 1940,
                'role_code' => 'student',
                'user_id' => 269,
            ),
            17 => 
            array (
                'id' => 1941,
                'role_code' => 'academy',
                'user_id' => 270,
            ),
            18 => 
            array (
                'id' => 1942,
                'role_code' => 'academy',
                'user_id' => 271,
            ),
            19 => 
            array (
                'id' => 1943,
                'role_code' => 'academy',
                'user_id' => 272,
            ),
            20 => 
            array (
                'id' => 1944,
                'role_code' => 'academy',
                'user_id' => 273,
            ),
            21 => 
            array (
                'id' => 1945,
                'role_code' => 'teacher',
                'user_id' => 274,
            ),
            22 => 
            array (
                'id' => 1946,
                'role_code' => 'academy',
                'user_id' => 275,
            ),
            23 => 
            array (
                'id' => 1947,
                'role_code' => 'student',
                'user_id' => 276,
            ),
            24 => 
            array (
                'id' => 1948,
                'role_code' => 'teacher',
                'user_id' => 276,
            ),
            25 => 
            array (
                'id' => 1949,
                'role_code' => 'student',
                'user_id' => 277,
            ),
            26 => 
            array (
                'id' => 1950,
                'role_code' => 'student',
                'user_id' => 278,
            ),
            27 => 
            array (
                'id' => 1951,
                'role_code' => 'student',
                'user_id' => 279,
            ),
            28 => 
            array (
                'id' => 1952,
                'role_code' => 'academy',
                'user_id' => 280,
            ),
            29 => 
            array (
                'id' => 1953,
                'role_code' => 'student',
                'user_id' => 281,
            ),
            30 => 
            array (
                'id' => 1954,
                'role_code' => 'student',
                'user_id' => 282,
            ),
            31 => 
            array (
                'id' => 1955,
                'role_code' => 'academy',
                'user_id' => 283,
            ),
            32 => 
            array (
                'id' => 1956,
                'role_code' => 'student',
                'user_id' => 284,
            ),
            33 => 
            array (
                'id' => 1957,
                'role_code' => 'teacher',
                'user_id' => 284,
            ),
            34 => 
            array (
                'id' => 1958,
                'role_code' => 'teacher',
                'user_id' => 285,
            ),
            35 => 
            array (
                'id' => 1959,
                'role_code' => 'teacher',
                'user_id' => 286,
            ),
            36 => 
            array (
                'id' => 1960,
                'role_code' => 'teacher',
                'user_id' => 287,
            ),
            37 => 
            array (
                'id' => 1961,
                'role_code' => 'teacher',
                'user_id' => 288,
            ),
            38 => 
            array (
                'id' => 1962,
                'role_code' => 'student',
                'user_id' => 289,
            ),
            39 => 
            array (
                'id' => 1963,
                'role_code' => 'academy',
                'user_id' => 290,
            ),
            40 => 
            array (
                'id' => 1964,
                'role_code' => 'academy',
                'user_id' => 289,
            ),
            41 => 
            array (
                'id' => 1965,
                'role_code' => 'teacher',
                'user_id' => 289,
            ),
            42 => 
            array (
                'id' => 1966,
                'role_code' => 'student',
                'user_id' => 291,
            ),
            43 => 
            array (
                'id' => 1967,
                'role_code' => 'academy',
                'user_id' => 291,
            ),
            44 => 
            array (
                'id' => 1968,
                'role_code' => 'teacher',
                'user_id' => 292,
            ),
            45 => 
            array (
                'id' => 1969,
                'role_code' => 'academy',
                'user_id' => 292,
            ),
            46 => 
            array (
                'id' => 1970,
                'role_code' => 'student',
                'user_id' => 292,
            ),
            47 => 
            array (
                'id' => 1971,
                'role_code' => 'teacher',
                'user_id' => 293,
            ),
            48 => 
            array (
                'id' => 1972,
                'role_code' => 'student',
                'user_id' => 293,
            ),
            49 => 
            array (
                'id' => 1973,
                'role_code' => 'student',
                'user_id' => 259,
            ),
            50 => 
            array (
                'id' => 1974,
                'role_code' => 'academy',
                'user_id' => 259,
            ),
            51 => 
            array (
                'id' => 1975,
                'role_code' => 'student',
                'user_id' => 274,
            ),
            52 => 
            array (
                'id' => 1976,
                'role_code' => 'teacher',
                'user_id' => 294,
            ),
            53 => 
            array (
                'id' => 1977,
                'role_code' => 'academy',
                'user_id' => 294,
            ),
            54 => 
            array (
                'id' => 1978,
                'role_code' => 'academy',
                'user_id' => 295,
            ),
            55 => 
            array (
                'id' => 1979,
                'role_code' => 'teacher',
                'user_id' => 295,
            ),
            56 => 
            array (
                'id' => 1980,
                'role_code' => 'teacher',
                'user_id' => 296,
            ),
            57 => 
            array (
                'id' => 1981,
                'role_code' => 'teacher',
                'user_id' => 265,
            ),
            58 => 
            array (
                'id' => 1982,
                'role_code' => 'teacher',
                'user_id' => 297,
            ),
            59 => 
            array (
                'id' => 1983,
                'role_code' => 'student',
                'user_id' => 298,
            ),
            60 => 
            array (
                'id' => 1984,
                'role_code' => 'student',
                'user_id' => 299,
            ),
            61 => 
            array (
                'id' => 1985,
                'role_code' => 'student',
                'user_id' => 300,
            ),
            62 => 
            array (
                'id' => 1986,
                'role_code' => 'student',
                'user_id' => 301,
            ),
            63 => 
            array (
                'id' => 1987,
                'role_code' => 'student',
                'user_id' => 302,
            ),
            64 => 
            array (
                'id' => 1988,
                'role_code' => 'student',
                'user_id' => 303,
            ),
            65 => 
            array (
                'id' => 1989,
                'role_code' => 'student',
                'user_id' => 304,
            ),
            66 => 
            array (
                'id' => 1990,
                'role_code' => 'student',
                'user_id' => 305,
            ),
            67 => 
            array (
                'id' => 1991,
                'role_code' => 'teacher',
                'user_id' => 306,
            ),
            68 => 
            array (
                'id' => 1992,
                'role_code' => 'teacher',
                'user_id' => 307,
            ),
            69 => 
            array (
                'id' => 1994,
                'role_code' => 'teacher',
                'user_id' => 2,
            ),
            70 => 
            array (
                'id' => 1995,
                'role_code' => 'teacher',
                'user_id' => 3,
            ),
            71 => 
            array (
                'id' => 1997,
                'role_code' => 'teacher',
                'user_id' => 5,
            ),
            72 => 
            array (
                'id' => 1998,
                'role_code' => 'teacher',
                'user_id' => 6,
            ),
            73 => 
            array (
                'id' => 1999,
                'role_code' => 'teacher',
                'user_id' => 7,
            ),
            74 => 
            array (
                'id' => 2000,
                'role_code' => 'teacher',
                'user_id' => 8,
            ),
            75 => 
            array (
                'id' => 2001,
                'role_code' => 'teacher',
                'user_id' => 9,
            ),
            76 => 
            array (
                'id' => 2002,
                'role_code' => 'teacher',
                'user_id' => 6,
            ),
            77 => 
            array (
                'id' => 2003,
                'role_code' => 'teacher',
                'user_id' => 10,
            ),
            78 => 
            array (
                'id' => 2004,
                'role_code' => 'teacher',
                'user_id' => 11,
            ),
            79 => 
            array (
                'id' => 2005,
                'role_code' => 'teacher',
                'user_id' => 12,
            ),
            80 => 
            array (
                'id' => 2006,
                'role_code' => 'teacher',
                'user_id' => 13,
            ),
            81 => 
            array (
                'id' => 2007,
                'role_code' => 'teacher',
                'user_id' => 14,
            ),
            82 => 
            array (
                'id' => 2008,
                'role_code' => 'teacher',
                'user_id' => 15,
            ),
            83 => 
            array (
                'id' => 2009,
                'role_code' => 'teacher',
                'user_id' => 16,
            ),
            84 => 
            array (
                'id' => 2010,
                'role_code' => 'teacher',
                'user_id' => 17,
            ),
            85 => 
            array (
                'id' => 2011,
                'role_code' => 'academy',
                'user_id' => 17,
            ),
            86 => 
            array (
                'id' => 2013,
                'role_code' => 'teacher',
                'user_id' => 18,
            ),
            87 => 
            array (
                'id' => 2014,
                'role_code' => 'teacher',
                'user_id' => 18,
            ),
            88 => 
            array (
                'id' => 2018,
                'role_code' => 'teacher',
                'user_id' => 19,
            ),
            89 => 
            array (
                'id' => 2019,
                'role_code' => 'academy',
                'user_id' => 19,
            ),
            90 => 
            array (
                'id' => 2021,
                'role_code' => 'teacher',
                'user_id' => 21,
            ),
            91 => 
            array (
                'id' => 2023,
                'role_code' => 'academy',
                'user_id' => 23,
            ),
            92 => 
            array (
                'id' => 2024,
                'role_code' => 'academy',
                'user_id' => 24,
            ),
            93 => 
            array (
                'id' => 2025,
                'role_code' => 'teacher',
                'user_id' => 24,
            ),
            94 => 
            array (
                'id' => 2026,
                'role_code' => 'academy',
                'user_id' => 25,
            ),
            95 => 
            array (
                'id' => 2027,
                'role_code' => 'teacher',
                'user_id' => 26,
            ),
            96 => 
            array (
                'id' => 2028,
                'role_code' => 'academy',
                'user_id' => 27,
            ),
            97 => 
            array (
                'id' => 2029,
                'role_code' => 'teacher',
                'user_id' => 28,
            ),
            98 => 
            array (
                'id' => 2030,
                'role_code' => 'teacher',
                'user_id' => 29,
            ),
            99 => 
            array (
                'id' => 2031,
                'role_code' => 'teacher',
                'user_id' => 30,
            ),
        ));
        \DB::table('user_role')->insert(array (
            0 => 
            array (
                'id' => 2032,
                'role_code' => 'teacher',
                'user_id' => 31,
            ),
            1 => 
            array (
                'id' => 2033,
                'role_code' => 'teacher',
                'user_id' => 32,
            ),
            2 => 
            array (
                'id' => 2034,
                'role_code' => 'teacher',
                'user_id' => 33,
            ),
            3 => 
            array (
                'id' => 2035,
                'role_code' => 'teacher',
                'user_id' => 34,
            ),
            4 => 
            array (
                'id' => 2036,
                'role_code' => 'teacher',
                'user_id' => 35,
            ),
            5 => 
            array (
                'id' => 2037,
                'role_code' => 'teacher',
                'user_id' => 36,
            ),
            6 => 
            array (
                'id' => 2038,
                'role_code' => 'teacher',
                'user_id' => 37,
            ),
            7 => 
            array (
                'id' => 2039,
                'role_code' => 'academy',
                'user_id' => 36,
            ),
            8 => 
            array (
                'id' => 2040,
                'role_code' => 'teacher',
                'user_id' => 4,
            ),
            9 => 
            array (
                'id' => 2041,
                'role_code' => 'academy',
                'user_id' => 4,
            ),
            10 => 
            array (
                'id' => 2042,
                'role_code' => 'teacher',
                'user_id' => 38,
            ),
            11 => 
            array (
                'id' => 2043,
                'role_code' => 'teacher',
                'user_id' => 39,
            ),
            12 => 
            array (
                'id' => 2045,
                'role_code' => 'teacher',
                'user_id' => 41,
            ),
            13 => 
            array (
                'id' => 2048,
                'role_code' => 'teacher',
                'user_id' => 43,
            ),
            14 => 
            array (
                'id' => 2049,
                'role_code' => 'academy',
                'user_id' => 25,
            ),
            15 => 
            array (
                'id' => 2050,
                'role_code' => 'teacher',
                'user_id' => 44,
            ),
            16 => 
            array (
                'id' => 2051,
                'role_code' => 'student',
                'user_id' => 45,
            ),
            17 => 
            array (
                'id' => 2052,
                'role_code' => 'teacher',
                'user_id' => 46,
            ),
            18 => 
            array (
                'id' => 2053,
                'role_code' => 'academy',
                'user_id' => 46,
            ),
            19 => 
            array (
                'id' => 2054,
                'role_code' => 'student',
                'user_id' => 46,
            ),
            20 => 
            array (
                'id' => 2055,
                'role_code' => 'teacher',
                'user_id' => 47,
            ),
            21 => 
            array (
                'id' => 2057,
                'role_code' => 'student',
                'user_id' => 49,
            ),
            22 => 
            array (
                'id' => 2058,
                'role_code' => 'teacher',
                'user_id' => 50,
            ),
            23 => 
            array (
                'id' => 2059,
                'role_code' => 'academy',
                'user_id' => 51,
            ),
            24 => 
            array (
                'id' => 2060,
                'role_code' => 'teacher',
                'user_id' => 52,
            ),
            25 => 
            array (
                'id' => 2061,
                'role_code' => 'teacher',
                'user_id' => 51,
            ),
            26 => 
            array (
                'id' => 2062,
                'role_code' => 'teacher',
                'user_id' => 53,
            ),
            27 => 
            array (
                'id' => 2063,
                'role_code' => 'academy',
                'user_id' => 53,
            ),
            28 => 
            array (
                'id' => 2064,
                'role_code' => 'student',
                'user_id' => 53,
            ),
            29 => 
            array (
                'id' => 2065,
                'role_code' => 'student',
                'user_id' => 54,
            ),
            30 => 
            array (
                'id' => 2067,
                'role_code' => 'teacher',
                'user_id' => 55,
            ),
            31 => 
            array (
                'id' => 2068,
                'role_code' => 'academy',
                'user_id' => 55,
            ),
            32 => 
            array (
                'id' => 2069,
                'role_code' => 'teacher',
                'user_id' => 56,
            ),
            33 => 
            array (
                'id' => 2070,
                'role_code' => 'student',
                'user_id' => 56,
            ),
            34 => 
            array (
                'id' => 2072,
                'role_code' => 'teacher',
                'user_id' => 57,
            ),
            35 => 
            array (
                'id' => 2073,
                'role_code' => 'teacher',
                'user_id' => 58,
            ),
            36 => 
            array (
                'id' => 2074,
                'role_code' => 'academy',
                'user_id' => 58,
            ),
            37 => 
            array (
                'id' => 2075,
                'role_code' => 'academy',
                'user_id' => 57,
            ),
            38 => 
            array (
                'id' => 2076,
                'role_code' => 'teacher',
                'user_id' => 59,
            ),
            39 => 
            array (
                'id' => 2077,
                'role_code' => 'teacher',
                'user_id' => 60,
            ),
            40 => 
            array (
                'id' => 2079,
                'role_code' => 'student',
                'user_id' => 61,
            ),
            41 => 
            array (
                'id' => 2080,
                'role_code' => 'teacher',
                'user_id' => 62,
            ),
            42 => 
            array (
                'id' => 2081,
                'role_code' => 'student',
                'user_id' => 63,
            ),
            43 => 
            array (
                'id' => 2082,
                'role_code' => 'teacher',
                'user_id' => 22,
            ),
            44 => 
            array (
                'id' => 2083,
                'role_code' => 'student',
                'user_id' => 64,
            ),
            45 => 
            array (
                'id' => 2084,
                'role_code' => 'academy',
                'user_id' => 65,
            ),
            46 => 
            array (
                'id' => 2085,
                'role_code' => 'teacher',
                'user_id' => 65,
            ),
            47 => 
            array (
                'id' => 2086,
                'role_code' => 'student',
                'user_id' => 65,
            ),
            48 => 
            array (
                'id' => 2087,
                'role_code' => 'student',
                'user_id' => 66,
            ),
            49 => 
            array (
                'id' => 2090,
                'role_code' => 'teacher',
                'user_id' => 69,
            ),
            50 => 
            array (
                'id' => 2092,
                'role_code' => 'teacher',
                'user_id' => 71,
            ),
            51 => 
            array (
                'id' => 2093,
                'role_code' => 'teacher',
                'user_id' => 72,
            ),
            52 => 
            array (
                'id' => 2095,
                'role_code' => 'teacher',
                'user_id' => 74,
            ),
            53 => 
            array (
                'id' => 2096,
                'role_code' => 'teacher',
                'user_id' => 75,
            ),
            54 => 
            array (
                'id' => 2097,
                'role_code' => 'student',
                'user_id' => 76,
            ),
            55 => 
            array (
                'id' => 2098,
                'role_code' => 'student',
                'user_id' => 77,
            ),
            56 => 
            array (
                'id' => 2099,
                'role_code' => 'teacher',
                'user_id' => 78,
            ),
            57 => 
            array (
                'id' => 2101,
                'role_code' => 'teacher',
                'user_id' => 80,
            ),
            58 => 
            array (
                'id' => 2102,
                'role_code' => 'teacher',
                'user_id' => 81,
            ),
            59 => 
            array (
                'id' => 2103,
                'role_code' => 'teacher',
                'user_id' => 82,
            ),
            60 => 
            array (
                'id' => 2104,
                'role_code' => 'student',
                'user_id' => 83,
            ),
            61 => 
            array (
                'id' => 2106,
                'role_code' => 'teacher',
                'user_id' => 85,
            ),
            62 => 
            array (
                'id' => 2107,
                'role_code' => 'student',
                'user_id' => 86,
            ),
            63 => 
            array (
                'id' => 2109,
                'role_code' => 'teacher',
                'user_id' => 88,
            ),
            64 => 
            array (
                'id' => 2110,
                'role_code' => 'student',
                'user_id' => 89,
            ),
            65 => 
            array (
                'id' => 2111,
                'role_code' => 'teacher',
                'user_id' => 90,
            ),
            66 => 
            array (
                'id' => 2112,
                'role_code' => 'teacher',
                'user_id' => 96,
            ),
            67 => 
            array (
                'id' => 2113,
                'role_code' => 'student',
                'user_id' => 96,
            ),
            68 => 
            array (
                'id' => 2114,
                'role_code' => 'academy',
                'user_id' => 96,
            ),
            69 => 
            array (
                'id' => 2115,
                'role_code' => 'teacher',
                'user_id' => 97,
            ),
            70 => 
            array (
                'id' => 2116,
                'role_code' => 'teacher',
                'user_id' => 98,
            ),
            71 => 
            array (
                'id' => 2117,
                'role_code' => 'teacher',
                'user_id' => 97,
            ),
            72 => 
            array (
                'id' => 2118,
                'role_code' => 'student',
                'user_id' => 99,
            ),
            73 => 
            array (
                'id' => 2119,
                'role_code' => 'teacher',
                'user_id' => 100,
            ),
            74 => 
            array (
                'id' => 2120,
                'role_code' => 'student',
                'user_id' => 101,
            ),
            75 => 
            array (
                'id' => 2121,
                'role_code' => 'student',
                'user_id' => 102,
            ),
            76 => 
            array (
                'id' => 2122,
                'role_code' => 'teacher',
                'user_id' => 102,
            ),
            77 => 
            array (
                'id' => 2123,
                'role_code' => 'academy',
                'user_id' => 102,
            ),
            78 => 
            array (
                'id' => 2124,
                'role_code' => 'student',
                'user_id' => 103,
            ),
            79 => 
            array (
                'id' => 2125,
                'role_code' => 'academy',
                'user_id' => 104,
            ),
            80 => 
            array (
                'id' => 2126,
                'role_code' => 'student',
                'user_id' => 105,
            ),
            81 => 
            array (
                'id' => 2127,
                'role_code' => 'teacher',
                'user_id' => 106,
            ),
            82 => 
            array (
                'id' => 2128,
                'role_code' => 'academy',
                'user_id' => 107,
            ),
            83 => 
            array (
                'id' => 2129,
                'role_code' => 'student',
                'user_id' => 17,
            ),
            84 => 
            array (
                'id' => 2130,
                'role_code' => 'student',
                'user_id' => 108,
            ),
            85 => 
            array (
                'id' => 2131,
                'role_code' => 'student',
                'user_id' => 109,
            ),
            86 => 
            array (
                'id' => 2132,
                'role_code' => 'teacher',
                'user_id' => 110,
            ),
        ));
        
        
    }
}