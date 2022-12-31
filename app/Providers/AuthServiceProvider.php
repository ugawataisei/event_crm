<?php

namespace App\Providers;

use App\Consts\UserConst;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
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
    public function boot(): void
    {
        $this->registerPolicies();

        /** @var User $user */
        Gate::define('admin', function ($user) {
            return $user->role === UserConst::ADMIN_ROLE;
        });

        Gate::define('manager-higher', function ($user) {
            if (UserConst::MANAGER_ROLE_LOWER <= $user->role && $user->role <= UserConst::MANAGER_ROLE_UPPER) {
                return true;
            } else {
                return false;
            }
        });

        Gate::define('user-higher', function ($user) {
            if (UserConst::USER_ROLE_LOWER <= $user->role && $user->role <= UserConst::MANAGER_ROLE_LOWER) {
                return true;
            } else {
                return false;
            }
        });
    }
}
