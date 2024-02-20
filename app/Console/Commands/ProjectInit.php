<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use function Laravel\Prompts\text;
use function Laravel\Prompts\select;
use function Laravel\Prompts\password;

class ProjectInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'One Running command to start the application.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dbDriver = select(
            'What is your database driver?',
            ['mysql', 'sqlite', 'pgsql'],
        );

        $database = text(
            label: 'Choose database name to create ?',
            required: 'Database name is required.'
        );

        $this->call("db:create $database");

        $this->info("Database: $database has beed created");

        $dbUsername = text(
            label: 'What is your database username ?',
            required: 'Database username is required.'
        );

        $dbPassword = password(
            label: 'What is your database password ?',
            required: 'Database password is required.'
        );
        $this->info('This application uses pusher to refresh statistics in real time, so kindly make sure to provide the following Environment varibles');

        $pusherId = text(
            label: 'Pusher ID:',
            required: 'Pusher ID is required.'
        );

        $pusherKey = text(
            label: 'Pusher Key:',
            required: 'Pusher Key is required.'
        );

        $pusherSecret = password(
            label: 'Pusher Secret:',
            required: 'Pusher Secret is required.'
        );

        $pusherCluster = text(
            label: 'Pusher Cluster:',
            placeholder: 'Ex: eu',
            required: 'Pusher Cluster is required.',
        );

        $this->createEnvIfNotExists(
            file: '.env',
            content: $this->environmentText($dbDriver, $database, $dbUsername, $dbPassword, $pusherId, $pusherKey, $pusherSecret, $pusherCluster)
        );

        $this->info('Generating application key ...');
        $this->call('key:generate');
        
        $this->info('Kindly run "npm run install && npm run dev"');
        $this->info('to enable realtime functionality for statistics page, please run the following command: php artsan queue:work');
    }

    private function createEnvIfNotExists($file = '.env', $content)
    {
        if (is_file($file)) {
            $this->error('.env already exists');
            return;
        }
        $environmentFile = fopen($file, "a");
        fwrite($environmentFile, $content);
        fclose($environmentFile);
    }

    private function environmentText($dbDriver, $database, $dbUsername, $dbPassword, $pusherId, $pusherKey, $pusherSecret, $pusherCluster): string
    {
        $text = "
        APP_NAME=Convertedin
        APP_ENV=local
        APP_KEY=
        APP_DEBUG=true
        APP_URL=http://localhost:8000

        LOG_CHANNEL=stack
        LOG_DEPRECATIONS_CHANNEL=null
        LOG_LEVEL=debug

        DB_CONNECTION=$dbDriver
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=$database
        DB_USERNAME=$dbUsername
        DB_PASSWORD=$dbPassword
        
        BROADCAST_DRIVER=pusher
        CACHE_DRIVER=file    
        FILESYSTEM_DISK=local
        QUEUE_CONNECTION=database
        SESSION_DRIVER=file
        SESSION_LIFETIME=120
        
        PUSHER_APP_ID=$pusherId
        PUSHER_APP_KEY=$pusherKey
        PUSHER_APP_SECRET=$pusherSecret
        PUSHER_APP_CLUSTER=$pusherCluster";

        return str_replace(" ", "", $text);
    }
}
