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

        Gate::define('admin', function ($user) {
            /** @var User $user */
            return $user->role === UserConst::ADMIN_ROLE;
        });

        Gate::define('manager', function ($user) {
            /** @var User $user */
            return $user->role === UserConst::MANAGER_ROLE;
        });

        Gate::define('user', function ($user) {
            /** @var User $user */
            if (UserConst::ADMIN_ROLE <= $user->role && $user->role <= UserConst::USER_ROLE_UPPER) {
                return true;
            } else {
                return false;
            }
        });
    }
}
