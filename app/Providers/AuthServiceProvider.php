<?php

namespace App\Providers;

use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as BaseAuthServiceProvider;

class AuthServiceProvider extends BaseAuthServiceProvider
{
    /**
     * The policy mappings for the application.
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Post::class => PostPolicy::class,
         \App\Models\User::class => \App\Policies\UserPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
