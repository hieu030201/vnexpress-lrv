<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use App\Policies\PostPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('list_user', 'App\Policies\UserPolicy@view');
        Gate::define('add_user', 'App\Policies\UserPolicy@create');
        Gate::define('edit_user', 'App\Policies\UserPolicy@update');
        Gate::define('delete_user', 'App\Policies\UserPolicy@delete');
        Gate::define('list_role', 'App\Policies\RolePolicy@view');
        Gate::define('add_role', 'App\Policies\RolePolicy@create');
        Gate::define('edit_role', 'App\Policies\RolePolicy@update');
        Gate::define('delete_role', 'App\Policies\RolePolicy@delete');
        Gate::define('list_post', 'App\Policies\PostPolicy@view');
        Gate::define('add_post', 'App\Policies\PostPolicy@create');
        Gate::define('edit_post', 'App\Policies\PostPolicy@update');
        Gate::define('delete_post', 'App\Policies\PostPolicy@delete');
    }
}
