<?php

namespace App\Providers\Custom;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\Super;
use App\Models\User;
use App\Models\Cmspage;
use App\Models\Headerfooter;
use App\Models\Field;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('admin.includes.header', function($view){
            $user = Auth::user();
            $admin_headers = $this->getData();
            $user_headers = $this->getUserData();
            $admin_meta_data = Cmspage::all();
            $view->with([
                'user' => $user,
                'admin_headers' => $admin_headers,
                'user_headers' => $user_headers,
                'admin_meta_data' => $admin_meta_data,
            ]);
        });

        View::composer('admin.users.login', function($view){
            $admin_login_header = $this->getData();
            $admin_meta_data = Cmspage::all();
            $view->with([
                'admin_login_header' => $admin_login_header,
                'admin_meta_data' => $admin_meta_data,
            ]);
        });

        View::composer('admin.users.register', function($view){
            $admin_login_header = $this->getData();
            $admin_meta_data = Cmspage::all();
            $view->with([
                'admin_login_header' => $admin_login_header,
                'admin_meta_data' => $admin_meta_data,
            ]);
        });

        View::composer('admin.users.forgotPassword', function($view){
            $admin_login_header = $this->getData();
            $admin_meta_data = Cmspage::all();
            $view->with([
                'admin_login_header' => $admin_login_header,
                'admin_meta_data' => $admin_meta_data,
            ]);
        });

        View::composer('admin.users.resetPassword', function($view){
            $admin_login_header = $this->getData();
            $admin_meta_data = Cmspage::all();
            $view->with([
                'admin_login_header' => $admin_login_header,
                'admin_meta_data' => $admin_meta_data,
            ]);
        });

        View::composer('admin.includes.footer', function($view){
            $admin_footers = $this->getData();
            $view->with('admin_footers', $admin_footers);
        });
    }

    protected function getData(){
        $data = DB::table('headerfooters')
            ->leftJoin('fields', 'headerfooters.field_id', '=', 'fields.id')
            ->select('headerfooters.*', 'fields.title', 'fields.smalltitle', 'fields.license', 'fields.address', 'fields.logo')
            ->get();
        return $data;
    }

    protected function getUserData(){
        $data_info = DB::table('users')
            ->leftJoin('countries', 'users.countryId', '=', 'countries.id')
            ->leftJoin('divisions', 'users.divisionId', '=', 'divisions.id')
            ->leftJoin('districts', 'users.districtId', '=', 'districts.id')
            ->leftJoin('cities', 'users.cityId', '=', 'cities.id')
            ->leftJoin('policestations', 'users.policestationId', '=', 'policestations.id')
            ->select('users.*', 'countries.countryname', 'countries.nationality', 'countries.currency', 'countries.phone_code', 'divisions.divisionname', 'districts.districtname', 'cities.cityname', 'policestations.policestationname')
            ->orderBy('countries.countryname')
            ->orderBy('divisions.divisionname')
            ->orderBy('districts.districtname')
            ->orderBy('cities.cityname')
            ->orderBy('policestations.policestationname')
            ->orderBy('users.username')
            ->get();
        return $data_info;
    }
}