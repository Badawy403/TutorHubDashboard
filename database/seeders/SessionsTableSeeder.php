<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SessionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sessions')->delete();
        
        \DB::table('sessions')->insert(array (
            0 => 
            array (
                'id' => 'uqCypAJzAR8mBXDZ92KUH06kmQ0IMQEMmgwQ4U2G',
                'user_id' => NULL,
                'ip_address' => '172.69.222.161',
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                'payload' => 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN1N3MGxjMjdXQldYSkFrZnM0T2NKdDVZOUR6b3dhS0VYY2x6UjdiSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vbGF3YWR2aXNvci1kZW1vLmhleGF0aGVtZXMuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJsb2NhbGUiO3M6MjoiZW4iO30=',
                'last_activity' => 1705578025,
            ),
            1 => 
            array (
                'id' => 'kUeDTVYcYyO1CW0tTjxI379PIhDIZLP3vMfqbDtC',
                'user_id' => NULL,
                'ip_address' => '172.69.7.54',
            'user_agent' => 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.6099.216 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
                'payload' => 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidUhFdXhuUFZ4V1J1Z2ZOQUk0SWNmS1FpQkpQUEhVUHBESG5UdVlDOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzc6Imh0dHBzOi8vbGF3YWR2aXNvci1kZW1vLmhleGF0aGVtZXMuY29tL3BvZGNhc3RzL3NoYWthc2hoYS1tYS1rYW5hbmEtcGF0aGEtMTQyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',
                'last_activity' => 1705578001,
            ),
            2 => 
            array (
                'id' => 'LWhCehbGBhzLqSzURxwTbg5FpHhX6Ozko3S4cEFK',
                'user_id' => NULL,
                'ip_address' => '172.70.130.236',
            'user_agent' => 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.6099.216 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
                'payload' => 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieTdNYjFDalkwM2JBak9MT2hoOTI1R2tyeUZJVzhsbzBuckk3WXkxQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTE4OiJodHRwczovL2xhd2Fkdmlzb3ItZGVtby5oZXhhdGhlbWVzLmNvbS9ldmVudHMvc2hha2FzaGhhLWF0aGhha2FyYS1rYXJheWFzaGFsLWthLWxlLWFiaGFiaGF2YWthLWthLW1hcmFnYXRoYXJhc2hha2EtMTcxIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',
                'last_activity' => 1705580643,
            ),
            3 => 
            array (
                'id' => 'Rw76eaMALLTaWsrrtyEpJlsye4eXZEFVo3XcxC5h',
                'user_id' => NULL,
                'ip_address' => '172.71.255.6',
            'user_agent' => 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.6099.216 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
                'payload' => 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaExwa0pwbTN5ZlBVbTU5Rkt6cm11YlpkZ3FoZlB5SlJvczhJUWVqZiI7czoxNjoibG9naW5fYXR0ZW1wdF9hcyI7czo4OiJsYXdfZmlybSI7czo1OiJzdGF0ZSI7czo0MDoiVXpWdXoybEJqSHBzdjBjN1gzZVdJWnZTSHlTUmUxRnlybFUyaVMzWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzU6Imh0dHBzOi8vbGF3YWR2aXNvci1kZW1vLmhleGF0aGVtZXMuY29tL3NvY2lhbF9hdXRoL2dvb2dsZT9sb2dpbl9hcz1sYXdfZmlybSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',
                'last_activity' => 1705582155,
            ),
            4 => 
            array (
                'id' => 'TeONA0NfSkrpwmIyNccA2FSTDqucgmUg1rR9IUNb',
                'user_id' => NULL,
                'ip_address' => '162.158.212.147',
            'user_agent' => 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.6099.216 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
                'payload' => 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMUllYjBqQndnbFM3Szc1YVV5MFdRSkZuc0VmZTZiSHBaY1ZTNjdJbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjE6Imh0dHBzOi8vbGF3YWR2aXNvci1kZW1vLmhleGF0aGVtZXMuY29tL2xhd3llci9wcm9maWxlL3Npcl96b2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',
                'last_activity' => 1705582997,
            ),
            5 => 
            array (
                'id' => 'bN1tsobdXbu3QbcHSVBv3FYBGr2tyE7uoSuzAL07',
                'user_id' => 17,
                'ip_address' => '172.69.222.167',
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                'payload' => 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiM2lFSnNFaDloN1Y3UUdYeGtKSmpibEdkM0lUNmhzdzBDWENHTXBCeSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ2OiJodHRwczovL2xhd2Fkdmlzb3ItZGVtby5oZXhhdGhlbWVzLmNvbS9hY2NvdW50Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTc7czoxMjoibG9nZ2VkX2luX2FzIjtzOjY6Imxhd3llciI7fQ==',
                'last_activity' => 1705585217,
            ),
            6 => 
            array (
                'id' => 'WGiRaudBD4vm99iMyZQl7uXua8MhCGve1KdtnrsJ',
                'user_id' => 1,
                'ip_address' => '141.101.69.23',
            'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                'payload' => 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZTZMMHdXT2ZNOWx3eTBVZ2hOMTdSQUdycEprY2g4MUkwbFI3M21KNSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTg6Imh0dHBzOi8vbGF3YWR2aXNvci1kZW1vLmhleGF0aGVtZXMuY29tL3N1cGVyX2FkbWluL2xhd3llcnMiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTI6ImxvZ2dlZF9pbl9hcyI7czoxMToic3VwZXJfYWRtaW4iO30=',
                'last_activity' => 1705584368,
            ),
            7 => 
            array (
                'id' => 'O7Y18TSdWQIJJY1SpsRACLBC6sOZuedSb9yqVFsH',
                'user_id' => NULL,
                'ip_address' => '172.71.131.80',
            'user_agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Mobile/15E148 Safari/604.1',
                'payload' => 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNGNKbzlDM1p3RlZwNDdsMWM4MFNRRTY3NnFHa3hnTHZ3TVFBa2dwaSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTY6Imh0dHBzOi8vbGF3YWR2aXNvci1kZW1vLmhleGF0aGVtZXMuY29tL3JlZ2lzdGVyP3RhYj11c2VyIjt9fQ==',
                'last_activity' => 1705585927,
            ),
            8 => 
            array (
                'id' => '0Z3uwp3p7kizybBrneNhKwtfPs8kArXpNNv8OLBh',
                'user_id' => NULL,
                'ip_address' => '141.101.99.149',
            'user_agent' => 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.6099.224 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
                'payload' => 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZXZGcE4yV0ZQOGt1MGhvVzM1TDRQbkpJZkdnb01ZWFB6WmsyRk9wdiI7czoxNjoibG9naW5fYXR0ZW1wdF9hcyI7czo4OiJjdXN0b21lciI7czo1OiJzdGF0ZSI7czo0MDoicUVhVUJWSG5rMXpDRnlTcFZTUFRhYUt5c2Z2OUdCN0xTZ01ad3NjRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzc6Imh0dHBzOi8vbGF3YWR2aXNvci1kZW1vLmhleGF0aGVtZXMuY29tL3NvY2lhbF9hdXRoL2ZhY2Vib29rP2xvZ2luX2FzPWN1c3RvbWVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',
                'last_activity' => 1705588418,
            ),
        ));
        
        
    }
}