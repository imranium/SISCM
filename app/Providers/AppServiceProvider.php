<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('view-student', function ($user) {
            return in_array($user->user_role, [1, 2, 3]); // All can view details
        });
    
        Gate::define('edit-student', function ($user) {
            return in_array($user->user_role, [1, 2]); // Admin and Lecturer
        });
    
        Gate::define('delete-student', function ($user) {
            return $user->user_role === 1; // Only Admin
        });



    }
}
