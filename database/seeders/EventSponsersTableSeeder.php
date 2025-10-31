<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EventSponsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('event_sponsers')->delete();
        
        \DB::table('event_sponsers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'event_id' => 16,
                'name' => 'Deleniti dolore exce',
            'image' => '/files/event_sponsers/1693929623download (2).jpeg',
                'created_at' => '2023-09-05 16:00:23',
                'updated_at' => '2023-09-05 16:02:02',
                'deleted_at' => '2023-09-05 16:02:02',
            ),
            1 => 
            array (
                'id' => 2,
                'event_id' => 16,
                'name' => 'Id voluptas ex cupid',
                'image' => '/files/event_sponsers/1693929623download.jpeg',
                'created_at' => '2023-09-05 16:00:23',
                'updated_at' => '2023-09-05 16:02:02',
                'deleted_at' => '2023-09-05 16:02:02',
            ),
            2 => 
            array (
                'id' => 6,
                'event_id' => 8,
                'name' => 'Sponser Name',
                'image' => '/files/event_sponsers/1696334741dashboard-image-1.png',
                'created_at' => '2023-10-03 17:05:41',
                'updated_at' => '2023-10-03 17:05:41',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 7,
                'event_id' => 10,
                'name' => 'Legitadvisor',
                'image' => '/files/event_sponsers/1696406193tick-icon.png',
                'created_at' => '2023-10-04 12:56:33',
                'updated_at' => '2023-10-04 16:16:48',
                'deleted_at' => '2023-10-04 16:16:48',
            ),
            4 => 
            array (
                'id' => 8,
                'event_id' => 10,
                'name' => 'Legitadvisor',
                'image' => '/files/event_sponsers/1696418208tick-icon.png',
                'created_at' => '2023-10-04 16:16:48',
                'updated_at' => '2023-10-11 20:44:48',
                'deleted_at' => '2023-10-11 20:44:48',
            ),
            5 => 
            array (
                'id' => 9,
                'event_id' => 11,
                'name' => 'Legit Advisor',
                'image' => '/files/event_sponsers/1696488027100 x 100.png',
                'created_at' => '2023-10-05 11:40:27',
                'updated_at' => '2023-10-11 20:36:57',
                'deleted_at' => '2023-10-11 20:36:57',
            ),
            6 => 
            array (
                'id' => 10,
                'event_id' => 11,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1697038617law-legal-justice-graphic_24877-52551.avif',
                'created_at' => '2023-10-11 20:36:57',
                'updated_at' => '2023-10-11 20:36:57',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 11,
                'event_id' => 10,
                'name' => 'Legitadvisor',
                'image' => '/files/event_sponsers/1697039088hand-drawn-advocate-logo-design_23-2150640393.avif',
                'created_at' => '2023-10-11 20:44:48',
                'updated_at' => '2023-10-12 17:41:22',
                'deleted_at' => '2023-10-12 17:41:22',
            ),
            8 => 
            array (
                'id' => 12,
                'event_id' => 9,
                'name' => 'legal',
            'image' => '/files/event_sponsers/1697039620hand-drawn-advocate-logo-design_23-2150640393 (1).avif',
                'created_at' => '2023-10-11 20:53:40',
                'updated_at' => '2023-10-12 17:43:10',
                'deleted_at' => '2023-10-12 17:43:10',
            ),
            9 => 
            array (
                'id' => 13,
                'event_id' => 5,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1697040264law-legal-justice-graphic_24877-52551.avif',
                'created_at' => '2023-10-11 21:04:24',
                'updated_at' => '2023-10-12 16:21:23',
                'deleted_at' => '2023-10-12 16:21:23',
            ),
            10 => 
            array (
                'id' => 14,
                'event_id' => 12,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1697107186copyright-law-day-banner-design_1308-121882.avif',
                'created_at' => '2023-10-12 15:39:46',
                'updated_at' => '2023-10-12 15:39:46',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 16,
                'event_id' => 13,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1697107461hand-drawn-advocate-logo-design_23-2150640393.avif',
                'created_at' => '2023-10-12 15:44:21',
                'updated_at' => '2023-10-12 15:44:21',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 17,
                'event_id' => 14,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1697107828hand-drawn-advocate-logo-design_23-2150640393.avif',
                'created_at' => '2023-10-12 15:50:28',
                'updated_at' => '2023-10-12 15:50:28',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 18,
                'event_id' => 15,
                'name' => 'Logo',
                'image' => '/files/event_sponsers/1697108080sponsor-stickers-collection_23-2148737616.avif',
                'created_at' => '2023-10-12 15:54:40',
                'updated_at' => '2023-10-12 15:54:40',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 19,
                'event_id' => 16,
                'name' => 'Logo',
                'image' => '/files/event_sponsers/1697108519law-legal-justice-graphic_24877-52551.avif',
                'created_at' => '2023-10-12 16:01:59',
                'updated_at' => '2023-10-12 16:01:59',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 20,
                'event_id' => 18,
                'name' => 'Logo',
                'image' => '/files/event_sponsers/1697108944hand-drawn-advocate-logo-design_23-2150652390.avif',
                'created_at' => '2023-10-12 16:09:04',
                'updated_at' => '2023-10-12 17:39:48',
                'deleted_at' => '2023-10-12 17:39:48',
            ),
            16 => 
            array (
                'id' => 21,
                'event_id' => 17,
                'name' => 'Logo',
            'image' => '/files/event_sponsers/1697109543law-firm-logo-icon-design-template-vector_9999-1654 (1).avif',
                'created_at' => '2023-10-12 16:19:03',
                'updated_at' => '2023-10-12 17:38:44',
                'deleted_at' => '2023-10-12 17:38:44',
            ),
            17 => 
            array (
                'id' => 22,
                'event_id' => 5,
                'name' => 'legal',
            'image' => '/files/event_sponsers/1697109683world-day-social-justice-banner_1308-127133 (1).avif',
                'created_at' => '2023-10-12 16:21:23',
                'updated_at' => '2023-10-12 16:22:20',
                'deleted_at' => '2023-10-12 16:22:20',
            ),
            18 => 
            array (
                'id' => 23,
                'event_id' => 5,
                'name' => 'legal',
            'image' => '/files/event_sponsers/1697109740world-day-social-justice-banner_1308-127133 (1).avif',
                'created_at' => '2023-10-12 16:22:20',
                'updated_at' => '2023-10-12 16:23:18',
                'deleted_at' => '2023-10-12 16:23:18',
            ),
            19 => 
            array (
                'id' => 24,
                'event_id' => 5,
                'name' => 'legal',
            'image' => '/files/event_sponsers/1697109798world-day-social-justice-banner_1308-127133 (1).avif',
                'created_at' => '2023-10-12 16:23:18',
                'updated_at' => '2023-10-12 16:24:05',
                'deleted_at' => '2023-10-12 16:24:05',
            ),
            20 => 
            array (
                'id' => 25,
                'event_id' => 5,
                'name' => 'legal',
            'image' => '/files/event_sponsers/1697109845world-day-social-justice-banner_1308-127133 (1).avif',
                'created_at' => '2023-10-12 16:24:05',
                'updated_at' => '2023-10-12 16:32:07',
                'deleted_at' => '2023-10-12 16:32:07',
            ),
            21 => 
            array (
                'id' => 26,
                'event_id' => 5,
                'name' => 'legal',
            'image' => '/files/event_sponsers/1697110327world-day-social-justice-banner_1308-127133 (1).avif',
                'created_at' => '2023-10-12 16:32:07',
                'updated_at' => '2023-10-12 16:35:56',
                'deleted_at' => '2023-10-12 16:35:56',
            ),
            22 => 
            array (
                'id' => 27,
                'event_id' => 5,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1697110556world-day-social-justice-banner_1308-127133.avif',
                'created_at' => '2023-10-12 16:35:56',
                'updated_at' => '2023-10-19 14:34:21',
                'deleted_at' => '2023-10-19 14:34:21',
            ),
            23 => 
            array (
                'id' => 28,
                'event_id' => 17,
                'name' => 'Logo',
            'image' => '/files/event_sponsers/1697114324law-firm-logo-icon-design-template-vector_9999-1654 (1).avif',
                'created_at' => '2023-10-12 17:38:44',
                'updated_at' => '2023-10-12 17:38:44',
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 29,
                'event_id' => 18,
                'name' => 'Logo',
                'image' => '/files/event_sponsers/1697114388world-day-social-justice-banner_1308-127133.avif',
                'created_at' => '2023-10-12 17:39:48',
                'updated_at' => '2023-10-12 17:39:48',
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 30,
                'event_id' => 10,
                'name' => 'Legitadvisor',
                'image' => '/files/event_sponsers/1697114482world-day-social-justice-banner_1308-127133.avif',
                'created_at' => '2023-10-12 17:41:22',
                'updated_at' => '2024-03-26 14:32:26',
                'deleted_at' => '2024-03-26 14:32:26',
            ),
            26 => 
            array (
                'id' => 31,
                'event_id' => 9,
                'name' => 'legal',
            'image' => '/files/event_sponsers/1697114590world-day-social-justice-banner_1308-127133 (1).avif',
                'created_at' => '2023-10-12 17:43:10',
                'updated_at' => '2023-10-12 17:43:56',
                'deleted_at' => '2023-10-12 17:43:56',
            ),
            27 => 
            array (
                'id' => 32,
                'event_id' => 9,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1697114590world-day-social-justice-banner_1308-127133.avif',
                'created_at' => '2023-10-12 17:43:10',
                'updated_at' => '2023-10-12 17:43:56',
                'deleted_at' => '2023-10-12 17:43:56',
            ),
            28 => 
            array (
                'id' => 33,
                'event_id' => 9,
                'name' => 'legal',
            'image' => '/files/event_sponsers/1697114636world-day-social-justice-banner_1308-127133 (1).avif',
                'created_at' => '2023-10-12 17:43:56',
                'updated_at' => '2023-10-12 17:43:56',
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 34,
                'event_id' => 9,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1697114636world-day-social-justice-banner_1308-127133.avif',
                'created_at' => '2023-10-12 17:43:56',
                'updated_at' => '2023-10-12 17:43:56',
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 35,
                'event_id' => 23,
                'name' => 'Logo',
                'image' => '/files/event_sponsers/1697197265hand-drawn-advocate-logo-design_23-2150640387.avif',
                'created_at' => '2023-10-13 16:41:05',
                'updated_at' => '2023-10-30 16:51:31',
                'deleted_at' => '2023-10-30 16:51:31',
            ),
            31 => 
            array (
                'id' => 36,
                'event_id' => 24,
                'name' => 'logo',
                'image' => NULL,
                'created_at' => '2023-10-13 16:47:12',
                'updated_at' => '2024-03-26 14:34:45',
                'deleted_at' => '2024-03-26 14:34:45',
            ),
            32 => 
            array (
                'id' => 37,
                'event_id' => 27,
                'name' => 'ASF',
                'image' => '/files/event_sponsers/1697205290hand-drawn-advocate-logo-design_23-2150640387.avif',
                'created_at' => '2023-10-13 18:54:50',
                'updated_at' => '2023-10-13 18:54:50',
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 38,
                'event_id' => 28,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1697110556world-day-social-justice-banner_1308-127133.avif',
                'created_at' => '2023-10-12 16:35:56',
                'updated_at' => '2024-03-26 14:09:48',
                'deleted_at' => '2024-03-26 14:09:48',
            ),
            34 => 
            array (
                'id' => 39,
                'event_id' => 29,
                'name' => 'Logo',
            'image' => '/files/event_sponsers/1697114324law-firm-logo-icon-design-template-vector_9999-1654 (1).avif',
                'created_at' => '2023-10-12 17:38:44',
                'updated_at' => '2023-10-12 17:38:44',
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 40,
                'event_id' => 5,
                'name' => 'legal',
            'image' => '/files/event_sponsers/1697708061advocate-logo-design-template_23-2150628876 (1).avif',
                'created_at' => '2023-10-19 14:34:21',
                'updated_at' => '2023-10-19 14:34:21',
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 41,
                'event_id' => 208,
                'name' => 'teacher',
                'image' => '/files/event_sponsers/1698153939gradient-advocate-logo-template_23-2150670338.avif',
                'created_at' => '2023-10-24 18:25:39',
                'updated_at' => '2023-10-30 16:23:18',
                'deleted_at' => '2023-10-30 16:23:18',
            ),
            37 => 
            array (
                'id' => 42,
                'event_id' => 209,
                'name' => NULL,
                'image' => '/files/event_sponsers/1698154087law-firm-logo-icon-design-template-vector_9999-1654.avif',
                'created_at' => '2023-10-24 18:28:07',
                'updated_at' => '2023-10-24 18:29:38',
                'deleted_at' => '2023-10-24 18:29:38',
            ),
            38 => 
            array (
                'id' => 43,
                'event_id' => 209,
                'name' => NULL,
                'image' => '/files/event_sponsers/1698154087law-firm-logo-icon-design-template-vector_9999-1654.avif',
                'created_at' => '2023-10-24 18:29:38',
                'updated_at' => '2023-10-24 18:32:27',
                'deleted_at' => '2023-10-24 18:32:27',
            ),
            39 => 
            array (
                'id' => 44,
                'event_id' => 209,
                'name' => NULL,
                'image' => '/files/event_sponsers/1698154087law-firm-logo-icon-design-template-vector_9999-1654.avif',
                'created_at' => '2023-10-24 18:32:27',
                'updated_at' => '2023-10-24 18:37:30',
                'deleted_at' => '2023-10-24 18:37:30',
            ),
            40 => 
            array (
                'id' => 45,
                'event_id' => 209,
                'name' => NULL,
                'image' => '/files/event_sponsers/1698154087law-firm-logo-icon-design-template-vector_9999-1654.avif',
                'created_at' => '2023-10-24 18:37:30',
                'updated_at' => '2023-10-30 16:21:35',
                'deleted_at' => '2023-10-30 16:21:35',
            ),
            41 => 
            array (
                'id' => 46,
                'event_id' => 209,
                'name' => 'Academy',
                'image' => '/files/event_sponsers/1698154087law-firm-logo-icon-design-template-vector_9999-1654.avif',
                'created_at' => '2023-10-30 16:21:35',
                'updated_at' => '2023-10-30 16:21:35',
                'deleted_at' => NULL,
            ),
            42 => 
            array (
                'id' => 47,
                'event_id' => 208,
                'name' => 'teacher',
                'image' => '/files/event_sponsers/1698153939gradient-advocate-logo-template_23-2150670338.avif',
                'created_at' => '2023-10-30 16:23:18',
                'updated_at' => '2024-03-26 14:04:00',
                'deleted_at' => '2024-03-26 14:04:00',
            ),
            43 => 
            array (
                'id' => 48,
                'event_id' => 23,
                'name' => 'Logo',
            'image' => '/files/event_sponsers/1698666691hand-drawn-advocate-logo-design_23-2150640399 (1).avif',
                'created_at' => '2023-10-30 16:51:31',
                'updated_at' => '2023-10-30 16:51:31',
                'deleted_at' => NULL,
            ),
            44 => 
            array (
                'id' => 49,
                'event_id' => 112,
                'name' => 'legal',
            'image' => '/files/event_sponsers/1698667319advocate-logo-design-template_23-2150628876 (1).avif',
                'created_at' => '2023-10-30 17:01:59',
                'updated_at' => '2024-03-26 14:59:46',
                'deleted_at' => '2024-03-26 14:59:46',
            ),
            45 => 
            array (
                'id' => 50,
                'event_id' => 205,
                'name' => 'Logo',
            'image' => '/files/event_sponsers/1698667588advocate-logo-design-template_23-2150628876 (1).avif',
                'created_at' => '2023-10-30 17:06:28',
                'updated_at' => '2023-10-30 17:08:55',
                'deleted_at' => '2023-10-30 17:08:55',
            ),
            46 => 
            array (
                'id' => 51,
                'event_id' => 205,
                'name' => 'Logo',
            'image' => '/files/event_sponsers/1698667735hand-drawn-advocate-logo-design_23-2150640399 (1).avif',
                'created_at' => '2023-10-30 17:08:55',
                'updated_at' => '2024-03-26 15:03:47',
                'deleted_at' => '2024-03-26 15:03:47',
            ),
            47 => 
            array (
                'id' => 52,
                'event_id' => 204,
                'name' => 'Logo',
            'image' => '/files/event_sponsers/1698667934advocate-logo-design-template_23-2150628876 (1).avif',
                'created_at' => '2023-10-30 17:12:14',
                'updated_at' => '2024-03-26 14:13:18',
                'deleted_at' => '2024-03-26 14:13:18',
            ),
            48 => 
            array (
                'id' => 53,
                'event_id' => 203,
                'name' => 'Logo',
            'image' => '/files/event_sponsers/1698668135advocate-logo-design-template_23-2150628876 (1).avif',
                'created_at' => '2023-10-30 17:15:35',
                'updated_at' => '2024-03-26 14:02:20',
                'deleted_at' => '2024-03-26 14:02:20',
            ),
            49 => 
            array (
                'id' => 54,
                'event_id' => 185,
                'name' => 'Logo',
            'image' => '/files/event_sponsers/1698668360advocate-logo-design-template_23-2150628876 (1).avif',
                'created_at' => '2023-10-30 17:19:20',
                'updated_at' => '2024-03-26 15:01:15',
                'deleted_at' => '2024-03-26 15:01:15',
            ),
            50 => 
            array (
                'id' => 55,
                'event_id' => 201,
                'name' => 'Logo',
            'image' => '/files/event_sponsers/1698668534advocate-logo-design-template_23-2150628876 (1).avif',
                'created_at' => '2023-10-30 17:22:14',
                'updated_at' => '2023-10-30 17:22:14',
                'deleted_at' => NULL,
            ),
            51 => 
            array (
                'id' => 56,
                'event_id' => 181,
                'name' => 'Logo',
                'image' => '/files/event_sponsers/1698668744dark-teacher-logo-design_1051-1626.avif',
                'created_at' => '2023-10-30 17:25:44',
                'updated_at' => '2024-03-26 14:00:47',
                'deleted_at' => '2024-03-26 14:00:47',
            ),
            52 => 
            array (
                'id' => 57,
                'event_id' => 200,
                'name' => 'Logo',
            'image' => '/files/event_sponsers/1698669142hand-drawn-advocate-logo-design_23-2150640399 (1).avif',
                'created_at' => '2023-10-30 17:32:22',
                'updated_at' => '2023-10-30 17:34:06',
                'deleted_at' => '2023-10-30 17:34:06',
            ),
            53 => 
            array (
                'id' => 58,
                'event_id' => 200,
                'name' => 'Logo',
                'image' => '/files/event_sponsers/1698669246dark-teacher-logo-design_1051-1626.avif',
                'created_at' => '2023-10-30 17:34:06',
                'updated_at' => '2024-03-26 15:02:36',
                'deleted_at' => '2024-03-26 15:02:36',
            ),
            54 => 
            array (
                'id' => 59,
                'event_id' => 211,
                'name' => 'Legal',
                'image' => '/files/event_sponsers/1698846213hand-drawn-advocate-logo-design_23-2150640387.avif',
                'created_at' => '2023-11-01 18:43:33',
                'updated_at' => '2023-11-01 18:46:10',
                'deleted_at' => '2023-11-01 18:46:10',
            ),
            55 => 
            array (
                'id' => 60,
                'event_id' => 211,
                'name' => 'Legal',
                'image' => '/files/event_sponsers/1698846370gradient-advocate-logo-template_23-2150670338.avif',
                'created_at' => '2023-11-01 18:46:10',
                'updated_at' => '2023-11-01 18:46:10',
                'deleted_at' => NULL,
            ),
            56 => 
            array (
                'id' => 61,
                'event_id' => 172,
                'name' => 'zsdfafsadfsad',
                'image' => '/files/event_sponsers/1711369656gradient-premium-education-logo-design_280522-303.avif',
                'created_at' => '2024-03-25 17:27:36',
                'updated_at' => '2024-03-25 17:27:36',
                'deleted_at' => NULL,
            ),
            57 => 
            array (
                'id' => 62,
                'event_id' => 210,
                'name' => 'BankAlfla',
                'image' => '/files/event_sponsers/1711370495education-logo-template-icon-vector-29469366.jpg',
                'created_at' => '2024-03-25 17:41:35',
                'updated_at' => '2024-05-29 13:22:35',
                'deleted_at' => '2024-05-29 13:22:35',
            ),
            58 => 
            array (
                'id' => 63,
                'event_id' => 181,
                'name' => 'Logo',
                'image' => '/files/event_sponsers/1711443647design-eye-catchy-education-logo-very-fast-with-super-color.png',
                'created_at' => '2024-03-26 14:00:47',
                'updated_at' => '2024-05-29 13:23:05',
                'deleted_at' => '2024-05-29 13:23:05',
            ),
            59 => 
            array (
                'id' => 64,
                'event_id' => 203,
                'name' => 'Logo',
                'image' => '/files/event_sponsers/1711443740design-eye-catchy-education-logo-very-fast-with-super-color.png',
                'created_at' => '2024-03-26 14:02:20',
                'updated_at' => '2024-05-29 13:23:32',
                'deleted_at' => '2024-05-29 13:23:32',
            ),
            60 => 
            array (
                'id' => 65,
                'event_id' => 208,
                'name' => 'teacher',
                'image' => '/files/event_sponsers/1711443840design-eye-catchy-education-logo-very-fast-with-super-color.png',
                'created_at' => '2024-03-26 14:04:00',
                'updated_at' => '2024-05-29 13:26:25',
                'deleted_at' => '2024-05-29 13:26:25',
            ),
            61 => 
            array (
                'id' => 66,
                'event_id' => 28,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1711444188pexels-photo-8296991.jpeg',
                'created_at' => '2024-03-26 14:09:48',
                'updated_at' => '2024-04-29 18:03:45',
                'deleted_at' => '2024-04-29 18:03:45',
            ),
            62 => 
            array (
                'id' => 67,
                'event_id' => 202,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1711444310pexels-photo-8296991.jpeg',
                'created_at' => '2024-03-26 14:11:50',
                'updated_at' => '2024-04-29 18:16:40',
                'deleted_at' => '2024-04-29 18:16:40',
            ),
            63 => 
            array (
                'id' => 68,
                'event_id' => 204,
                'name' => 'Logo',
                'image' => '/files/event_sponsers/1711444398pexels-photo-8296991.jpeg',
                'created_at' => '2024-03-26 14:13:18',
                'updated_at' => '2024-04-30 14:26:21',
                'deleted_at' => '2024-04-30 14:26:21',
            ),
            64 => 
            array (
                'id' => 69,
                'event_id' => 206,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1711444496pexels-photo-8296991.jpeg',
                'created_at' => '2024-03-26 14:14:56',
                'updated_at' => '2024-04-30 14:10:07',
                'deleted_at' => '2024-04-30 14:10:07',
            ),
            65 => 
            array (
                'id' => 70,
                'event_id' => 128,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1711444770pexels-photo-8296991.jpeg',
                'created_at' => '2024-03-26 14:19:30',
                'updated_at' => '2024-05-29 13:11:38',
                'deleted_at' => '2024-05-29 13:11:38',
            ),
            66 => 
            array (
                'id' => 71,
                'event_id' => 132,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1711444874pexels-photo-8296991.jpeg',
                'created_at' => '2024-03-26 14:21:14',
                'updated_at' => '2024-04-30 14:15:34',
                'deleted_at' => '2024-04-30 14:15:34',
            ),
            67 => 
            array (
                'id' => 72,
                'event_id' => 136,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1711444946pexels-photo-8296991.jpeg',
                'created_at' => '2024-03-26 14:22:26',
                'updated_at' => '2024-04-30 14:14:08',
                'deleted_at' => '2024-04-30 14:14:08',
            ),
            68 => 
            array (
                'id' => 73,
                'event_id' => 140,
                'name' => 'BankAlfla',
                'image' => '/files/event_sponsers/1711445015ChallengesSTEM.jpg',
                'created_at' => '2024-03-26 14:23:35',
                'updated_at' => '2024-04-30 14:16:47',
                'deleted_at' => '2024-04-30 14:16:47',
            ),
            69 => 
            array (
                'id' => 74,
                'event_id' => 144,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1711445106pexels-photo-8296991.jpeg',
                'created_at' => '2024-03-26 14:25:06',
                'updated_at' => '2024-04-30 14:18:02',
                'deleted_at' => '2024-04-30 14:18:02',
            ),
            70 => 
            array (
                'id' => 75,
                'event_id' => 148,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1711445178pexels-photo-8296991.jpeg',
                'created_at' => '2024-03-26 14:26:18',
                'updated_at' => '2024-04-30 14:17:25',
                'deleted_at' => '2024-04-30 14:17:25',
            ),
            71 => 
            array (
                'id' => 76,
                'event_id' => 10,
                'name' => 'Legitadvisor',
                'image' => '/files/event_sponsers/1711445546pexels-photo-8296991.jpeg',
                'created_at' => '2024-03-26 14:32:26',
                'updated_at' => '2024-05-29 13:08:03',
                'deleted_at' => '2024-05-29 13:08:03',
            ),
            72 => 
            array (
                'id' => 77,
                'event_id' => 24,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1711445685pexels-photo-8296991.jpeg',
                'created_at' => '2024-03-26 14:34:45',
                'updated_at' => '2024-04-30 14:22:32',
                'deleted_at' => '2024-04-30 14:22:32',
            ),
            73 => 
            array (
                'id' => 78,
                'event_id' => 113,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1711445788pexels-photo-8296991.jpeg',
                'created_at' => '2024-03-26 14:36:28',
                'updated_at' => '2024-04-30 14:22:14',
                'deleted_at' => '2024-04-30 14:22:14',
            ),
            74 => 
            array (
                'id' => 79,
                'event_id' => 117,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1711445862pexels-photo-8296991.jpeg',
                'created_at' => '2024-03-26 14:37:42',
                'updated_at' => '2024-04-30 14:21:54',
                'deleted_at' => '2024-04-30 14:21:54',
            ),
            75 => 
            array (
                'id' => 80,
                'event_id' => 121,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1711445963pexels-photo-8296991.jpeg',
                'created_at' => '2024-03-26 14:39:23',
                'updated_at' => '2024-04-30 14:21:29',
                'deleted_at' => '2024-04-30 14:21:29',
            ),
            76 => 
            array (
                'id' => 81,
                'event_id' => 25,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1711446348conference15.jpg',
                'created_at' => '2024-03-26 14:45:48',
                'updated_at' => '2024-05-30 18:52:16',
                'deleted_at' => '2024-05-30 18:52:16',
            ),
            77 => 
            array (
                'id' => 82,
                'event_id' => 114,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1711446478conference15.jpg',
                'created_at' => '2024-03-26 14:47:58',
                'updated_at' => '2024-05-30 18:52:48',
                'deleted_at' => '2024-05-30 18:52:48',
            ),
            78 => 
            array (
                'id' => 83,
                'event_id' => 118,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1711446586conference15.jpg',
                'created_at' => '2024-03-26 14:49:46',
                'updated_at' => '2024-03-26 14:51:55',
                'deleted_at' => '2024-03-26 14:51:55',
            ),
            79 => 
            array (
                'id' => 84,
                'event_id' => 118,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1711446715conference15.jpg',
                'created_at' => '2024-03-26 14:51:55',
                'updated_at' => '2024-05-30 18:53:18',
                'deleted_at' => '2024-05-30 18:53:18',
            ),
            80 => 
            array (
                'id' => 85,
                'event_id' => 122,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1711446803conference15.jpg',
                'created_at' => '2024-03-26 14:53:23',
                'updated_at' => '2024-05-30 18:53:46',
                'deleted_at' => '2024-05-30 18:53:46',
            ),
            81 => 
            array (
                'id' => 86,
                'event_id' => 112,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1711447186conference15.jpg',
                'created_at' => '2024-03-26 14:59:46',
                'updated_at' => '2024-03-26 14:59:46',
                'deleted_at' => NULL,
            ),
            82 => 
            array (
                'id' => 87,
                'event_id' => 185,
                'name' => 'Logo',
                'image' => '/files/event_sponsers/1711447275conference15.jpg',
                'created_at' => '2024-03-26 15:01:15',
                'updated_at' => '2024-05-29 19:53:34',
                'deleted_at' => '2024-05-29 19:53:34',
            ),
            83 => 
            array (
                'id' => 88,
                'event_id' => 200,
                'name' => 'Logo',
                'image' => '/files/event_sponsers/1711447356conference15.jpg',
                'created_at' => '2024-03-26 15:02:36',
                'updated_at' => '2024-05-29 19:55:49',
                'deleted_at' => '2024-05-29 19:55:49',
            ),
            84 => 
            array (
                'id' => 89,
                'event_id' => 205,
                'name' => 'Logo',
                'image' => '/files/event_sponsers/1711447427conference15.jpg',
                'created_at' => '2024-03-26 15:03:47',
                'updated_at' => '2024-05-30 18:39:55',
                'deleted_at' => '2024-05-30 18:39:55',
            ),
            85 => 
            array (
                'id' => 90,
                'event_id' => 26,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1711447803conference15.jpg',
                'created_at' => '2024-03-26 15:10:03',
                'updated_at' => '2024-05-30 18:40:44',
                'deleted_at' => '2024-05-30 18:40:44',
            ),
            86 => 
            array (
                'id' => 91,
                'event_id' => 115,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1711447946DeWatermark.ai_1711361981313.png',
                'created_at' => '2024-03-26 15:12:26',
                'updated_at' => '2024-05-30 18:41:16',
                'deleted_at' => '2024-05-30 18:41:16',
            ),
            87 => 
            array (
                'id' => 92,
                'event_id' => 119,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1711448061DeWatermark.ai_1711361981313.png',
                'created_at' => '2024-03-26 15:14:21',
                'updated_at' => '2024-05-30 18:41:50',
                'deleted_at' => '2024-05-30 18:41:50',
            ),
            88 => 
            array (
                'id' => 93,
                'event_id' => 123,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1711448158DeWatermark.ai_1711361838420.png',
                'created_at' => '2024-03-26 15:15:58',
                'updated_at' => '2024-05-30 18:42:18',
                'deleted_at' => '2024-05-30 18:42:18',
            ),
            89 => 
            array (
                'id' => 94,
                'event_id' => 213,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1712057865DeWatermark.ai_1711448940302.png',
                'created_at' => '2024-04-02 16:37:45',
                'updated_at' => '2024-04-02 16:38:13',
                'deleted_at' => '2024-04-02 16:38:13',
            ),
            90 => 
            array (
                'id' => 95,
                'event_id' => 213,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1712057893DeWatermark.ai_1711449950186.png',
                'created_at' => '2024-04-02 16:38:13',
                'updated_at' => '2024-04-30 14:20:05',
                'deleted_at' => '2024-04-30 14:20:05',
            ),
            91 => 
            array (
                'id' => 96,
                'event_id' => 214,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1712058007DeWatermark.ai_1711447772974.png',
                'created_at' => '2024-04-02 16:40:07',
                'updated_at' => '2024-05-30 18:42:52',
                'deleted_at' => '2024-05-30 18:42:52',
            ),
            92 => 
            array (
                'id' => 97,
                'event_id' => 215,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1712061750DeWatermark.ai_1711452315151.png',
                'created_at' => '2024-04-02 17:42:30',
                'updated_at' => '2024-05-30 18:43:22',
                'deleted_at' => '2024-05-30 18:43:22',
            ),
            93 => 
            array (
                'id' => 98,
                'event_id' => 216,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1712061863DeWatermark.ai_1711448940302.png',
                'created_at' => '2024-04-02 17:44:23',
                'updated_at' => '2024-05-29 12:57:33',
                'deleted_at' => '2024-05-29 12:57:33',
            ),
            94 => 
            array (
                'id' => 99,
                'event_id' => 217,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1712139080DeWatermark.ai_1711449950186.png',
                'created_at' => '2024-04-03 15:11:20',
                'updated_at' => '2024-05-29 12:58:23',
                'deleted_at' => '2024-05-29 12:58:23',
            ),
            95 => 
            array (
                'id' => 100,
                'event_id' => 218,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712139363DeWatermark.ai_1711449950186.png',
                'created_at' => '2024-04-03 15:16:03',
                'updated_at' => '2024-05-30 18:43:50',
                'deleted_at' => '2024-05-30 18:43:50',
            ),
            96 => 
            array (
                'id' => 101,
                'event_id' => 219,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1712140399DeWatermark.ai_1711534888185.png',
                'created_at' => '2024-04-03 15:33:19',
                'updated_at' => '2024-05-29 12:59:04',
                'deleted_at' => '2024-05-29 12:59:04',
            ),
            97 => 
            array (
                'id' => 102,
                'event_id' => 220,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1712140492DeWatermark.ai_1711449950186.png',
                'created_at' => '2024-04-03 15:34:52',
                'updated_at' => '2024-04-30 14:19:20',
                'deleted_at' => '2024-04-30 14:19:20',
            ),
            98 => 
            array (
                'id' => 103,
                'event_id' => 221,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1712142241DeWatermark.ai_1711534888185.png',
                'created_at' => '2024-04-03 16:04:01',
                'updated_at' => '2024-05-29 12:59:38',
                'deleted_at' => '2024-05-29 12:59:38',
            ),
            99 => 
            array (
                'id' => 104,
                'event_id' => 222,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712142434DeWatermark.ai_1711448940302.png',
                'created_at' => '2024-04-03 16:07:14',
                'updated_at' => '2024-05-30 18:44:46',
                'deleted_at' => '2024-05-30 18:44:46',
            ),
        ));
        \DB::table('event_sponsers')->insert(array (
            0 => 
            array (
                'id' => 105,
                'event_id' => 223,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712143621DeWatermark.ai_1711534888185.png',
                'created_at' => '2024-04-03 16:27:01',
                'updated_at' => '2024-05-29 13:00:15',
                'deleted_at' => '2024-05-29 13:00:15',
            ),
            1 => 
            array (
                'id' => 106,
                'event_id' => 224,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712143740DeWatermark.ai_1711448940302.png',
                'created_at' => '2024-04-03 16:29:00',
                'updated_at' => '2024-05-30 18:45:31',
                'deleted_at' => '2024-05-30 18:45:31',
            ),
            2 => 
            array (
                'id' => 107,
                'event_id' => 225,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712144973DeWatermark.ai_1711534888185.png',
                'created_at' => '2024-04-03 16:49:33',
                'updated_at' => '2024-05-29 13:00:57',
                'deleted_at' => '2024-05-29 13:00:57',
            ),
            3 => 
            array (
                'id' => 108,
                'event_id' => 226,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712145126DeWatermark.ai_1711448940302.png',
                'created_at' => '2024-04-03 16:52:06',
                'updated_at' => '2024-04-03 16:52:46',
                'deleted_at' => '2024-04-03 16:52:46',
            ),
            4 => 
            array (
                'id' => 109,
                'event_id' => 226,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712145166DeWatermark.ai_1711448940302.png',
                'created_at' => '2024-04-03 16:52:46',
                'updated_at' => '2024-04-03 16:52:46',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 110,
                'event_id' => 227,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712145265DeWatermark.ai_1711448940302.png',
                'created_at' => '2024-04-03 16:54:25',
                'updated_at' => '2024-05-30 18:55:04',
                'deleted_at' => '2024-05-30 18:55:04',
            ),
            6 => 
            array (
                'id' => 111,
                'event_id' => 228,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712307301DeWatermark.ai_1711534603175.png',
                'created_at' => '2024-04-05 13:55:01',
                'updated_at' => '2024-05-29 13:01:32',
                'deleted_at' => '2024-05-29 13:01:32',
            ),
            7 => 
            array (
                'id' => 112,
                'event_id' => 229,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712307402DeWatermark.ai_1711449950186.png',
                'created_at' => '2024-04-05 13:56:42',
                'updated_at' => '2024-05-30 18:46:05',
                'deleted_at' => '2024-05-30 18:46:05',
            ),
            8 => 
            array (
                'id' => 113,
                'event_id' => 230,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712307502DeWatermark.ai_1711448940302.png',
                'created_at' => '2024-04-05 13:58:22',
                'updated_at' => '2024-05-30 18:55:35',
                'deleted_at' => '2024-05-30 18:55:35',
            ),
            9 => 
            array (
                'id' => 114,
                'event_id' => 231,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712308542DeWatermark.ai_1711536017388.png',
                'created_at' => '2024-04-05 14:15:42',
                'updated_at' => '2024-05-29 13:02:04',
                'deleted_at' => '2024-05-29 13:02:04',
            ),
            10 => 
            array (
                'id' => 115,
                'event_id' => 232,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712308636DeWatermark.ai_1711447772974.png',
                'created_at' => '2024-04-05 14:17:16',
                'updated_at' => '2024-05-30 18:46:38',
                'deleted_at' => '2024-05-30 18:46:38',
            ),
            11 => 
            array (
                'id' => 116,
                'event_id' => 233,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712308736DeWatermark.ai_1711448940302.png',
                'created_at' => '2024-04-05 14:18:56',
                'updated_at' => '2024-05-30 18:56:07',
                'deleted_at' => '2024-05-30 18:56:07',
            ),
            12 => 
            array (
                'id' => 117,
                'event_id' => 234,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712309640DeWatermark.ai_1711534603175.png',
                'created_at' => '2024-04-05 14:34:00',
                'updated_at' => '2024-05-29 13:02:55',
                'deleted_at' => '2024-05-29 13:02:55',
            ),
            13 => 
            array (
                'id' => 118,
                'event_id' => 235,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712309744DeWatermark.ai_1711447772974.png',
                'created_at' => '2024-04-05 14:35:44',
                'updated_at' => '2024-05-30 18:47:08',
                'deleted_at' => '2024-05-30 18:47:08',
            ),
            14 => 
            array (
                'id' => 119,
                'event_id' => 236,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712309876DeWatermark.ai_1711448940302.png',
                'created_at' => '2024-04-05 14:37:56',
                'updated_at' => '2024-04-05 14:37:56',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 120,
                'event_id' => 237,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712310775DeWatermark.ai_1711534888185.png',
                'created_at' => '2024-04-05 14:52:55',
                'updated_at' => '2024-05-29 13:03:46',
                'deleted_at' => '2024-05-29 13:03:46',
            ),
            16 => 
            array (
                'id' => 121,
                'event_id' => 238,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712310841DeWatermark.ai_1711449950186.png',
                'created_at' => '2024-04-05 14:54:01',
                'updated_at' => '2024-05-30 18:47:37',
                'deleted_at' => '2024-05-30 18:47:37',
            ),
            17 => 
            array (
                'id' => 122,
                'event_id' => 239,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712310922DeWatermark.ai_1711448940302.png',
                'created_at' => '2024-04-05 14:55:22',
                'updated_at' => '2024-05-30 18:56:39',
                'deleted_at' => '2024-05-30 18:56:39',
            ),
            18 => 
            array (
                'id' => 123,
                'event_id' => 240,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712311783DeWatermark.ai_1711449950186.png',
                'created_at' => '2024-04-05 15:09:43',
                'updated_at' => '2024-05-29 13:04:23',
                'deleted_at' => '2024-05-29 13:04:23',
            ),
            19 => 
            array (
                'id' => 124,
                'event_id' => 241,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712311856DeWatermark.ai_1711449950186.png',
                'created_at' => '2024-04-05 15:10:56',
                'updated_at' => '2024-05-30 18:48:08',
                'deleted_at' => '2024-05-30 18:48:08',
            ),
            20 => 
            array (
                'id' => 125,
                'event_id' => 242,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712311928DeWatermark.ai_1711448940302.png',
                'created_at' => '2024-04-05 15:12:08',
                'updated_at' => '2024-05-30 18:57:21',
                'deleted_at' => '2024-05-30 18:57:21',
            ),
            21 => 
            array (
                'id' => 126,
                'event_id' => 243,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712312902DeWatermark.ai_1711534888185.png',
                'created_at' => '2024-04-05 15:28:22',
                'updated_at' => '2024-04-05 15:28:57',
                'deleted_at' => '2024-04-05 15:28:57',
            ),
            22 => 
            array (
                'id' => 127,
                'event_id' => 243,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712312937DeWatermark.ai_1711534888185.png',
                'created_at' => '2024-04-05 15:28:57',
                'updated_at' => '2024-05-29 13:05:08',
                'deleted_at' => '2024-05-29 13:05:08',
            ),
            23 => 
            array (
                'id' => 128,
                'event_id' => 244,
                'name' => 'BankAlfla',
                'image' => '/files/event_sponsers/1712313020DeWatermark.ai_1711448940302.png',
                'created_at' => '2024-04-05 15:30:20',
                'updated_at' => '2024-05-30 18:48:44',
                'deleted_at' => '2024-05-30 18:48:44',
            ),
            24 => 
            array (
                'id' => 129,
                'event_id' => 245,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712313676DeWatermark.ai_1711535414672.png',
                'created_at' => '2024-04-05 15:41:16',
                'updated_at' => '2024-05-29 13:05:47',
                'deleted_at' => '2024-05-29 13:05:47',
            ),
            25 => 
            array (
                'id' => 130,
                'event_id' => 246,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712313764DeWatermark.ai_1711448940302.png',
                'created_at' => '2024-04-05 15:42:44',
                'updated_at' => '2024-05-30 18:49:33',
                'deleted_at' => '2024-05-30 18:49:33',
            ),
            26 => 
            array (
                'id' => 131,
                'event_id' => 247,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712313840DeWatermark.ai_1711449950186.png',
                'created_at' => '2024-04-05 15:44:00',
                'updated_at' => '2024-05-30 18:57:59',
                'deleted_at' => '2024-05-30 18:57:59',
            ),
            27 => 
            array (
                'id' => 132,
                'event_id' => 248,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712314402DeWatermark.ai_1711534888185.png',
                'created_at' => '2024-04-05 15:53:22',
                'updated_at' => '2024-05-29 13:06:33',
                'deleted_at' => '2024-05-29 13:06:33',
            ),
            28 => 
            array (
                'id' => 133,
                'event_id' => 249,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712314475DeWatermark.ai_1711449950186.png',
                'created_at' => '2024-04-05 15:54:35',
                'updated_at' => '2024-04-05 15:54:58',
                'deleted_at' => '2024-04-05 15:54:58',
            ),
            29 => 
            array (
                'id' => 134,
                'event_id' => 249,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712314498DeWatermark.ai_1711448940302.png',
                'created_at' => '2024-04-05 15:54:58',
                'updated_at' => '2024-05-30 18:50:03',
                'deleted_at' => '2024-05-30 18:50:03',
            ),
            30 => 
            array (
                'id' => 135,
                'event_id' => 250,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712569567DeWatermark.ai_1711452707420.png',
                'created_at' => '2024-04-08 14:46:07',
                'updated_at' => '2024-05-29 13:07:22',
                'deleted_at' => '2024-05-29 13:07:22',
            ),
            31 => 
            array (
                'id' => 136,
                'event_id' => 251,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712569666DeWatermark.ai_1711448940302.png',
                'created_at' => '2024-04-08 14:47:46',
                'updated_at' => '2024-05-30 18:50:37',
                'deleted_at' => '2024-05-30 18:50:37',
            ),
            32 => 
            array (
                'id' => 137,
                'event_id' => 252,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712571295DeWatermark.ai_1711452707420.png',
                'created_at' => '2024-04-08 15:14:55',
                'updated_at' => '2024-05-30 18:51:09',
                'deleted_at' => '2024-05-30 18:51:09',
            ),
            33 => 
            array (
                'id' => 138,
                'event_id' => 253,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1712572077DeWatermark.ai_1711452315151.png',
                'created_at' => '2024-04-08 15:27:57',
                'updated_at' => '2024-05-30 18:51:42',
                'deleted_at' => '2024-05-30 18:51:42',
            ),
            34 => 
            array (
                'id' => 139,
                'event_id' => 28,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1714395825event-management-logos-20.jpg',
                'created_at' => '2024-04-29 18:03:45',
                'updated_at' => '2024-04-30 14:07:38',
                'deleted_at' => '2024-04-30 14:07:38',
            ),
            35 => 
            array (
                'id' => 140,
                'event_id' => 202,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1714396600event-management-logos-20.jpg',
                'created_at' => '2024-04-29 18:16:40',
                'updated_at' => '2024-04-29 18:17:09',
                'deleted_at' => '2024-04-29 18:17:09',
            ),
            36 => 
            array (
                'id' => 141,
                'event_id' => 202,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1714396629event-management-logos-20.jpg',
                'created_at' => '2024-04-29 18:17:09',
                'updated_at' => '2024-04-29 18:17:09',
                'deleted_at' => '2024-04-29 18:17:09',
            ),
            37 => 
            array (
                'id' => 142,
                'event_id' => 202,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1714396629event-management-logos-20.jpg',
                'created_at' => '2024-04-29 18:17:09',
                'updated_at' => '2024-04-29 18:17:09',
                'deleted_at' => '2024-04-29 18:17:09',
            ),
            38 => 
            array (
                'id' => 143,
                'event_id' => 202,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1714396629event-management-logos-20.jpg',
                'created_at' => '2024-04-29 18:17:09',
                'updated_at' => '2024-04-30 14:09:39',
                'deleted_at' => '2024-04-30 14:09:39',
            ),
            39 => 
            array (
                'id' => 144,
                'event_id' => 28,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1714468058event-management-logos-20.jpg',
                'created_at' => '2024-04-30 14:07:38',
                'updated_at' => '2024-04-30 14:09:08',
                'deleted_at' => '2024-04-30 14:09:08',
            ),
            40 => 
            array (
                'id' => 145,
                'event_id' => 28,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1714468148event-management-logos-20.jpg',
                'created_at' => '2024-04-30 14:09:08',
                'updated_at' => '2024-05-30 18:58:36',
                'deleted_at' => '2024-05-30 18:58:36',
            ),
            41 => 
            array (
                'id' => 146,
                'event_id' => 202,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1714468179event-management-logos-20.jpg',
                'created_at' => '2024-04-30 14:09:39',
                'updated_at' => '2024-05-30 18:59:07',
                'deleted_at' => '2024-05-30 18:59:07',
            ),
            42 => 
            array (
                'id' => 147,
                'event_id' => 206,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1714468207event-management-logos-20.jpg',
                'created_at' => '2024-04-30 14:10:07',
                'updated_at' => '2024-05-30 19:00:05',
                'deleted_at' => '2024-05-30 19:00:05',
            ),
            43 => 
            array (
                'id' => 148,
                'event_id' => 136,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1714468448event-management-logos-20.jpg',
                'created_at' => '2024-04-30 14:14:08',
                'updated_at' => '2024-05-29 13:13:28',
                'deleted_at' => '2024-05-29 13:13:28',
            ),
            44 => 
            array (
                'id' => 149,
                'event_id' => 132,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1714468534event-management-logos-20.jpg',
                'created_at' => '2024-04-30 14:15:34',
                'updated_at' => '2024-05-29 13:12:09',
                'deleted_at' => '2024-05-29 13:12:09',
            ),
            45 => 
            array (
                'id' => 150,
                'event_id' => 140,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1714468607event-management-logos-20.jpg',
                'created_at' => '2024-04-30 14:16:47',
                'updated_at' => '2024-05-29 13:14:03',
                'deleted_at' => '2024-05-29 13:14:03',
            ),
            46 => 
            array (
                'id' => 151,
                'event_id' => 148,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1714468645event-management-logos-20.jpg',
                'created_at' => '2024-04-30 14:17:25',
                'updated_at' => '2024-05-29 13:21:44',
                'deleted_at' => '2024-05-29 13:21:44',
            ),
            47 => 
            array (
                'id' => 152,
                'event_id' => 144,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1714468682event-management-logos-20.jpg',
                'created_at' => '2024-04-30 14:18:02',
                'updated_at' => '2024-05-29 13:21:00',
                'deleted_at' => '2024-05-29 13:21:00',
            ),
            48 => 
            array (
                'id' => 153,
                'event_id' => 220,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1714468760event-management-logos-20.jpg',
                'created_at' => '2024-04-30 14:19:20',
                'updated_at' => '2024-05-30 18:44:20',
                'deleted_at' => '2024-05-30 18:44:20',
            ),
            49 => 
            array (
                'id' => 154,
                'event_id' => 213,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1714468805event-management-logos-20.jpg',
                'created_at' => '2024-04-30 14:20:05',
                'updated_at' => '2024-05-29 12:44:47',
                'deleted_at' => '2024-05-29 12:44:47',
            ),
            50 => 
            array (
                'id' => 155,
                'event_id' => 121,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1714468889event-management-logos-20.jpg',
                'created_at' => '2024-04-30 14:21:29',
                'updated_at' => '2024-05-29 13:10:14',
                'deleted_at' => '2024-05-29 13:10:14',
            ),
            51 => 
            array (
                'id' => 156,
                'event_id' => 117,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1714468914event-management-logos-20.jpg',
                'created_at' => '2024-04-30 14:21:54',
                'updated_at' => '2024-05-29 13:09:43',
                'deleted_at' => '2024-05-29 13:09:43',
            ),
            52 => 
            array (
                'id' => 157,
                'event_id' => 113,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1714468934event-management-logos-20.jpg',
                'created_at' => '2024-04-30 14:22:14',
                'updated_at' => '2024-05-29 13:09:14',
                'deleted_at' => '2024-05-29 13:09:14',
            ),
            53 => 
            array (
                'id' => 158,
                'event_id' => 24,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1714468952event-management-logos-20.jpg',
                'created_at' => '2024-04-30 14:22:32',
                'updated_at' => '2024-05-29 13:08:44',
                'deleted_at' => '2024-05-29 13:08:44',
            ),
            54 => 
            array (
                'id' => 159,
                'event_id' => 204,
                'name' => 'Logo',
                'image' => '/files/event_sponsers/1714469181event-management-logos-20.jpg',
                'created_at' => '2024-04-30 14:26:21',
                'updated_at' => '2024-05-30 18:59:34',
                'deleted_at' => '2024-05-30 18:59:34',
            ),
            55 => 
            array (
                'id' => 160,
                'event_id' => 213,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716968687event-management-logos-20.jpg',
                'created_at' => '2024-05-29 12:44:47',
                'updated_at' => '2024-05-29 12:56:59',
                'deleted_at' => '2024-05-29 12:56:59',
            ),
            56 => 
            array (
                'id' => 161,
                'event_id' => 213,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716968687png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail.png',
                'created_at' => '2024-05-29 12:44:47',
                'updated_at' => '2024-05-29 12:56:59',
                'deleted_at' => '2024-05-29 12:56:59',
            ),
            57 => 
            array (
                'id' => 162,
                'event_id' => 254,
                'name' => 'asdas',
                'image' => '/files/event_sponsers/1716968805png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail.png',
                'created_at' => '2024-05-29 12:46:45',
                'updated_at' => '2024-05-29 12:49:36',
                'deleted_at' => '2024-05-29 12:49:36',
            ),
            58 => 
            array (
                'id' => 163,
                'event_id' => 254,
                'name' => 'asdas',
                'image' => '/files/event_sponsers/1716968976png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 12:49:36',
                'updated_at' => '2024-05-29 12:49:36',
                'deleted_at' => NULL,
            ),
            59 => 
            array (
                'id' => 164,
                'event_id' => 213,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716969419event-management-logos-20.jpg',
                'created_at' => '2024-05-29 12:56:59',
                'updated_at' => '2024-05-29 12:56:59',
                'deleted_at' => NULL,
            ),
            60 => 
            array (
                'id' => 165,
                'event_id' => 213,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716969419png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 12:56:59',
                'updated_at' => '2024-05-29 12:56:59',
                'deleted_at' => NULL,
            ),
            61 => 
            array (
                'id' => 166,
                'event_id' => 213,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716969419evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 12:56:59',
                'updated_at' => '2024-05-29 12:56:59',
                'deleted_at' => NULL,
            ),
            62 => 
            array (
                'id' => 167,
                'event_id' => 216,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716969453event-management-logos-20.jpg',
                'created_at' => '2024-05-29 12:57:33',
                'updated_at' => '2024-06-13 16:05:06',
                'deleted_at' => '2024-06-13 16:05:06',
            ),
            63 => 
            array (
                'id' => 168,
                'event_id' => 216,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716969453png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 12:57:33',
                'updated_at' => '2024-06-13 16:05:06',
                'deleted_at' => '2024-06-13 16:05:06',
            ),
            64 => 
            array (
                'id' => 169,
                'event_id' => 216,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716969453evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 12:57:33',
                'updated_at' => '2024-06-13 16:05:06',
                'deleted_at' => '2024-06-13 16:05:06',
            ),
            65 => 
            array (
                'id' => 170,
                'event_id' => 217,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716969503event-management-logos-20.jpg',
                'created_at' => '2024-05-29 12:58:23',
                'updated_at' => '2024-06-11 15:33:26',
                'deleted_at' => '2024-06-11 15:33:26',
            ),
            66 => 
            array (
                'id' => 171,
                'event_id' => 217,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716969503png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 12:58:23',
                'updated_at' => '2024-06-11 15:33:26',
                'deleted_at' => '2024-06-11 15:33:26',
            ),
            67 => 
            array (
                'id' => 172,
                'event_id' => 217,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716969503evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 12:58:23',
                'updated_at' => '2024-06-11 15:33:26',
                'deleted_at' => '2024-06-11 15:33:26',
            ),
            68 => 
            array (
                'id' => 173,
                'event_id' => 219,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716969544event-management-logos-20.jpg',
                'created_at' => '2024-05-29 12:59:04',
                'updated_at' => '2024-06-13 16:13:24',
                'deleted_at' => '2024-06-13 16:13:24',
            ),
            69 => 
            array (
                'id' => 174,
                'event_id' => 219,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716969544png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 12:59:04',
                'updated_at' => '2024-06-13 16:13:24',
                'deleted_at' => '2024-06-13 16:13:24',
            ),
            70 => 
            array (
                'id' => 175,
                'event_id' => 219,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716969544evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 12:59:04',
                'updated_at' => '2024-06-13 16:13:24',
                'deleted_at' => '2024-06-13 16:13:24',
            ),
            71 => 
            array (
                'id' => 176,
                'event_id' => 221,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716969578event-management-logos-20.jpg',
                'created_at' => '2024-05-29 12:59:38',
                'updated_at' => '2024-05-29 12:59:38',
                'deleted_at' => NULL,
            ),
            72 => 
            array (
                'id' => 177,
                'event_id' => 221,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716969578png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 12:59:38',
                'updated_at' => '2024-05-29 12:59:38',
                'deleted_at' => NULL,
            ),
            73 => 
            array (
                'id' => 178,
                'event_id' => 221,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716969578evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 12:59:38',
                'updated_at' => '2024-05-29 12:59:38',
                'deleted_at' => NULL,
            ),
            74 => 
            array (
                'id' => 179,
                'event_id' => 223,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1716969615event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:00:15',
                'updated_at' => '2024-05-29 13:00:15',
                'deleted_at' => NULL,
            ),
            75 => 
            array (
                'id' => 180,
                'event_id' => 223,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716969615png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:00:15',
                'updated_at' => '2024-05-29 13:00:15',
                'deleted_at' => NULL,
            ),
            76 => 
            array (
                'id' => 181,
                'event_id' => 223,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716969615evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:00:15',
                'updated_at' => '2024-05-29 13:00:15',
                'deleted_at' => NULL,
            ),
            77 => 
            array (
                'id' => 182,
                'event_id' => 225,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1716969657event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:00:57',
                'updated_at' => '2024-05-29 13:00:57',
                'deleted_at' => NULL,
            ),
            78 => 
            array (
                'id' => 183,
                'event_id' => 225,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716969657png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:00:57',
                'updated_at' => '2024-05-29 13:00:57',
                'deleted_at' => NULL,
            ),
            79 => 
            array (
                'id' => 184,
                'event_id' => 225,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716969657evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:00:57',
                'updated_at' => '2024-05-29 13:00:57',
                'deleted_at' => NULL,
            ),
            80 => 
            array (
                'id' => 185,
                'event_id' => 228,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1716969692event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:01:32',
                'updated_at' => '2024-05-29 13:01:32',
                'deleted_at' => NULL,
            ),
            81 => 
            array (
                'id' => 186,
                'event_id' => 228,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716969692png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:01:32',
                'updated_at' => '2024-05-29 13:01:32',
                'deleted_at' => NULL,
            ),
            82 => 
            array (
                'id' => 187,
                'event_id' => 228,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716969692evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:01:32',
                'updated_at' => '2024-05-29 13:01:32',
                'deleted_at' => NULL,
            ),
            83 => 
            array (
                'id' => 188,
                'event_id' => 231,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1716969724event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:02:04',
                'updated_at' => '2024-05-29 13:02:04',
                'deleted_at' => NULL,
            ),
            84 => 
            array (
                'id' => 189,
                'event_id' => 231,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716969724png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:02:04',
                'updated_at' => '2024-05-29 13:02:04',
                'deleted_at' => NULL,
            ),
            85 => 
            array (
                'id' => 190,
                'event_id' => 231,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716969724evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:02:04',
                'updated_at' => '2024-05-29 13:02:04',
                'deleted_at' => NULL,
            ),
            86 => 
            array (
                'id' => 191,
                'event_id' => 234,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1716969775event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:02:55',
                'updated_at' => '2024-05-29 13:02:55',
                'deleted_at' => NULL,
            ),
            87 => 
            array (
                'id' => 192,
                'event_id' => 234,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716969775png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:02:55',
                'updated_at' => '2024-05-29 13:02:55',
                'deleted_at' => NULL,
            ),
            88 => 
            array (
                'id' => 193,
                'event_id' => 234,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716969775evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:02:55',
                'updated_at' => '2024-05-29 13:02:55',
                'deleted_at' => NULL,
            ),
            89 => 
            array (
                'id' => 194,
                'event_id' => 237,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1716969826event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:03:46',
                'updated_at' => '2024-05-29 13:03:46',
                'deleted_at' => NULL,
            ),
            90 => 
            array (
                'id' => 195,
                'event_id' => 237,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716969826png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:03:46',
                'updated_at' => '2024-05-29 13:03:46',
                'deleted_at' => NULL,
            ),
            91 => 
            array (
                'id' => 196,
                'event_id' => 237,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716969826evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:03:46',
                'updated_at' => '2024-05-29 13:03:46',
                'deleted_at' => NULL,
            ),
            92 => 
            array (
                'id' => 197,
                'event_id' => 240,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1716969863event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:04:23',
                'updated_at' => '2024-05-29 13:04:23',
                'deleted_at' => NULL,
            ),
            93 => 
            array (
                'id' => 198,
                'event_id' => 240,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716969863png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:04:23',
                'updated_at' => '2024-05-29 13:04:23',
                'deleted_at' => NULL,
            ),
            94 => 
            array (
                'id' => 199,
                'event_id' => 240,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716969863evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:04:23',
                'updated_at' => '2024-05-29 13:04:23',
                'deleted_at' => NULL,
            ),
            95 => 
            array (
                'id' => 200,
                'event_id' => 243,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1716969908event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:05:08',
                'updated_at' => '2024-05-29 13:05:08',
                'deleted_at' => NULL,
            ),
            96 => 
            array (
                'id' => 201,
                'event_id' => 243,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716969908png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:05:08',
                'updated_at' => '2024-05-29 13:05:08',
                'deleted_at' => NULL,
            ),
            97 => 
            array (
                'id' => 202,
                'event_id' => 243,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716969908evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:05:08',
                'updated_at' => '2024-05-29 13:05:08',
                'deleted_at' => NULL,
            ),
            98 => 
            array (
                'id' => 203,
                'event_id' => 245,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1716969947event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:05:47',
                'updated_at' => '2024-05-29 13:05:47',
                'deleted_at' => NULL,
            ),
            99 => 
            array (
                'id' => 204,
                'event_id' => 245,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716969947png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:05:47',
                'updated_at' => '2024-05-29 13:05:47',
                'deleted_at' => NULL,
            ),
        ));
        \DB::table('event_sponsers')->insert(array (
            0 => 
            array (
                'id' => 205,
                'event_id' => 245,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716969947evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:05:47',
                'updated_at' => '2024-05-29 13:05:47',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 206,
                'event_id' => 248,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1716969993event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:06:33',
                'updated_at' => '2024-05-29 13:06:33',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 207,
                'event_id' => 248,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716969993png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:06:33',
                'updated_at' => '2024-05-29 13:06:33',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 208,
                'event_id' => 248,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716969993evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:06:33',
                'updated_at' => '2024-05-29 13:06:33',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 209,
                'event_id' => 250,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1716970042event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:07:22',
                'updated_at' => '2024-05-29 13:07:22',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 210,
                'event_id' => 250,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716970042png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:07:22',
                'updated_at' => '2024-05-29 13:07:22',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 211,
                'event_id' => 250,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716970042evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:07:22',
                'updated_at' => '2024-05-29 13:07:22',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 212,
                'event_id' => 10,
                'name' => 'Legitadvisor',
                'image' => '/files/event_sponsers/1716970083event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:08:03',
                'updated_at' => '2024-06-13 16:16:47',
                'deleted_at' => '2024-06-13 16:16:47',
            ),
            8 => 
            array (
                'id' => 213,
                'event_id' => 10,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716970083png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:08:03',
                'updated_at' => '2024-06-13 16:16:47',
                'deleted_at' => '2024-06-13 16:16:47',
            ),
            9 => 
            array (
                'id' => 214,
                'event_id' => 10,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716970083evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:08:03',
                'updated_at' => '2024-06-13 16:16:47',
                'deleted_at' => '2024-06-13 16:16:47',
            ),
            10 => 
            array (
                'id' => 215,
                'event_id' => 24,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716970124event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:08:44',
                'updated_at' => '2024-06-13 16:18:15',
                'deleted_at' => '2024-06-13 16:18:15',
            ),
            11 => 
            array (
                'id' => 216,
                'event_id' => 24,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716970124png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:08:44',
                'updated_at' => '2024-06-13 16:18:15',
                'deleted_at' => '2024-06-13 16:18:15',
            ),
            12 => 
            array (
                'id' => 217,
                'event_id' => 24,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716970124evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:08:44',
                'updated_at' => '2024-06-13 16:18:15',
                'deleted_at' => '2024-06-13 16:18:15',
            ),
            13 => 
            array (
                'id' => 218,
                'event_id' => 113,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716970154event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:09:14',
                'updated_at' => '2024-06-07 18:17:13',
                'deleted_at' => '2024-06-07 18:17:13',
            ),
            14 => 
            array (
                'id' => 219,
                'event_id' => 113,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716970154png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:09:14',
                'updated_at' => '2024-06-07 18:17:13',
                'deleted_at' => '2024-06-07 18:17:13',
            ),
            15 => 
            array (
                'id' => 220,
                'event_id' => 113,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716970154evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:09:14',
                'updated_at' => '2024-06-07 18:17:13',
                'deleted_at' => '2024-06-07 18:17:13',
            ),
            16 => 
            array (
                'id' => 221,
                'event_id' => 117,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716970183event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:09:43',
                'updated_at' => '2024-06-12 16:49:24',
                'deleted_at' => '2024-06-12 16:49:24',
            ),
            17 => 
            array (
                'id' => 222,
                'event_id' => 117,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716970183png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:09:43',
                'updated_at' => '2024-06-12 16:49:24',
                'deleted_at' => '2024-06-12 16:49:24',
            ),
            18 => 
            array (
                'id' => 223,
                'event_id' => 117,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716970183evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:09:43',
                'updated_at' => '2024-06-12 16:49:24',
                'deleted_at' => '2024-06-12 16:49:24',
            ),
            19 => 
            array (
                'id' => 224,
                'event_id' => 121,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716970214event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:10:14',
                'updated_at' => '2024-06-13 16:30:23',
                'deleted_at' => '2024-06-13 16:30:23',
            ),
            20 => 
            array (
                'id' => 225,
                'event_id' => 121,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716970214png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:10:14',
                'updated_at' => '2024-06-13 16:30:23',
                'deleted_at' => '2024-06-13 16:30:23',
            ),
            21 => 
            array (
                'id' => 226,
                'event_id' => 121,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716970214evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:10:14',
                'updated_at' => '2024-06-13 16:30:23',
                'deleted_at' => '2024-06-13 16:30:23',
            ),
            22 => 
            array (
                'id' => 227,
                'event_id' => 128,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1716970298event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:11:38',
                'updated_at' => '2024-06-13 16:01:42',
                'deleted_at' => '2024-06-13 16:01:42',
            ),
            23 => 
            array (
                'id' => 228,
                'event_id' => 128,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716970298png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:11:38',
                'updated_at' => '2024-06-13 16:01:42',
                'deleted_at' => '2024-06-13 16:01:42',
            ),
            24 => 
            array (
                'id' => 229,
                'event_id' => 128,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716970298evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:11:38',
                'updated_at' => '2024-06-13 16:01:42',
                'deleted_at' => '2024-06-13 16:01:42',
            ),
            25 => 
            array (
                'id' => 230,
                'event_id' => 132,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716970329event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:12:09',
                'updated_at' => '2024-06-13 16:32:30',
                'deleted_at' => '2024-06-13 16:32:30',
            ),
            26 => 
            array (
                'id' => 231,
                'event_id' => 132,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716970329png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:12:09',
                'updated_at' => '2024-06-13 16:32:30',
                'deleted_at' => '2024-06-13 16:32:30',
            ),
            27 => 
            array (
                'id' => 232,
                'event_id' => 132,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716970329evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:12:09',
                'updated_at' => '2024-06-13 16:32:30',
                'deleted_at' => '2024-06-13 16:32:30',
            ),
            28 => 
            array (
                'id' => 233,
                'event_id' => 136,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716970408event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:13:28',
                'updated_at' => '2024-06-13 16:36:11',
                'deleted_at' => '2024-06-13 16:36:11',
            ),
            29 => 
            array (
                'id' => 234,
                'event_id' => 136,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716970408png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:13:28',
                'updated_at' => '2024-06-13 16:36:11',
                'deleted_at' => '2024-06-13 16:36:11',
            ),
            30 => 
            array (
                'id' => 235,
                'event_id' => 136,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716970408evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:13:28',
                'updated_at' => '2024-06-13 16:36:11',
                'deleted_at' => '2024-06-13 16:36:11',
            ),
            31 => 
            array (
                'id' => 236,
                'event_id' => 140,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716970443evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:14:03',
                'updated_at' => '2024-06-13 16:38:04',
                'deleted_at' => '2024-06-13 16:38:04',
            ),
            32 => 
            array (
                'id' => 237,
                'event_id' => 140,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716970443png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:14:03',
                'updated_at' => '2024-06-13 16:38:04',
                'deleted_at' => '2024-06-13 16:38:04',
            ),
            33 => 
            array (
                'id' => 238,
                'event_id' => 140,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716970443evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:14:03',
                'updated_at' => '2024-06-13 16:38:04',
                'deleted_at' => '2024-06-13 16:38:04',
            ),
            34 => 
            array (
                'id' => 239,
                'event_id' => 144,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716970860event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:21:00',
                'updated_at' => '2024-05-30 18:38:38',
                'deleted_at' => '2024-05-30 18:38:38',
            ),
            35 => 
            array (
                'id' => 240,
                'event_id' => 144,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716970860png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:21:00',
                'updated_at' => '2024-05-30 18:38:38',
                'deleted_at' => '2024-05-30 18:38:38',
            ),
            36 => 
            array (
                'id' => 241,
                'event_id' => 144,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716970860evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:21:00',
                'updated_at' => '2024-05-30 18:38:38',
                'deleted_at' => '2024-05-30 18:38:38',
            ),
            37 => 
            array (
                'id' => 242,
                'event_id' => 148,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716970904event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:21:44',
                'updated_at' => '2024-06-13 16:41:37',
                'deleted_at' => '2024-06-13 16:41:37',
            ),
            38 => 
            array (
                'id' => 243,
                'event_id' => 148,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716970904png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:21:44',
                'updated_at' => '2024-06-13 16:41:37',
                'deleted_at' => '2024-06-13 16:41:37',
            ),
            39 => 
            array (
                'id' => 244,
                'event_id' => 148,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716970904evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:21:44',
                'updated_at' => '2024-06-13 16:41:37',
                'deleted_at' => '2024-06-13 16:41:37',
            ),
            40 => 
            array (
                'id' => 245,
                'event_id' => 210,
                'name' => 'BankAlfla',
                'image' => '/files/event_sponsers/1716970955event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:22:35',
                'updated_at' => '2024-05-29 13:22:35',
                'deleted_at' => NULL,
            ),
            41 => 
            array (
                'id' => 246,
                'event_id' => 210,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716970955png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:22:35',
                'updated_at' => '2024-05-29 13:22:35',
                'deleted_at' => NULL,
            ),
            42 => 
            array (
                'id' => 247,
                'event_id' => 210,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716970955evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:22:35',
                'updated_at' => '2024-05-29 13:22:35',
                'deleted_at' => NULL,
            ),
            43 => 
            array (
                'id' => 248,
                'event_id' => 181,
                'name' => 'Logo',
                'image' => '/files/event_sponsers/1716970985event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:23:05',
                'updated_at' => '2024-06-13 16:43:10',
                'deleted_at' => '2024-06-13 16:43:10',
            ),
            44 => 
            array (
                'id' => 249,
                'event_id' => 181,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716970985png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:23:05',
                'updated_at' => '2024-06-13 16:43:10',
                'deleted_at' => '2024-06-13 16:43:10',
            ),
            45 => 
            array (
                'id' => 250,
                'event_id' => 181,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716970985evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:23:05',
                'updated_at' => '2024-06-13 16:43:10',
                'deleted_at' => '2024-06-13 16:43:10',
            ),
            46 => 
            array (
                'id' => 251,
                'event_id' => 203,
                'name' => 'Logo',
                'image' => '/files/event_sponsers/1716971012event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:23:32',
                'updated_at' => '2024-05-29 13:24:47',
                'deleted_at' => '2024-05-29 13:24:47',
            ),
            47 => 
            array (
                'id' => 252,
                'event_id' => 203,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716971012png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:23:32',
                'updated_at' => '2024-05-29 13:24:47',
                'deleted_at' => '2024-05-29 13:24:47',
            ),
            48 => 
            array (
                'id' => 253,
                'event_id' => 203,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716971012evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:23:32',
                'updated_at' => '2024-05-29 13:24:47',
                'deleted_at' => '2024-05-29 13:24:47',
            ),
            49 => 
            array (
                'id' => 254,
                'event_id' => 203,
                'name' => 'Logo',
                'image' => '/files/event_sponsers/1716971087event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:24:47',
                'updated_at' => '2024-06-13 16:44:55',
                'deleted_at' => '2024-06-13 16:44:55',
            ),
            50 => 
            array (
                'id' => 255,
                'event_id' => 203,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716971087png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:24:47',
                'updated_at' => '2024-06-13 16:44:55',
                'deleted_at' => '2024-06-13 16:44:55',
            ),
            51 => 
            array (
                'id' => 256,
                'event_id' => 203,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716971087evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:24:47',
                'updated_at' => '2024-06-13 16:44:55',
                'deleted_at' => '2024-06-13 16:44:55',
            ),
            52 => 
            array (
                'id' => 257,
                'event_id' => 208,
                'name' => 'teacher',
                'image' => '/files/event_sponsers/1716971185event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:26:25',
                'updated_at' => '2024-05-29 13:27:35',
                'deleted_at' => '2024-05-29 13:27:35',
            ),
            53 => 
            array (
                'id' => 258,
                'event_id' => 208,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716971185png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:26:25',
                'updated_at' => '2024-05-29 13:27:35',
                'deleted_at' => '2024-05-29 13:27:35',
            ),
            54 => 
            array (
                'id' => 259,
                'event_id' => 208,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716971185evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:26:25',
                'updated_at' => '2024-05-29 13:27:35',
                'deleted_at' => '2024-05-29 13:27:35',
            ),
            55 => 
            array (
                'id' => 260,
                'event_id' => 208,
                'name' => 'teacher',
                'image' => '/files/event_sponsers/1716971255event-management-logos-20.jpg',
                'created_at' => '2024-05-29 13:27:35',
                'updated_at' => '2024-05-29 13:27:35',
                'deleted_at' => NULL,
            ),
            56 => 
            array (
                'id' => 261,
                'event_id' => 208,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1716971255png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 13:27:35',
                'updated_at' => '2024-05-29 13:27:35',
                'deleted_at' => NULL,
            ),
            57 => 
            array (
                'id' => 262,
                'event_id' => 208,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1716971255evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 13:27:35',
                'updated_at' => '2024-05-29 13:27:35',
                'deleted_at' => NULL,
            ),
            58 => 
            array (
                'id' => 263,
                'event_id' => 185,
                'name' => 'Logo',
                'image' => '/files/event_sponsers/17169944141716970083event-management-logos-20.jpg',
                'created_at' => '2024-05-29 19:53:34',
                'updated_at' => '2024-06-13 16:46:44',
                'deleted_at' => '2024-06-13 16:46:44',
            ),
            59 => 
            array (
                'id' => 264,
                'event_id' => 185,
                'name' => 'logo',
                'image' => '/files/event_sponsers/17169944141716970083png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 19:53:34',
                'updated_at' => '2024-06-13 16:46:44',
                'deleted_at' => '2024-06-13 16:46:44',
            ),
            60 => 
            array (
                'id' => 265,
                'event_id' => 185,
                'name' => 'logo',
                'image' => '/files/event_sponsers/17169944141716970083evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 19:53:34',
                'updated_at' => '2024-06-13 16:46:44',
                'deleted_at' => '2024-06-13 16:46:44',
            ),
            61 => 
            array (
                'id' => 266,
                'event_id' => 200,
                'name' => 'Logo',
                'image' => '/files/event_sponsers/17169945491716970083event-management-logos-20.jpg',
                'created_at' => '2024-05-29 19:55:49',
                'updated_at' => '2024-05-30 18:39:09',
                'deleted_at' => '2024-05-30 18:39:09',
            ),
            62 => 
            array (
                'id' => 267,
                'event_id' => 200,
                'name' => 'logo',
                'image' => '/files/event_sponsers/17169945491716970083png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-29 19:55:49',
                'updated_at' => '2024-05-30 18:39:09',
                'deleted_at' => '2024-05-30 18:39:09',
            ),
            63 => 
            array (
                'id' => 268,
                'event_id' => 200,
                'name' => 'logo',
                'image' => '/files/event_sponsers/17169945491716970083evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-29 19:55:49',
                'updated_at' => '2024-05-30 18:39:09',
                'deleted_at' => '2024-05-30 18:39:09',
            ),
            64 => 
            array (
                'id' => 269,
                'event_id' => 144,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076319event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:38:39',
                'updated_at' => '2024-06-11 15:36:11',
                'deleted_at' => '2024-06-11 15:36:11',
            ),
            65 => 
            array (
                'id' => 270,
                'event_id' => 144,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717076319png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:38:39',
                'updated_at' => '2024-06-11 15:36:11',
                'deleted_at' => '2024-06-11 15:36:11',
            ),
            66 => 
            array (
                'id' => 271,
                'event_id' => 144,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076319evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:38:39',
                'updated_at' => '2024-06-11 15:36:11',
                'deleted_at' => '2024-06-11 15:36:11',
            ),
            67 => 
            array (
                'id' => 272,
                'event_id' => 200,
                'name' => 'Logo',
                'image' => '/files/event_sponsers/1717076349event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:39:09',
                'updated_at' => '2024-05-30 18:39:09',
                'deleted_at' => NULL,
            ),
            68 => 
            array (
                'id' => 273,
                'event_id' => 200,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076349png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:39:09',
                'updated_at' => '2024-05-30 18:39:09',
                'deleted_at' => NULL,
            ),
            69 => 
            array (
                'id' => 274,
                'event_id' => 200,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076349evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:39:09',
                'updated_at' => '2024-05-30 18:39:09',
                'deleted_at' => NULL,
            ),
            70 => 
            array (
                'id' => 275,
                'event_id' => 205,
                'name' => 'Logo',
                'image' => '/files/event_sponsers/1717076395event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:39:55',
                'updated_at' => '2024-05-30 18:39:55',
                'deleted_at' => NULL,
            ),
            71 => 
            array (
                'id' => 276,
                'event_id' => 205,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717076395evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:39:55',
                'updated_at' => '2024-05-30 18:39:55',
                'deleted_at' => NULL,
            ),
            72 => 
            array (
                'id' => 277,
                'event_id' => 205,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076395png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:39:55',
                'updated_at' => '2024-05-30 18:39:55',
                'deleted_at' => NULL,
            ),
            73 => 
            array (
                'id' => 278,
                'event_id' => 26,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076444event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:40:44',
                'updated_at' => '2024-05-30 18:40:44',
                'deleted_at' => NULL,
            ),
            74 => 
            array (
                'id' => 279,
                'event_id' => 26,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717076444png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:40:44',
                'updated_at' => '2024-05-30 18:40:44',
                'deleted_at' => NULL,
            ),
            75 => 
            array (
                'id' => 280,
                'event_id' => 26,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076444evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:40:44',
                'updated_at' => '2024-05-30 18:40:44',
                'deleted_at' => NULL,
            ),
            76 => 
            array (
                'id' => 281,
                'event_id' => 115,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717076476event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:41:16',
                'updated_at' => '2024-06-07 18:04:53',
                'deleted_at' => '2024-06-07 18:04:53',
            ),
            77 => 
            array (
                'id' => 282,
                'event_id' => 115,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717076476png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:41:16',
                'updated_at' => '2024-06-07 18:04:53',
                'deleted_at' => '2024-06-07 18:04:53',
            ),
            78 => 
            array (
                'id' => 283,
                'event_id' => 115,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076476evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:41:16',
                'updated_at' => '2024-06-07 18:04:53',
                'deleted_at' => '2024-06-07 18:04:53',
            ),
            79 => 
            array (
                'id' => 284,
                'event_id' => 119,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717076510event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:41:50',
                'updated_at' => '2024-06-12 16:51:13',
                'deleted_at' => '2024-06-12 16:51:13',
            ),
            80 => 
            array (
                'id' => 285,
                'event_id' => 119,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717076510png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:41:50',
                'updated_at' => '2024-06-12 16:51:13',
                'deleted_at' => '2024-06-12 16:51:13',
            ),
            81 => 
            array (
                'id' => 286,
                'event_id' => 119,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076510evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:41:50',
                'updated_at' => '2024-06-12 16:51:13',
                'deleted_at' => '2024-06-12 16:51:13',
            ),
            82 => 
            array (
                'id' => 287,
                'event_id' => 123,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076538event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:42:18',
                'updated_at' => '2024-05-30 18:42:18',
                'deleted_at' => NULL,
            ),
            83 => 
            array (
                'id' => 288,
                'event_id' => 123,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717076538png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:42:18',
                'updated_at' => '2024-05-30 18:42:18',
                'deleted_at' => NULL,
            ),
            84 => 
            array (
                'id' => 289,
                'event_id' => 123,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076538evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:42:18',
                'updated_at' => '2024-05-30 18:42:18',
                'deleted_at' => NULL,
            ),
            85 => 
            array (
                'id' => 290,
                'event_id' => 214,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076572event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:42:52',
                'updated_at' => '2024-06-13 16:03:15',
                'deleted_at' => '2024-06-13 16:03:15',
            ),
            86 => 
            array (
                'id' => 291,
                'event_id' => 214,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717076572png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:42:52',
                'updated_at' => '2024-06-13 16:03:15',
                'deleted_at' => '2024-06-13 16:03:15',
            ),
            87 => 
            array (
                'id' => 292,
                'event_id' => 214,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076572evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:42:52',
                'updated_at' => '2024-06-13 16:03:15',
                'deleted_at' => '2024-06-13 16:03:15',
            ),
            88 => 
            array (
                'id' => 293,
                'event_id' => 215,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076602event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:43:22',
                'updated_at' => '2024-06-13 16:07:42',
                'deleted_at' => '2024-06-13 16:07:42',
            ),
            89 => 
            array (
                'id' => 294,
                'event_id' => 215,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717076602png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:43:22',
                'updated_at' => '2024-06-13 16:07:42',
                'deleted_at' => '2024-06-13 16:07:42',
            ),
            90 => 
            array (
                'id' => 295,
                'event_id' => 215,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076602evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:43:22',
                'updated_at' => '2024-06-13 16:07:42',
                'deleted_at' => '2024-06-13 16:07:42',
            ),
            91 => 
            array (
                'id' => 296,
                'event_id' => 218,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717076630event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:43:50',
                'updated_at' => '2024-06-13 16:11:23',
                'deleted_at' => '2024-06-13 16:11:23',
            ),
            92 => 
            array (
                'id' => 297,
                'event_id' => 218,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717076630png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:43:50',
                'updated_at' => '2024-06-13 16:11:23',
                'deleted_at' => '2024-06-13 16:11:23',
            ),
            93 => 
            array (
                'id' => 298,
                'event_id' => 218,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076630evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:43:50',
                'updated_at' => '2024-06-13 16:11:23',
                'deleted_at' => '2024-06-13 16:11:23',
            ),
            94 => 
            array (
                'id' => 299,
                'event_id' => 220,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076660event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:44:20',
                'updated_at' => '2024-05-30 18:44:20',
                'deleted_at' => NULL,
            ),
            95 => 
            array (
                'id' => 300,
                'event_id' => 220,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717076660png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:44:20',
                'updated_at' => '2024-05-30 18:44:20',
                'deleted_at' => NULL,
            ),
            96 => 
            array (
                'id' => 301,
                'event_id' => 220,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076660evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:44:20',
                'updated_at' => '2024-05-30 18:44:20',
                'deleted_at' => NULL,
            ),
            97 => 
            array (
                'id' => 302,
                'event_id' => 222,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717076686event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:44:46',
                'updated_at' => '2024-05-30 18:44:46',
                'deleted_at' => NULL,
            ),
            98 => 
            array (
                'id' => 303,
                'event_id' => 222,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717076686png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:44:46',
                'updated_at' => '2024-05-30 18:44:46',
                'deleted_at' => NULL,
            ),
            99 => 
            array (
                'id' => 304,
                'event_id' => 222,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076686evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:44:46',
                'updated_at' => '2024-05-30 18:44:46',
                'deleted_at' => NULL,
            ),
        ));
        \DB::table('event_sponsers')->insert(array (
            0 => 
            array (
                'id' => 305,
                'event_id' => 224,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717076731event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:45:31',
                'updated_at' => '2024-05-30 18:45:31',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 306,
                'event_id' => 224,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717076731png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:45:31',
                'updated_at' => '2024-05-30 18:45:31',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 307,
                'event_id' => 224,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076731evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:45:31',
                'updated_at' => '2024-05-30 18:45:31',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 308,
                'event_id' => 229,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717076765event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:46:05',
                'updated_at' => '2024-05-30 18:46:05',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 309,
                'event_id' => 229,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717076765png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:46:05',
                'updated_at' => '2024-05-30 18:46:05',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 310,
                'event_id' => 229,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076765evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:46:05',
                'updated_at' => '2024-05-30 18:46:05',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 311,
                'event_id' => 232,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717076798event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:46:38',
                'updated_at' => '2024-06-11 15:34:35',
                'deleted_at' => '2024-06-11 15:34:35',
            ),
            7 => 
            array (
                'id' => 312,
                'event_id' => 232,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717076798png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:46:38',
                'updated_at' => '2024-06-11 15:34:35',
                'deleted_at' => '2024-06-11 15:34:35',
            ),
            8 => 
            array (
                'id' => 313,
                'event_id' => 232,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076798evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:46:38',
                'updated_at' => '2024-06-11 15:34:35',
                'deleted_at' => '2024-06-11 15:34:35',
            ),
            9 => 
            array (
                'id' => 314,
                'event_id' => 235,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717076828event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:47:08',
                'updated_at' => '2024-05-30 18:47:08',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 315,
                'event_id' => 235,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717076828png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:47:08',
                'updated_at' => '2024-05-30 18:47:08',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 316,
                'event_id' => 235,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076828evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:47:08',
                'updated_at' => '2024-05-30 18:47:08',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 317,
                'event_id' => 238,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717076857event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:47:37',
                'updated_at' => '2024-05-30 18:47:37',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 318,
                'event_id' => 238,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717076857png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:47:37',
                'updated_at' => '2024-05-30 18:47:37',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 319,
                'event_id' => 238,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076857evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:47:37',
                'updated_at' => '2024-05-30 18:47:37',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 320,
                'event_id' => 241,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717076888event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:48:08',
                'updated_at' => '2024-05-30 18:48:08',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 321,
                'event_id' => 241,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717076888png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:48:08',
                'updated_at' => '2024-05-30 18:48:08',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 322,
                'event_id' => 241,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076888evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:48:08',
                'updated_at' => '2024-05-30 18:48:08',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 323,
                'event_id' => 244,
                'name' => 'BankAlfla',
                'image' => '/files/event_sponsers/1717076924event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:48:44',
                'updated_at' => '2024-05-30 18:48:44',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 324,
                'event_id' => 244,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717076924png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:48:44',
                'updated_at' => '2024-05-30 18:48:44',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 325,
                'event_id' => 244,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076924evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:48:44',
                'updated_at' => '2024-05-30 18:48:44',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 326,
                'event_id' => 246,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717076973event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:49:33',
                'updated_at' => '2024-05-30 18:49:33',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 327,
                'event_id' => 246,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717076973png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:49:33',
                'updated_at' => '2024-05-30 18:49:33',
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 328,
                'event_id' => 246,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076973evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:49:33',
                'updated_at' => '2024-05-30 18:49:33',
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 329,
                'event_id' => 249,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717077003event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:50:03',
                'updated_at' => '2024-05-30 18:50:03',
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 330,
                'event_id' => 249,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717077003png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:50:03',
                'updated_at' => '2024-05-30 18:50:03',
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 331,
                'event_id' => 249,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077003evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:50:03',
                'updated_at' => '2024-05-30 18:50:03',
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 332,
                'event_id' => 251,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717077037event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:50:37',
                'updated_at' => '2024-05-30 18:50:37',
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 333,
                'event_id' => 251,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717077037png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:50:37',
                'updated_at' => '2024-05-30 18:50:37',
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 334,
                'event_id' => 251,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077037evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:50:37',
                'updated_at' => '2024-05-30 18:50:37',
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 335,
                'event_id' => 252,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717077069event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:51:09',
                'updated_at' => '2024-05-30 18:51:09',
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 336,
                'event_id' => 252,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717077069png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:51:09',
                'updated_at' => '2024-05-30 18:51:09',
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 337,
                'event_id' => 252,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077069evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:51:09',
                'updated_at' => '2024-05-30 18:51:09',
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 338,
                'event_id' => 253,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717077102event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:51:42',
                'updated_at' => '2024-05-30 18:51:42',
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 339,
                'event_id' => 253,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717077102png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:51:42',
                'updated_at' => '2024-05-30 18:51:42',
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 340,
                'event_id' => 253,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077102evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:51:42',
                'updated_at' => '2024-05-30 18:51:42',
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 341,
                'event_id' => 25,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717077136event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:52:16',
                'updated_at' => '2024-05-30 18:52:16',
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'id' => 342,
                'event_id' => 25,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717077136png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:52:16',
                'updated_at' => '2024-05-30 18:52:16',
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'id' => 343,
                'event_id' => 25,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077136evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:52:16',
                'updated_at' => '2024-05-30 18:52:16',
                'deleted_at' => NULL,
            ),
            39 => 
            array (
                'id' => 344,
                'event_id' => 114,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717077168event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:52:48',
                'updated_at' => '2024-06-07 18:09:04',
                'deleted_at' => '2024-06-07 18:09:04',
            ),
            40 => 
            array (
                'id' => 345,
                'event_id' => 114,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717077168png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:52:48',
                'updated_at' => '2024-06-07 18:09:04',
                'deleted_at' => '2024-06-07 18:09:04',
            ),
            41 => 
            array (
                'id' => 346,
                'event_id' => 114,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077168evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:52:48',
                'updated_at' => '2024-06-07 18:09:04',
                'deleted_at' => '2024-06-07 18:09:04',
            ),
            42 => 
            array (
                'id' => 347,
                'event_id' => 118,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077198event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:53:18',
                'updated_at' => '2024-06-12 16:53:04',
                'deleted_at' => '2024-06-12 16:53:04',
            ),
            43 => 
            array (
                'id' => 348,
                'event_id' => 118,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717077198png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:53:18',
                'updated_at' => '2024-06-12 16:53:04',
                'deleted_at' => '2024-06-12 16:53:04',
            ),
            44 => 
            array (
                'id' => 349,
                'event_id' => 118,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077198evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:53:18',
                'updated_at' => '2024-06-12 16:53:04',
                'deleted_at' => '2024-06-12 16:53:04',
            ),
            45 => 
            array (
                'id' => 350,
                'event_id' => 122,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077226event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:53:46',
                'updated_at' => '2024-05-30 18:54:18',
                'deleted_at' => '2024-05-30 18:54:18',
            ),
            46 => 
            array (
                'id' => 351,
                'event_id' => 122,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717077226png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:53:46',
                'updated_at' => '2024-05-30 18:54:18',
                'deleted_at' => '2024-05-30 18:54:18',
            ),
            47 => 
            array (
                'id' => 352,
                'event_id' => 122,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077226evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:53:46',
                'updated_at' => '2024-05-30 18:54:18',
                'deleted_at' => '2024-05-30 18:54:18',
            ),
            48 => 
            array (
                'id' => 353,
                'event_id' => 122,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077258event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:54:18',
                'updated_at' => '2024-05-30 18:54:18',
                'deleted_at' => NULL,
            ),
            49 => 
            array (
                'id' => 354,
                'event_id' => 122,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717077258png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:54:18',
                'updated_at' => '2024-05-30 18:54:18',
                'deleted_at' => NULL,
            ),
            50 => 
            array (
                'id' => 355,
                'event_id' => 122,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077258evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:54:18',
                'updated_at' => '2024-05-30 18:54:18',
                'deleted_at' => NULL,
            ),
            51 => 
            array (
                'id' => 356,
                'event_id' => 227,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717077304event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:55:04',
                'updated_at' => '2024-05-30 18:55:04',
                'deleted_at' => NULL,
            ),
            52 => 
            array (
                'id' => 357,
                'event_id' => 227,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717077304png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:55:04',
                'updated_at' => '2024-05-30 18:55:04',
                'deleted_at' => NULL,
            ),
            53 => 
            array (
                'id' => 358,
                'event_id' => 227,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077304evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:55:04',
                'updated_at' => '2024-05-30 18:55:04',
                'deleted_at' => NULL,
            ),
            54 => 
            array (
                'id' => 359,
                'event_id' => 230,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717077335event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:55:35',
                'updated_at' => '2024-05-30 18:55:35',
                'deleted_at' => NULL,
            ),
            55 => 
            array (
                'id' => 360,
                'event_id' => 230,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717077335png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:55:35',
                'updated_at' => '2024-05-30 18:55:35',
                'deleted_at' => NULL,
            ),
            56 => 
            array (
                'id' => 361,
                'event_id' => 230,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077335evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:55:35',
                'updated_at' => '2024-05-30 18:55:35',
                'deleted_at' => NULL,
            ),
            57 => 
            array (
                'id' => 362,
                'event_id' => 233,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717077367event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:56:07',
                'updated_at' => '2024-05-30 18:56:07',
                'deleted_at' => NULL,
            ),
            58 => 
            array (
                'id' => 363,
                'event_id' => 233,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717077367png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:56:07',
                'updated_at' => '2024-05-30 18:56:07',
                'deleted_at' => NULL,
            ),
            59 => 
            array (
                'id' => 364,
                'event_id' => 233,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077367evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:56:07',
                'updated_at' => '2024-05-30 18:56:07',
                'deleted_at' => NULL,
            ),
            60 => 
            array (
                'id' => 365,
                'event_id' => 239,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717077399event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:56:39',
                'updated_at' => '2024-05-30 18:56:39',
                'deleted_at' => NULL,
            ),
            61 => 
            array (
                'id' => 366,
                'event_id' => 239,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717077399png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:56:39',
                'updated_at' => '2024-05-30 18:56:39',
                'deleted_at' => NULL,
            ),
            62 => 
            array (
                'id' => 367,
                'event_id' => 239,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077399evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:56:39',
                'updated_at' => '2024-05-30 18:56:39',
                'deleted_at' => NULL,
            ),
            63 => 
            array (
                'id' => 368,
                'event_id' => 242,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717077441event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:57:21',
                'updated_at' => '2024-05-30 18:57:21',
                'deleted_at' => NULL,
            ),
            64 => 
            array (
                'id' => 369,
                'event_id' => 242,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717077441png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:57:21',
                'updated_at' => '2024-05-30 18:57:21',
                'deleted_at' => NULL,
            ),
            65 => 
            array (
                'id' => 370,
                'event_id' => 242,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077441evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:57:21',
                'updated_at' => '2024-05-30 18:57:21',
                'deleted_at' => NULL,
            ),
            66 => 
            array (
                'id' => 371,
                'event_id' => 247,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717077479event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:57:59',
                'updated_at' => '2024-05-30 18:57:59',
                'deleted_at' => NULL,
            ),
            67 => 
            array (
                'id' => 372,
                'event_id' => 247,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717077479png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:57:59',
                'updated_at' => '2024-05-30 18:57:59',
                'deleted_at' => NULL,
            ),
            68 => 
            array (
                'id' => 373,
                'event_id' => 247,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077479evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:57:59',
                'updated_at' => '2024-05-30 18:57:59',
                'deleted_at' => NULL,
            ),
            69 => 
            array (
                'id' => 374,
                'event_id' => 28,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077516event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:58:36',
                'updated_at' => '2024-06-13 16:48:45',
                'deleted_at' => '2024-06-13 16:48:45',
            ),
            70 => 
            array (
                'id' => 375,
                'event_id' => 28,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717077516png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:58:36',
                'updated_at' => '2024-06-13 16:48:45',
                'deleted_at' => '2024-06-13 16:48:45',
            ),
            71 => 
            array (
                'id' => 376,
                'event_id' => 28,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077516evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:58:36',
                'updated_at' => '2024-06-13 16:48:45',
                'deleted_at' => '2024-06-13 16:48:45',
            ),
            72 => 
            array (
                'id' => 377,
                'event_id' => 202,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077547event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:59:07',
                'updated_at' => '2024-06-13 16:50:29',
                'deleted_at' => '2024-06-13 16:50:29',
            ),
            73 => 
            array (
                'id' => 378,
                'event_id' => 202,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717077547png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:59:07',
                'updated_at' => '2024-06-13 16:50:29',
                'deleted_at' => '2024-06-13 16:50:29',
            ),
            74 => 
            array (
                'id' => 379,
                'event_id' => 202,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077547evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:59:07',
                'updated_at' => '2024-06-13 16:50:29',
                'deleted_at' => '2024-06-13 16:50:29',
            ),
            75 => 
            array (
                'id' => 380,
                'event_id' => 204,
                'name' => 'Logo',
                'image' => '/files/event_sponsers/1717077574event-management-logos-20.jpg',
                'created_at' => '2024-05-30 18:59:34',
                'updated_at' => '2024-05-30 18:59:34',
                'deleted_at' => NULL,
            ),
            76 => 
            array (
                'id' => 381,
                'event_id' => 204,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717077574png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 18:59:34',
                'updated_at' => '2024-05-30 18:59:34',
                'deleted_at' => NULL,
            ),
            77 => 
            array (
                'id' => 382,
                'event_id' => 204,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077574evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 18:59:34',
                'updated_at' => '2024-05-30 18:59:34',
                'deleted_at' => NULL,
            ),
            78 => 
            array (
                'id' => 383,
                'event_id' => 206,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077605event-management-logos-20.jpg',
                'created_at' => '2024-05-30 19:00:05',
                'updated_at' => '2024-06-13 16:52:38',
                'deleted_at' => '2024-06-13 16:52:38',
            ),
            79 => 
            array (
                'id' => 384,
                'event_id' => 206,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717077605png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-05-30 19:00:05',
                'updated_at' => '2024-06-13 16:52:38',
                'deleted_at' => '2024-06-13 16:52:38',
            ),
            80 => 
            array (
                'id' => 385,
                'event_id' => 206,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077605evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-05-30 19:00:05',
                'updated_at' => '2024-06-13 16:52:38',
                'deleted_at' => '2024-06-13 16:52:38',
            ),
            81 => 
            array (
                'id' => 386,
                'event_id' => 115,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717765493DeWatermark.ai_1717765379433.png',
                'created_at' => '2024-06-07 18:04:53',
                'updated_at' => '2024-06-07 18:05:50',
                'deleted_at' => '2024-06-07 18:05:50',
            ),
            82 => 
            array (
                'id' => 387,
                'event_id' => 115,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717076476png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-07 18:04:53',
                'updated_at' => '2024-06-07 18:05:50',
                'deleted_at' => '2024-06-07 18:05:50',
            ),
            83 => 
            array (
                'id' => 388,
                'event_id' => 115,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076476evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-07 18:04:53',
                'updated_at' => '2024-06-07 18:05:50',
                'deleted_at' => '2024-06-07 18:05:50',
            ),
            84 => 
            array (
                'id' => 389,
                'event_id' => 115,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717765550DeWatermark.ai_1717765379433.png',
                'created_at' => '2024-06-07 18:05:50',
                'updated_at' => '2024-06-07 18:06:27',
                'deleted_at' => '2024-06-07 18:06:27',
            ),
            85 => 
            array (
                'id' => 390,
                'event_id' => 115,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717076476png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-07 18:05:50',
                'updated_at' => '2024-06-07 18:06:27',
                'deleted_at' => '2024-06-07 18:06:27',
            ),
            86 => 
            array (
                'id' => 391,
                'event_id' => 115,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076476evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-07 18:05:50',
                'updated_at' => '2024-06-07 18:06:27',
                'deleted_at' => '2024-06-07 18:06:27',
            ),
            87 => 
            array (
                'id' => 392,
                'event_id' => 115,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717765587DeWatermark.ai_1717765379433.png',
                'created_at' => '2024-06-07 18:06:27',
                'updated_at' => '2024-06-07 18:14:54',
                'deleted_at' => '2024-06-07 18:14:54',
            ),
            88 => 
            array (
                'id' => 393,
                'event_id' => 115,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717076476png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-07 18:06:27',
                'updated_at' => '2024-06-07 18:14:54',
                'deleted_at' => '2024-06-07 18:14:54',
            ),
            89 => 
            array (
                'id' => 394,
                'event_id' => 115,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717076476evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-07 18:06:27',
                'updated_at' => '2024-06-07 18:14:54',
                'deleted_at' => '2024-06-07 18:14:54',
            ),
            90 => 
            array (
                'id' => 395,
                'event_id' => 114,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717077168event-management-logos-20.jpg',
                'created_at' => '2024-06-07 18:09:04',
                'updated_at' => '2024-06-12 16:44:46',
                'deleted_at' => '2024-06-12 16:44:46',
            ),
            91 => 
            array (
                'id' => 396,
                'event_id' => 114,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717077168png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-07 18:09:04',
                'updated_at' => '2024-06-12 16:44:46',
                'deleted_at' => '2024-06-12 16:44:46',
            ),
            92 => 
            array (
                'id' => 397,
                'event_id' => 114,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717077168evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-07 18:09:04',
                'updated_at' => '2024-06-12 16:44:46',
                'deleted_at' => '2024-06-12 16:44:46',
            ),
            93 => 
            array (
                'id' => 398,
                'event_id' => 115,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1717766094evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-07 18:14:54',
                'updated_at' => '2024-06-07 18:14:54',
                'deleted_at' => NULL,
            ),
            94 => 
            array (
                'id' => 399,
                'event_id' => 115,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717766094event-management-logos-20.jpg',
                'created_at' => '2024-06-07 18:14:54',
                'updated_at' => '2024-06-07 18:14:54',
                'deleted_at' => NULL,
            ),
            95 => 
            array (
                'id' => 400,
                'event_id' => 115,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717766094png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-07 18:14:54',
                'updated_at' => '2024-06-07 18:14:54',
                'deleted_at' => NULL,
            ),
            96 => 
            array (
                'id' => 401,
                'event_id' => 113,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717766233evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-07 18:17:13',
                'updated_at' => '2024-06-12 16:00:29',
                'deleted_at' => '2024-06-12 16:00:29',
            ),
            97 => 
            array (
                'id' => 402,
                'event_id' => 113,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1717766233event-management-logos-20.jpg',
                'created_at' => '2024-06-07 18:17:13',
                'updated_at' => '2024-06-12 16:00:29',
                'deleted_at' => '2024-06-12 16:00:29',
            ),
            98 => 
            array (
                'id' => 403,
                'event_id' => 113,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1717766233png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-07 18:17:13',
                'updated_at' => '2024-06-12 16:00:29',
                'deleted_at' => '2024-06-12 16:00:29',
            ),
            99 => 
            array (
                'id' => 404,
                'event_id' => 255,
                'name' => 'adssafdsad',
                'image' => '/files/event_sponsers/1718093127event-management-logos-20.jpg',
                'created_at' => '2024-06-11 13:05:27',
                'updated_at' => '2024-06-11 13:06:20',
                'deleted_at' => '2024-06-11 13:06:20',
            ),
        ));
        \DB::table('event_sponsers')->insert(array (
            0 => 
            array (
                'id' => 405,
                'event_id' => 255,
                'name' => 'adssafdsad',
                'image' => '/files/event_sponsers/1718093180istockphoto-1746790161-612x612.jpg',
                'created_at' => '2024-06-11 13:06:20',
                'updated_at' => '2024-06-11 13:07:39',
                'deleted_at' => '2024-06-11 13:07:39',
            ),
            1 => 
            array (
                'id' => 406,
                'event_id' => 255,
                'name' => 'adssafdsad',
                'image' => '/files/event_sponsers/1718093180istockphoto-1746790161-612x612.jpg',
                'created_at' => '2024-06-11 13:07:39',
                'updated_at' => '2024-06-11 13:08:31',
                'deleted_at' => '2024-06-11 13:08:31',
            ),
            2 => 
            array (
                'id' => 407,
                'event_id' => 255,
                'name' => 'adssafdsad',
                'image' => '/files/event_sponsers/1718093180istockphoto-1746790161-612x612.jpg',
                'created_at' => '2024-06-11 13:08:31',
                'updated_at' => '2024-06-11 13:08:31',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 417,
                'event_id' => 217,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718102006event-management-logos-20.jpg',
                'created_at' => '2024-06-11 15:33:26',
                'updated_at' => '2024-06-13 16:09:50',
                'deleted_at' => '2024-06-13 16:09:50',
            ),
            4 => 
            array (
                'id' => 418,
                'event_id' => 217,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718102006evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-11 15:33:26',
                'updated_at' => '2024-06-13 16:09:50',
                'deleted_at' => '2024-06-13 16:09:50',
            ),
            5 => 
            array (
                'id' => 419,
                'event_id' => 217,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718102006png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-11 15:33:26',
                'updated_at' => '2024-06-13 16:09:50',
                'deleted_at' => '2024-06-13 16:09:50',
            ),
            6 => 
            array (
                'id' => 420,
                'event_id' => 232,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1718102075evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-11 15:34:35',
                'updated_at' => '2024-06-11 15:34:35',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 421,
                'event_id' => 232,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718102075event-management-logos-20.jpg',
                'created_at' => '2024-06-11 15:34:35',
                'updated_at' => '2024-06-11 15:34:35',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 422,
                'event_id' => 232,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718102075png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-11 15:34:35',
                'updated_at' => '2024-06-11 15:34:35',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 423,
                'event_id' => 144,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718102171evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-11 15:36:11',
                'updated_at' => '2024-06-13 16:39:26',
                'deleted_at' => '2024-06-13 16:39:26',
            ),
            10 => 
            array (
                'id' => 424,
                'event_id' => 144,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718102171event-management-logos-20.jpg',
                'created_at' => '2024-06-11 15:36:11',
                'updated_at' => '2024-06-13 16:39:26',
                'deleted_at' => '2024-06-13 16:39:26',
            ),
            11 => 
            array (
                'id' => 425,
                'event_id' => 144,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718102171png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-11 15:36:11',
                'updated_at' => '2024-06-13 16:39:26',
                'deleted_at' => '2024-06-13 16:39:26',
            ),
            12 => 
            array (
                'id' => 426,
                'event_id' => 113,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718190029evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-12 16:00:29',
                'updated_at' => '2024-06-12 16:00:29',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 427,
                'event_id' => 113,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718190029event-management-logos-20.jpg',
                'created_at' => '2024-06-12 16:00:29',
                'updated_at' => '2024-06-12 16:00:29',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 428,
                'event_id' => 113,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718190029png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-12 16:00:29',
                'updated_at' => '2024-06-12 16:00:29',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 429,
                'event_id' => 114,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1718192686evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-12 16:44:46',
                'updated_at' => '2024-06-12 16:44:46',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 430,
                'event_id' => 114,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718192686png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-12 16:44:46',
                'updated_at' => '2024-06-12 16:44:46',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 431,
                'event_id' => 114,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718192686event-management-logos-20.jpg',
                'created_at' => '2024-06-12 16:44:46',
                'updated_at' => '2024-06-12 16:44:46',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 432,
                'event_id' => 117,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718192964evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-12 16:49:24',
                'updated_at' => '2024-06-12 16:49:24',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 433,
                'event_id' => 117,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718192964event-management-logos-20.jpg',
                'created_at' => '2024-06-12 16:49:24',
                'updated_at' => '2024-06-12 16:49:24',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 434,
                'event_id' => 117,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718192964png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-12 16:49:24',
                'updated_at' => '2024-06-12 16:49:24',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 435,
                'event_id' => 119,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1718193073event-management-logos-20.jpg',
                'created_at' => '2024-06-12 16:51:13',
                'updated_at' => '2024-06-12 16:51:13',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 436,
                'event_id' => 119,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718193073png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-12 16:51:13',
                'updated_at' => '2024-06-12 16:51:13',
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 437,
                'event_id' => 119,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718193073evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-12 16:51:13',
                'updated_at' => '2024-06-12 16:51:13',
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 438,
                'event_id' => 118,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718193184event-management-logos-20.jpg',
                'created_at' => '2024-06-12 16:53:04',
                'updated_at' => '2024-06-12 16:53:04',
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 439,
                'event_id' => 118,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718193184png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-12 16:53:04',
                'updated_at' => '2024-06-12 16:53:04',
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 440,
                'event_id' => 118,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718193184evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-12 16:53:04',
                'updated_at' => '2024-06-12 16:53:04',
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 441,
                'event_id' => 256,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1718193813event-management-logos-20.jpg',
                'created_at' => '2024-06-12 17:03:33',
                'updated_at' => '2024-06-12 17:03:33',
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 442,
                'event_id' => 256,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718193813evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-12 17:03:33',
                'updated_at' => '2024-06-12 17:03:33',
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 443,
                'event_id' => 256,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718193813png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-12 17:03:33',
                'updated_at' => '2024-06-12 17:03:33',
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 444,
                'event_id' => 257,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718194001evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-12 17:06:41',
                'updated_at' => '2024-06-12 17:06:41',
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 445,
                'event_id' => 257,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718194001event-management-logos-20.jpg',
                'created_at' => '2024-06-12 17:06:41',
                'updated_at' => '2024-06-12 17:06:41',
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 446,
                'event_id' => 257,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718194001png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-12 17:06:41',
                'updated_at' => '2024-06-12 17:06:41',
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 447,
                'event_id' => 128,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1718276502event-management-logos-20.jpg',
                'created_at' => '2024-06-13 16:01:42',
                'updated_at' => '2024-06-13 16:01:42',
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 448,
                'event_id' => 128,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718276502evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-13 16:01:42',
                'updated_at' => '2024-06-13 16:01:42',
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 449,
                'event_id' => 128,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718276502png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-13 16:01:42',
                'updated_at' => '2024-06-13 16:01:42',
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 450,
                'event_id' => 214,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718276595png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-13 16:03:15',
                'updated_at' => '2024-06-13 16:03:15',
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'id' => 451,
                'event_id' => 214,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718276595event-management-logos-20.jpg',
                'created_at' => '2024-06-13 16:03:15',
                'updated_at' => '2024-06-13 16:03:15',
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'id' => 452,
                'event_id' => 214,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718276595evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-13 16:03:15',
                'updated_at' => '2024-06-13 16:03:15',
                'deleted_at' => NULL,
            ),
            39 => 
            array (
                'id' => 453,
                'event_id' => 216,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718276706event-management-logos-20.jpg',
                'created_at' => '2024-06-13 16:05:06',
                'updated_at' => '2024-06-13 16:05:06',
                'deleted_at' => NULL,
            ),
            40 => 
            array (
                'id' => 454,
                'event_id' => 216,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718276706png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-13 16:05:06',
                'updated_at' => '2024-06-13 16:05:06',
                'deleted_at' => NULL,
            ),
            41 => 
            array (
                'id' => 455,
                'event_id' => 216,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718276706evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-13 16:05:06',
                'updated_at' => '2024-06-13 16:05:06',
                'deleted_at' => NULL,
            ),
            42 => 
            array (
                'id' => 456,
                'event_id' => 215,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718276862event-management-logos-20.jpg',
                'created_at' => '2024-06-13 16:07:42',
                'updated_at' => '2024-06-13 16:07:42',
                'deleted_at' => NULL,
            ),
            43 => 
            array (
                'id' => 457,
                'event_id' => 215,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718276862evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-13 16:07:42',
                'updated_at' => '2024-06-13 16:07:42',
                'deleted_at' => NULL,
            ),
            44 => 
            array (
                'id' => 458,
                'event_id' => 215,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718276862png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-13 16:07:42',
                'updated_at' => '2024-06-13 16:07:42',
                'deleted_at' => NULL,
            ),
            45 => 
            array (
                'id' => 459,
                'event_id' => 217,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718276990event-management-logos-20.jpg',
                'created_at' => '2024-06-13 16:09:50',
                'updated_at' => '2024-06-13 16:09:50',
                'deleted_at' => NULL,
            ),
            46 => 
            array (
                'id' => 460,
                'event_id' => 217,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718276990png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-13 16:09:50',
                'updated_at' => '2024-06-13 16:09:50',
                'deleted_at' => NULL,
            ),
            47 => 
            array (
                'id' => 461,
                'event_id' => 217,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718276990evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-13 16:09:50',
                'updated_at' => '2024-06-13 16:09:50',
                'deleted_at' => NULL,
            ),
            48 => 
            array (
                'id' => 462,
                'event_id' => 218,
                'name' => 'legal',
                'image' => '/files/event_sponsers/1718277083event-management-logos-20.jpg',
                'created_at' => '2024-06-13 16:11:23',
                'updated_at' => '2024-06-13 16:11:23',
                'deleted_at' => NULL,
            ),
            49 => 
            array (
                'id' => 463,
                'event_id' => 218,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718277083evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-13 16:11:23',
                'updated_at' => '2024-06-13 16:11:23',
                'deleted_at' => NULL,
            ),
            50 => 
            array (
                'id' => 464,
                'event_id' => 218,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718277083png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-13 16:11:23',
                'updated_at' => '2024-06-13 16:11:23',
                'deleted_at' => NULL,
            ),
            51 => 
            array (
                'id' => 465,
                'event_id' => 219,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718277204event-management-logos-20.jpg',
                'created_at' => '2024-06-13 16:13:24',
                'updated_at' => '2024-06-13 16:13:24',
                'deleted_at' => NULL,
            ),
            52 => 
            array (
                'id' => 466,
                'event_id' => 219,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718277204evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-13 16:13:24',
                'updated_at' => '2024-06-13 16:13:24',
                'deleted_at' => NULL,
            ),
            53 => 
            array (
                'id' => 467,
                'event_id' => 219,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718277204png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-13 16:13:24',
                'updated_at' => '2024-06-13 16:13:24',
                'deleted_at' => NULL,
            ),
            54 => 
            array (
                'id' => 468,
                'event_id' => 10,
                'name' => 'Legitadvisor',
                'image' => '/files/event_sponsers/1718277407event-management-logos-20.jpg',
                'created_at' => '2024-06-13 16:16:47',
                'updated_at' => '2024-06-13 16:16:47',
                'deleted_at' => NULL,
            ),
            55 => 
            array (
                'id' => 469,
                'event_id' => 10,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718277407png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-13 16:16:47',
                'updated_at' => '2024-06-13 16:16:47',
                'deleted_at' => NULL,
            ),
            56 => 
            array (
                'id' => 470,
                'event_id' => 10,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718277407evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-13 16:16:47',
                'updated_at' => '2024-06-13 16:16:47',
                'deleted_at' => NULL,
            ),
            57 => 
            array (
                'id' => 471,
                'event_id' => 24,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718277495event-management-logos-20.jpg',
                'created_at' => '2024-06-13 16:18:15',
                'updated_at' => '2024-06-13 16:18:15',
                'deleted_at' => NULL,
            ),
            58 => 
            array (
                'id' => 472,
                'event_id' => 24,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718277495evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-13 16:18:15',
                'updated_at' => '2024-06-13 16:18:15',
                'deleted_at' => NULL,
            ),
            59 => 
            array (
                'id' => 473,
                'event_id' => 24,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718277495png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-13 16:18:15',
                'updated_at' => '2024-06-13 16:18:15',
                'deleted_at' => NULL,
            ),
            60 => 
            array (
                'id' => 474,
                'event_id' => 121,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718278223event-management-logos-20.jpg',
                'created_at' => '2024-06-13 16:30:23',
                'updated_at' => '2024-06-13 16:30:23',
                'deleted_at' => NULL,
            ),
            61 => 
            array (
                'id' => 475,
                'event_id' => 121,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718278223evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-13 16:30:23',
                'updated_at' => '2024-06-13 16:30:23',
                'deleted_at' => NULL,
            ),
            62 => 
            array (
                'id' => 476,
                'event_id' => 121,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718278223png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-13 16:30:23',
                'updated_at' => '2024-06-13 16:30:23',
                'deleted_at' => NULL,
            ),
            63 => 
            array (
                'id' => 477,
                'event_id' => 132,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718278350event-management-logos-20.jpg',
                'created_at' => '2024-06-13 16:32:30',
                'updated_at' => '2024-06-13 16:32:30',
                'deleted_at' => NULL,
            ),
            64 => 
            array (
                'id' => 478,
                'event_id' => 132,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718278350png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-13 16:32:30',
                'updated_at' => '2024-06-13 16:32:30',
                'deleted_at' => NULL,
            ),
            65 => 
            array (
                'id' => 479,
                'event_id' => 132,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718278350evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-13 16:32:30',
                'updated_at' => '2024-06-13 16:32:30',
                'deleted_at' => NULL,
            ),
            66 => 
            array (
                'id' => 480,
                'event_id' => 136,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718278571event-management-logos-20.jpg',
                'created_at' => '2024-06-13 16:36:11',
                'updated_at' => '2024-06-13 16:36:11',
                'deleted_at' => NULL,
            ),
            67 => 
            array (
                'id' => 481,
                'event_id' => 136,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718278571evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-13 16:36:11',
                'updated_at' => '2024-06-13 16:36:11',
                'deleted_at' => NULL,
            ),
            68 => 
            array (
                'id' => 482,
                'event_id' => 136,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718278571png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-13 16:36:11',
                'updated_at' => '2024-06-13 16:36:11',
                'deleted_at' => NULL,
            ),
            69 => 
            array (
                'id' => 483,
                'event_id' => 140,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718278684event-management-logos-20.jpg',
                'created_at' => '2024-06-13 16:38:04',
                'updated_at' => '2024-06-13 16:38:04',
                'deleted_at' => NULL,
            ),
            70 => 
            array (
                'id' => 484,
                'event_id' => 140,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718278684evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-13 16:38:04',
                'updated_at' => '2024-06-13 16:38:04',
                'deleted_at' => NULL,
            ),
            71 => 
            array (
                'id' => 485,
                'event_id' => 140,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718278684png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-13 16:38:04',
                'updated_at' => '2024-06-13 16:38:04',
                'deleted_at' => NULL,
            ),
            72 => 
            array (
                'id' => 486,
                'event_id' => 144,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718278766event-management-logos-20.jpg',
                'created_at' => '2024-06-13 16:39:26',
                'updated_at' => '2024-06-13 16:39:26',
                'deleted_at' => NULL,
            ),
            73 => 
            array (
                'id' => 487,
                'event_id' => 144,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718278766evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-13 16:39:26',
                'updated_at' => '2024-06-13 16:39:26',
                'deleted_at' => NULL,
            ),
            74 => 
            array (
                'id' => 488,
                'event_id' => 144,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718278766png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-13 16:39:26',
                'updated_at' => '2024-06-13 16:39:26',
                'deleted_at' => NULL,
            ),
            75 => 
            array (
                'id' => 489,
                'event_id' => 148,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718278897event-management-logos-20.jpg',
                'created_at' => '2024-06-13 16:41:37',
                'updated_at' => '2024-06-13 16:41:37',
                'deleted_at' => NULL,
            ),
            76 => 
            array (
                'id' => 490,
                'event_id' => 148,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718278897evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-13 16:41:37',
                'updated_at' => '2024-06-13 16:41:37',
                'deleted_at' => NULL,
            ),
            77 => 
            array (
                'id' => 491,
                'event_id' => 148,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718278897png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-13 16:41:37',
                'updated_at' => '2024-06-13 16:41:37',
                'deleted_at' => NULL,
            ),
            78 => 
            array (
                'id' => 492,
                'event_id' => 181,
                'name' => 'Logo',
                'image' => '/files/event_sponsers/1718278990event-management-logos-20.jpg',
                'created_at' => '2024-06-13 16:43:10',
                'updated_at' => '2024-06-13 16:43:10',
                'deleted_at' => NULL,
            ),
            79 => 
            array (
                'id' => 493,
                'event_id' => 181,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718278990evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-13 16:43:10',
                'updated_at' => '2024-06-13 16:43:10',
                'deleted_at' => NULL,
            ),
            80 => 
            array (
                'id' => 494,
                'event_id' => 181,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718278990png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-13 16:43:10',
                'updated_at' => '2024-06-13 16:43:10',
                'deleted_at' => NULL,
            ),
            81 => 
            array (
                'id' => 495,
                'event_id' => 203,
                'name' => 'Logo',
                'image' => '/files/event_sponsers/1718279095evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-13 16:44:55',
                'updated_at' => '2024-06-13 16:44:55',
                'deleted_at' => NULL,
            ),
            82 => 
            array (
                'id' => 496,
                'event_id' => 203,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718279095event-management-logos-20.jpg',
                'created_at' => '2024-06-13 16:44:55',
                'updated_at' => '2024-06-13 16:44:55',
                'deleted_at' => NULL,
            ),
            83 => 
            array (
                'id' => 497,
                'event_id' => 203,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718279095png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-13 16:44:55',
                'updated_at' => '2024-06-13 16:44:55',
                'deleted_at' => NULL,
            ),
            84 => 
            array (
                'id' => 498,
                'event_id' => 185,
                'name' => 'Logo',
                'image' => '/files/event_sponsers/1718279204event-management-logos-20.jpg',
                'created_at' => '2024-06-13 16:46:44',
                'updated_at' => '2024-06-13 16:46:44',
                'deleted_at' => NULL,
            ),
            85 => 
            array (
                'id' => 499,
                'event_id' => 185,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718279204evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-13 16:46:44',
                'updated_at' => '2024-06-13 16:46:44',
                'deleted_at' => NULL,
            ),
            86 => 
            array (
                'id' => 500,
                'event_id' => 185,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718279204png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-13 16:46:44',
                'updated_at' => '2024-06-13 16:46:44',
                'deleted_at' => NULL,
            ),
            87 => 
            array (
                'id' => 501,
                'event_id' => 28,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718279325event-management-logos-20.jpg',
                'created_at' => '2024-06-13 16:48:45',
                'updated_at' => '2024-06-13 16:48:45',
                'deleted_at' => NULL,
            ),
            88 => 
            array (
                'id' => 502,
                'event_id' => 28,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718279325evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-13 16:48:45',
                'updated_at' => '2024-06-13 16:48:45',
                'deleted_at' => NULL,
            ),
            89 => 
            array (
                'id' => 503,
                'event_id' => 28,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718279325png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-13 16:48:45',
                'updated_at' => '2024-06-13 16:48:45',
                'deleted_at' => NULL,
            ),
            90 => 
            array (
                'id' => 504,
                'event_id' => 202,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718279429event-management-logos-20.jpg',
                'created_at' => '2024-06-13 16:50:29',
                'updated_at' => '2024-06-13 16:50:29',
                'deleted_at' => NULL,
            ),
            91 => 
            array (
                'id' => 505,
                'event_id' => 202,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718279429evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-13 16:50:29',
                'updated_at' => '2024-06-13 16:50:29',
                'deleted_at' => NULL,
            ),
            92 => 
            array (
                'id' => 506,
                'event_id' => 202,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718279429png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-13 16:50:29',
                'updated_at' => '2024-06-13 16:50:29',
                'deleted_at' => NULL,
            ),
            93 => 
            array (
                'id' => 507,
                'event_id' => 206,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718279558event-management-logos-20.jpg',
                'created_at' => '2024-06-13 16:52:38',
                'updated_at' => '2024-06-13 16:52:38',
                'deleted_at' => NULL,
            ),
            94 => 
            array (
                'id' => 508,
                'event_id' => 206,
                'name' => 'uniliver',
                'image' => '/files/event_sponsers/1718279558evendor-s-event-management-logo-54C3C9BA20-seeklogo.com.png',
                'created_at' => '2024-06-13 16:52:38',
                'updated_at' => '2024-06-13 16:52:38',
                'deleted_at' => NULL,
            ),
            95 => 
            array (
                'id' => 509,
                'event_id' => 206,
                'name' => 'logo',
                'image' => '/files/event_sponsers/1718279558png-clipart-winnipeg-transit-logo-management-business-sponsorship-text-service-thumbnail-removebg-preview.png',
                'created_at' => '2024-06-13 16:52:38',
                'updated_at' => '2024-06-13 16:52:38',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}