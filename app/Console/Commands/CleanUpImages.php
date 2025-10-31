<?php

namespace App\Console\Commands;

use App\Models\Academy;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class CleanUpImages extends Command
{
    protected $signature = 'cleanup:images';
    protected $description = 'Delete unused images from the public folder';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $tables = [
            'academies' => 'academies',
            'academy_main_categories' => 'academy_main_categories',
            'academy_categories' => 'academies_categories',
            'broadcasts' => 'academies_broadcasts',
            'broadcasts' => 'academy_broadcasts',
            'certifications' => 'academies_certifications',
            'certifications' => 'academy_certifications',
            'events' => 'academies_events',
            'events' => 'academy_events',
            'archives' => 'academies_archives',
            'archives' => 'academy_archives',
            'posts' => 'academies_posts',
            'posts' => 'academy_posts',
            'podcasts' => 'academies_podcasts',
            'podcasts' => 'academy_podcasts',

            'broadcast_categories' => 'broadcast_categories',
            'broadcasts' => 'broadcasts',
            'archive_categories' => 'archive_categories',
            'archives' => 'archives',
            'podcast_categories' => 'podcast_categories',
            'podcasts' => 'podcasts',
            'event_categories' => 'event_categories',
            'events' => 'events',
            'blog_categories' => 'blog_categories',

            'faq_categories' => 'faq_categories',
            'teachers' => 'teachers',
            'students' => 'students',
            'cities' => 'cities',

            'broadcasts' => 'teacher_broadcasts',
            'archives' => 'teacher_archives',
            'certifications' => 'teacher_certifications',
            'events' => 'teacher_events',
            'company_pages' => 'company_pages',
            'teacher_main_categories' => 'teacher_main_categories',
            'posts' => 'teacher_posts',
            'teacher_categories' => 'teacher_categories',
            'teacher_educations' => 'teacher_educations',
            'teacher_experiences' => 'teacher_experiences',
            'teacher_main_categories' => 'teacher_main_categories',
            'teacher_reviews' => 'teacher_reviews',
            'podcasts' => 'teacher_podcasts',
        ];

        foreach ($tables as $table => $imageColumn) {
            if (Schema::hasTable($table)) {
                $this->cleanUpTableImages($table, $imageColumn);
            } else {
                $this->warn("Table {$table} does not exist.");
            }
        }


        $this->info('Unused images have been deleted successfully.');
    }

    private function cleanUpTableImages($table,$folder)
    {
        $folders = [
            'public/images/' . strtolower($folder),
            'public/files/' . strtolower($folder)
        ];

        foreach ($folders as $folder) {
        if (!File::exists($folder)) {
            $this->warn("Folder {$folder} does not exist.");
            continue;
        }

        $imageColumn = 'image'; // Change this to your actual image column name
        $imagesInUse = DB::table($table)->pluck($imageColumn)->toArray();
        $allImages = File::files($folder);

        foreach ($allImages as $image) {
            $imagePath = $image->getPathname();
            $relativePath = str_replace('public/', '/', $imagePath);
            if (!in_array($relativePath, $imagesInUse)) {
                File::delete($imagePath);

                $this->info("Deleted unused image: {$relativePath}");
            }
        }
    }
}
}
