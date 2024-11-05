<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('access-statistics', function ($user) {
            return $user->can('products-statistic') &&
                $user->can('receipts-statistic') &&
                $user->can('releases-statistic');
        });

        Gate::define('access-website-management', function ($user) {
            return $user->can('banner_website') &&
                $user->can('news_website') &&
                $user->can('introduce_website');
        });
    }
}
