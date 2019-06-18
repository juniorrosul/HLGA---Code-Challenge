<?php

namespace App\Providers;

// Contracts
use App\Contracts\BreedContract;
// Repositories
use App\Repositories\BreedRepository;
// Default
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BreedContract::class, BreedRepository::class);
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
