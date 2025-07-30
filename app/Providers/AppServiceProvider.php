<?php

namespace App\Providers;

use App\Wed\Happy;
use App\Wed\WedMacros;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $macros = new WedMacros();

        // Register all macros from WedMacros
        Happy::macro('getActiveTestimonials', $macros->getActiveTestimonials());

        // Location-related macros
        Happy::macro('getActiveLocationCount', $macros->getActiveLocationCount());
        Happy::macro('getActiveLocations', $macros->getActiveLocations());
        Happy::macro('getLocations', $macros->getLocations());
        Happy::macro('getLocationPages', $macros->getLocationPages());
        Happy::macro('getCountry', $macros->getCountry());
        Happy::macro('getCountryCount', $macros->getCountryCount());
        Happy::macro('getStates', $macros->getStates());
        Happy::macro('getStatesCount', $macros->getStatesCount());
        Happy::macro('getCities', $macros->getCities());
        Happy::macro('getCitiesCount', $macros->getCitiesCount());

        // Category-related macros
        Happy::macro('getVendorCategoryPages', $macros->getVendorCategoryPages());
        Happy::macro('getVendorCategories', $macros->getVendorCategories());
        Happy::macro('getActiveCategories', $macros->getActiveCategories());
        Happy::macro('getActiveSubCategories', $macros->getActiveSubCategories());

        // Task-related macros
        Happy::macro('getTaskCategoryPages', $macros->getTaskCategoryPages());
        Happy::macro('getTaskCategories', $macros->getTaskCategories());
        Happy::macro('getActiveTasks', $macros->getActiveTasks());

        // Service-related macros
        Happy::macro('getActiveServices', $macros->getActiveServices());

        // Article-related macros
        Happy::macro('getActiveArticles', $macros->getActiveArticles());

        // Utility macros
        Happy::macro('getGuard', $macros->getGuard());
    }
}


