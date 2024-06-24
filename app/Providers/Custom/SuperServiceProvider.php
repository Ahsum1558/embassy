<?php

namespace App\Providers\Custom;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\Super;
use App\Models\Cmspage;
use App\Models\Headerfooter;
use App\Models\Field;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class SuperServiceProvider extends ServiceProvider
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
        View::composer('super.includes.header', function($view){
            $super = Auth::guard('super')->user();
            $super_header = $this->getData();
            $meta_data = Cmspage::all();
            $view->with([
                'super' => $super,
                'super_header' => $super_header,
                'meta_data' => $meta_data,
            ]);
        });

        View::composer('super.users.login', function($view){
            $login_header = $this->getData();
            $meta_data = Cmspage::all();
            $view->with([
                'login_header' => $login_header,
                'meta_data' => $meta_data,
            ]);
        });

        View::composer('super.includes.footer', function($view){
            $footers = $this->getData();
            $view->with('footers', $footers);
        });
    }

    protected function getData(){
        $data = DB::table('headerfooters')
            ->leftJoin('fields', 'headerfooters.field_id', '=', 'fields.id')
            ->select('headerfooters.*', 'fields.title', 'fields.smalltitle', 'fields.license', 'fields.address', 'fields.logo')
            ->get();
        return $data;
    }
}
