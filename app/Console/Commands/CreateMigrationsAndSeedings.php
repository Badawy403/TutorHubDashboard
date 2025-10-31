<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateMigrationsAndSeedings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:migrations_and_seedings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command plugin for iseed to seed all databases except migrations table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        // Path to the migrations directory
        $migrationsPath = database_path('migrations');

        // Get all files in the migrations directory
        $files = glob($migrationsPath . '/*.php');

        foreach ($files as $file) {
            // Check if the file exists and is a file (not a directory)
            if (is_file($file)) {
                // Delete the file
                unlink($file);
            }
        }
        echo "All migration files have been deleted.";

           // Path to the migrations directory
           $seedersPath = database_path('seeders');

           // Get all files in the migrations directory
           $seeder_files = glob($seedersPath . '/*.php');

           foreach ($seeder_files as $seeder_file) {
            $basename = basename($seeder_file);
            // Skip the DatabaseSeeder.php file
            if ($basename == 'DatabaseSeeder.php') {
                continue;
            }
               // Check if the file exists and is a file (not a directory)
               if (is_file($seeder_file)) {
                   // Delete the file
                   unlink($seeder_file);
               }
           }

        echo "All Seeder files have been deleted.";
        $this->call('migrate:generate', ["--use-db-collation" => true]);

        $dbName = env('DB_DATABASE');

        $query =  DB::select("SHOW TABLES WHERE 'Tables_in_$dbName' NOT LIKE 'migrations'");
        $collection = new \Illuminate\Support\Collection($query);
        $tables = $collection->implode("Tables_in_$dbName",',');

        $this->info('Calling iseed for all tables except migrations ...');
        $this->call('iseed', ["tables" => $tables,'--chunksize' => 100]);
        $this->call('iseed', ["tables" => 'archives,broadcasts,podcasts,posts','--chunksize' => 1]);
        $this->call('iseed', ["tables" => 'states','--chunksize' => 40]);

    }
}
