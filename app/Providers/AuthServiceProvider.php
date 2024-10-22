<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Enums\RoleEnum;
use App\Models\User;
//use App\Policies\AdminPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
//        User::class => AdminPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
//        $this->registerPolicies();
//        Gate::define('accessAdminPanel', [AdminPolicy::class, 'accessAdminPanel']);
        Gate::define('accessAdminPanel', function (User $user) {
            return $user->role_id == RoleEnum::ADMIN->value
                ? Response::allow()
                : Response::deny('Вы должны быть администратором.');
        });
    }
}
