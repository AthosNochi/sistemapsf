<?php

namespace App\Providers;

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
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PsfRepository::class, \App\Repositories\PsfRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PatientRepository::class, \App\Repositories\PatientRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\DoctorRepository::class, \App\Repositories\DoctorRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AgendamentoRepository::class, \App\Repositories\AgendamentoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EnfermeiroRepository::class, \App\Repositories\EnfermeiroRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SecretariaRepository::class, \App\Repositories\SecretariaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AnamneseRepository::class, \App\Repositories\AnamneseRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AvailabilityRepository::class, \App\Repositories\AvailabilityRepositoryEloquent::class);
        //:end-bindings:
    }
}
