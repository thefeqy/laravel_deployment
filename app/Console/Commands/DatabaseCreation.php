<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PDO;

use function Laravel\Prompts\text;

class DatabaseCreation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:create {dbname?} {connection?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Custom artisan command to create database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $dbname = $this->argument('dbname') ?? text(
                label: 'Type database name:',
                required: 'Database name is required.'
            );
            
            $connection = $this->hasArgument('connection') && $this->argument('connection') ? $this->argument('connection') : DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME);

            $hasDb = DB::connection($connection)->select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = " . "'" . $dbname . "'");

            if (empty($hasDb)) {
                DB::connection($connection)->select('CREATE DATABASE ' . $dbname);
                $this->info("Database '$dbname' created for '$connection' connection");
            } else {
                $this->info("Database $dbname already exists for $connection connection");
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
