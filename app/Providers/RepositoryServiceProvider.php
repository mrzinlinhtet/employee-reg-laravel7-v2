<?php

namespace App\Providers;

use App\Interfaces\EmployeeInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\EmployeeRepository;
use App\Interfaces\EmployeeUploadInterface;
use App\Repositories\EmployeeUploadRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     *
     */
    public $bindings = [
        EmployeeInterface::class => EmployeeRepository::class,
        EmployeeUploadInterface::class => EmployeeUploadRepository::class
     ];
    public function register()
    {
        $this->app->bind(EmployeeInterface::class,EmployeeRepository::class);
        $this->app->bind(EmployeeUploadInterface::class,EmployeeUploadRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
