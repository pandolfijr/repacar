<?php

namespace App\Providers;

use App\Interfaces\Repository\ClientRepository;
use App\Interfaces\Repository\ProductRepository;
use App\Interfaces\Repository\BudgetRepository;
use App\Interfaces\Repository\CompanyDataRepository;
use App\Interfaces\Repository\UserRepository;
use App\Interfaces\Service\ClientService;
use App\Interfaces\Service\ProductService;
use App\Interfaces\Service\BudgetService;
use App\Interfaces\Service\UserService;
use App\Repositories\ClientRepositoryImpl;
use App\Repositories\ProductRepositoryImpl;
use App\Repositories\BudgetRepositoryImpl;
use App\Repositories\CompanyDataRepositoryImpl;
use App\Repositories\UserRepositoryImpl;
use App\Services\ClientServiceImpl;
use App\Services\ProductServiceImpl;
use App\Services\BudgetServiceImpl;
use Illuminate\Support\ServiceProvider;
use App\Services\UserServiceImpl;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(UserService::class, UserServiceImpl::class);
        $this->app->bind(UserRepository::class, UserRepositoryImpl::class);

        $this->app->bind(ProductService::class, ProductServiceImpl::class);
        $this->app->bind(ProductRepository::class, ProductRepositoryImpl::class);

        $this->app->bind(ClientService::class, ClientServiceImpl::class);
        $this->app->bind(ClientRepository::class, ClientRepositoryImpl::class);

        $this->app->bind(BudgetService::class, BudgetServiceImpl::class);
        $this->app->bind(BudgetRepository::class, BudgetRepositoryImpl::class);

        $this->app->bind(CompanyDataRepository::class, CompanyDataRepositoryImpl::class);


    }

}

