<?php

namespace Inspirium\FileManagement;

use Illuminate\Support\ServiceProvider;

class FileManagementServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/api.php');

        $this->loadMigrationsFrom(__DIR__.'/database');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
