<?php

namespace App\Providers;

// Import application's configurations
    use App\BusinessLogic\Interfaces\Admin\UserInterface;
    use App\BusinessLogic\Services\Admin\UserService;
    use App\BusinessLogic\Interfaces\Admin\UserRoleTypeInterface;
    use App\BusinessLogic\Services\Admin\UserRoleTypeService;

use Illuminate\Support\ServiceProvider;

class BusinessLogicProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Register application's user profile interfaces and services
        $this->app->bind( UserInterface::class, UserService::class );
        $this->app->bind( UserRoleTypeInterface::class, UserRoleTypeService::class );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
