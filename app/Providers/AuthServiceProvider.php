<?php

namespace App\Providers;

use App\Constants\RoleConstants;
use App\Models\Survey;
use Illuminate\Foundation\Auth\User;
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

        Gate::define('can-update-survey', function (User $user, Survey $survey) {
            $isOnlySurveyOperatorRole = count(auth()->user()->roles) == 1 &&
                auth()->user()
                    ->whereRelation('roles', 'user_role.role_id', '=', RoleConstants::SURVEY_ADMIN)
                    ->exists();

            return !($isOnlySurveyOperatorRole && !$survey->is_visible);
        });
    }
}
