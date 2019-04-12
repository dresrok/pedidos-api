<?php

namespace App\Console\Commands\Migrations;

use Illuminate\Console\Command;

class MultitaskCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:multitask {--action=install : Action to execute}
                {--passport : Run the commands necessary to prepare Passport for use}
                {--seed : Indicates if the seed task should be re-run}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run all migrations for this project, prepare Passport and execute the seed task';

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
        $action = $this->option('action');
        switch ($action) {
            case 'rollback':
                $this->rollback();
                break;
            case 'install':
                $this->migrate();
                break;
        }
        if ($action === 'install' && $this->option('passport')) {
            $this->call('passport:keys');
            $this->call('passport:client', ['--password' => true, '--name' => 'Web']);
            $this->call('passport:client', ['--password' => true, '--name' => 'Mobile']);
        }
        if ($action === 'install' && $this->option('seed')) {
            $this->call('db:seed', ['--force' => true]);
        }
    }

    private function rollback()
    {
        $this->info('Rolling back migrations for passport and others');
        $this->call('migrate:rollback');

        $this->info('Rolling back migrations for module d');
        $this->call('migrate:rollback', ['--path' => 'database/migrations/d']);

        $this->info('Rolling back migrations for module c');
        $this->call('migrate:rollback', ['--path' => 'database/migrations/c']);

        $this->info('Rolling back migrations for module b');
        $this->call('migrate:rollback', ['--path' => 'database/migrations/b']);
    }

    private function migrate()
    {
        $this->info('Installing migrations for module b');
        $this->call('migrate', ['--path' => 'database/migrations/b']);

        $this->info('Installing migrations for module c');
        $this->call('migrate', ['--path' => 'database/migrations/c']);

        $this->info('Installing migrations for module d');
        $this->call('migrate', ['--path' => 'database/migrations/d']);

        $this->info('Installing migrations for passport and others');
        $this->call('migrate');
    }
}
