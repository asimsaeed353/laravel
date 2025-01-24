<?php

namespace App\Providers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Model::preventLazyLoading();

        // Gate to edit the job
        Gate::define('edit-job', function (User $user, Job $job){
            return $job->employer->user->is($user);
        });

        // Gate to delete the job
        Gate::define('delete-job', function (User $user, Job $job){
            return $job->employer->user->is($user);
        });

        // Gate to update the job
        Gate::define('update-job', function (User $user, Job $job){
            return $job->employer->user->is($user);
        });

        #

        /*
        \Illuminate\Pagination\Paginator::useBootstrap();
        \Illuminate\Pagination\Paginator::defaultView('');

        */
    }
}
