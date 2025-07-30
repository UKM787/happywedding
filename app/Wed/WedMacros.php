<?php

namespace App\Wed;

use App\Models\Admin\Article;
use App\Models\Admin\TaskMaster;
use App\Models\Admin\Testimonial;
use App\Models\Admin\ServiceMaster;
use App\Models\Admin\CategoryMaster;
use App\Models\Admin\LocationMaster;

class WedMacros
{

    public function search()
    {
        return function ($attribute, $searchText) {
            //dd($this);
            return $this->where($attribute, 'LIKE', "%{$searchText}%");
        };
    }

    public function orSearch()
    {
        return function ($attribute, $searchText) {
            //dd($this);
            return $this->where($attribute, 'LIKE', "%{$searchText}%");
        };
    }

    public function getActiveLocationCount()
    {
        return function () {
            return  LocationMaster::latest()->where('status', 1)->count();
        };
    }
    public function getActiveLocations()
    {
        return function () {
            return  LocationMaster::latest()->orderBy('name', 'ASC')->where('status', 1)->get();
        };
    }
    public function getLocations()
    {
        return function () {
            return  LocationMaster::orderBy('parent_id')->orderBy('name', 'ASC')->get();
        };
    }

    public function getLocationPages()
    {
        return function () {
            return  LocationMaster::orderBy('parent_id')->orderBy('name', 'ASC')->paginate(9);
        };
    }

    public function getCountry()
    {
        return function () {
            return  LocationMaster::latest()->whereNull('parent_id')->orderBy('parent_id')->get();
        };
    }

    public function getCountryCount()
    {
        return function () {
            return LocationMaster::whereNull('parent_id')->count();
        };
    }

    public function getStates()
    {
        return function ($country = 1) {
            return LocationMaster::where('parent_id', '=', $country)->latest()->orderBy('parent_id', 'ASC')->orderBy('name', 'ASC')->get();
        };
    }

    public function getStatesCount()
    {
        return function () {
            return LocationMaster::where('parent_id', 1)->count();
        };
    }

    public function getCities()
    {
        return function () {
            return  LocationMaster::where('parent_id', '>', 1)->latest()->orderBy('name', 'ASC')->get();
        };
    }

    public function getCitiesCount()
    {

        return function () {
            return LocationMaster::whereNotNull('parent_id')->where('parent_id', '!=', 1)->get()->count();
        };
    }

    public function getVendorCategoryPages()
    {
        return function () {
            return CategoryMaster::whereNull('parent_id')->paginate(18);
        };
    }

    public function getVendorCategories()
    {
        return function () {
            return CategoryMaster::latest()->whereNull('parent_id')->orderBy('parent_id', 'ASC')->orderBy('name', 'ASC')->get();
        };
    }

    public function getActiveCategories()
    {
        return function () {
            return CategoryMaster::whereNull('parent_id')->where('status', '=', 1)->with('children')->get();
        };
    }

    public function getActiveSubCategories()
    {
        return function () {
            return CategoryMaster::with('children')->whereNotNull('parent_id')->get();
        };
    }

    public function getTaskCategoryPages()
    {
        return function () {
            return TaskMaster::whereNull('parent_id')->paginate(18);
        };
    }
    public function getTaskCategories()
    {
        return function () {
            return TaskMaster::latest()->whereNull('parent_id')->orderBy('parent_id', 'ASC')->orderBy('name', 'ASC')->get();
        };
    }
    public function getActiveTasks()
    {
        return function () {
            return TaskMaster::whereNull('parent_id')->where('status', '=', 1)->with('children')->get();
        };
    }

    public function getActiveServices()
    {
        return function () {
            return ServiceMaster::whereNull('parent_id')->where('status', '=', 1)->with('children')->get();
        };
    }

    public function getActiveTestimonials()
    {
        return function () {
            return Testimonial::where('status', '=', 1)->orderBy('title', 'ASC')->get()->sortBy('priority', SORT_NATURAL);
        };
    }
    
    public function getActiveArticles()
    {
        return function () {
            return Article::where('status', '=', 1)->with('tags', 'category')->get();
        };
    }

    public function getGuard()
    {
        return function () {
            $guards = array_keys(config('auth.guards'));
            foreach ($guards as $guard) {
                if (auth()->guard($guard)->check()) {
                    return $guard;
                }
            }
        };
    }
}
