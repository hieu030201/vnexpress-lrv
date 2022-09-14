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

        // Gate::define('list_user',function($user){
        //     return $user->checkPermissionAccess('list_user');
        // });
        // Gate::define('add_user',function($user){
        //     return $user->checkPermissionAccess('add_user');
        // });
        // Gate::define('add_user',function($user){
        //     return $user->checkPermissionAccess('add_user');
        // });
        // Gate::define('edit_user',function($user){
        //     return $user->checkPermissionAccess('edit_user');
        // });
        // Gate::define('delete_user',function($user){
        //     return $user->checkPermissionAccess('delete_user');
        // });
        // Gate::define('list_role',function($user){
        //     return $user->checkPermissionAccess('list_role');
        // });
        // Gate::define('add_role',function($user){
        //     return $user->checkPermissionAccess('add_role');
        // });
        // Gate::define('edit_role',function($user){
        //     return $user->checkPermissionAccess('edit_role');
        // });
        // Gate::define('delete_role',function($user){
        //     return $user->checkPermissionAccess('delete_role');
        // });
        // Gate::define('list_post',function($user){
        //     return $user->checkPermissionAccess('list_post');
        // });
        // Gate::define('add_post',function($user){
        //     return $user->checkPermissionAccess('add_post');
        // });
        // Gate::define('edit_post',function($user){
        //     return $user->checkPermissionAccess('edit_post');
        // });
        // Gate::define('delete_post',function($user){
        //     return $user->checkPermissionAccess('delete_post');
        // });
        // Gate::define('list_post',function($user){
        //     return $user->checkPermissionAccess('list_post');
        // });
    }
}
