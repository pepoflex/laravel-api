<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Installation\AppInstallationService;

/**
 * Class ResetDemoApp
 * @package App\Console\Commands
 */
class ResetDemoApp extends Command
{

    /**
     * @var string
     */
    protected $signature = 'demo:reset';


    /**
     * @var string
     */
    protected $description = 'Reset the application state for the demo site.';


    /**
     * ResetDemoApp constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     *
     */
    public function handle()
    {
        $service = app(AppInstallationService::class);
        $this->info('cleaning up');
        $this->call('migrate:refresh');
        $this->info('Installing the app');
        $service->installApp([
            'name' => 'Api Demo Admin',
            'email' => 'admin@admin.com',
            'password' => 'secret123456789',
            'password_confirmation' => 'secret123456789'
        ]);
        $this->info('Seed the database');
        $this->call('db:seed');
        $this->info('Done');
    }
}
