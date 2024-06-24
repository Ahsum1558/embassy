<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Super;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use App\Models\Country;
use App\Models\Division;
use App\Models\District;
use App\Models\Policestation;
use App\Models\City;
use App\Models\Issue;
use Illuminate\Support\Facades\DB;
use DateTime;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function approvedUser()
    {
        $all_approveduser = User::where('type', 'approve')->orderBy('title', 'asc')->get();
        return view('super.operator.approve.index', compact('all_approveduser'));
    }

    public function approve($id)
    {
        $user_approve = User::findOrFail($id);
        $user_approve->type       = 'approve';
        $user_approve->update();              

        return redirect() -> back() -> with('message', 'The User is approved Successfully');
    }

    public function pendingUser()
    {
        $all_pendinguser = User::where('type', 'pending')->orderBy('title', 'asc')->get();
        return view('super.operator.pending.index', compact('all_pendinguser'));
    }

    public function pending($id)
    {
        $user_pending = User::findOrFail($id);
        $user_pending->type       = 'pending';
        $user_pending->update();  

        return redirect() -> back() -> with('message', 'The User is pending Now');            
    }

    public function disabledUser()
    {
        $all_disableduser = User::where('type', 'disable')->orderBy('title', 'asc')->get();
        return view('super.operator.disable.index', compact('all_disableduser'));
    }

    public function disable($id)
    {
        $user_disable = User::findOrFail($id);
        $user_disable->type       = 'disable';
        $user_disable->update(); 

        return redirect() -> back() -> with('message', 'The User is disable Now');              
    }

    public function expiredUser()
    {
        $currentDate = date('Y-m-d'); 
        $all_expireduser = User::where('userExpiry', '<', $currentDate)->orderBy('title', 'asc')->get();
        return view('super.operator.expired.index', compact('all_expireduser'));
    }

    public function nearExpiry()
    {
        $currentDate = date('Y-m-d'); 
        $fiveDaysBefore = date('Y-m-d', strtotime('5 days', strtotime($currentDate)));
        $all_nearExpiry = User::where('userExpiry', '>=', $currentDate)
                              ->where('userExpiry', '<=', $fiveDaysBefore)
                              ->orderBy('title', 'asc')
                              ->get();
        return view('super.operator.near.index', compact('all_nearExpiry'));
    }
}