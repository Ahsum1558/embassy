<?php

namespace App\Http\Controllers\Locaton;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\View\View;
use App\Models\Country;
use App\Models\Division;
use App\Models\District;
use App\Models\Policestation;
use App\Models\City;
use App\Models\Issue;
use Illuminate\Support\Facades\DB;

class AdminDivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $all_division = $this->getInfo();
        return view('admin.location.division.index', compact('all_division'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $division_create = Division::where('status', 1)->orderBy('divisionname', 'asc')->get();
        $all_country = Country::where('status', 1)->orderBy('countryname', 'asc')->get();

        if(Auth::check() && Auth::user()->role == 'admin' && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            return view('admin.location.division.create', [
                'division_create'=>$division_create,
                'all_country'=>$all_country
            ]);
        }else{
            return redirect('/division');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);
        $division_create = new Division();

        $division_create->divisionname  = $request->divisionname; 
        $division_create->countryId     = $request->countryId;
        $division_create->status        = $request->status;
        $division_create->save();

        return redirect() -> back() -> with('message', 'Division is added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $division_single_data = $this->getDetails($id);
        
        if($division_single_data->count() > 0){
            return view('admin.location.division.show', compact('division_single_data'));
        }else{
            return redirect('/division');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $division_data = $this->getDetails($id);
        
        if($division_data->count() > 0){
            if(Auth::check() && Auth::user()->role == 'admin' && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
                return view('admin.location.division.edit', compact('division_data'));
            }else{
            return redirect('/division');
        }
        }else{
            return redirect('/division');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this -> validate($request, [
            'divisionname'       => 'required|unique:divisions',
        ],
        [
            'divisionname.required' => 'Division Name Field must not be Empty',
            'divisionname.unique'   => 'The Division Name is already exist',
        ]);

        $division_data = Division::findOrFail($id);

        $division_data->divisionname  = $request->divisionname; 
        $division_data->update();

        return redirect() -> back() -> with('message', 'Division Name is Updated successfully');
    }

    public function editInfo($id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $division_data_info = $this->getDetails($id);
        $all_country = Country::where('status', 1)->orderBy('countryname', 'asc')->get();
        
        if($division_data_info->count() > 0){
            if(Auth::check() && Auth::user()->role == 'admin' && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
                return view('admin.location.division.editInfo', [
                'division_data_info'=>$division_data_info,
                'all_country'=>$all_country
            ]);
            }else{
            return redirect('/division');
        }
        }else{
            return redirect('/division');
        }
    }

    public function updateInfo(Request $request, $id)
    {
        $this->validationInfo($request);
        $division_data_info = Division::findOrFail($id);

        $division_data_info->countryId  = $request->countryId;
        $division_data_info->status     = $request->status;
        $division_data_info->update();

        return redirect() -> back() -> with('message', 'Division Info is Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $data_division = Division::find($id);
        $data_division -> delete();

        return redirect() -> back() -> with('message', 'The Division is deleted successfully');
    }

    public function inactive($id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $division_inactive = Division::findOrFail($id);

        $division_inactive->status      = 0;
        $division_inactive->update();              

        return redirect('/division')->with('message', 'The Division is Inactive Successfully');
    }
    
    public function active($id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $division_active = Division::findOrFail($id);

        $division_active->status    = 1;
        $division_active->update();              

        return redirect('/division')->with('message', 'The Division is Active Successfully');
    }

    protected function getDetails($id){
        $data_details = Division::leftJoin('countries','divisions.countryId','=','countries.id')
        ->where('divisions.id', $id)
        ->select('divisions.*', 'countries.countryname', 'countries.nationality')->get();
        return $data_details;
    }

    protected function getInfo(){
        $data_info = Division::leftJoin('countries','divisions.countryId','=','countries.id')
        ->select('divisions.*', 'countries.countryname', 'countries.nationality')
        ->orderBy('countries.countryname')
        ->orderBy('divisions.divisionname')
        ->get();
        return $data_info;
    }

    protected function validation($request){
        $this -> validate($request, [
            'divisionname'    => 'required|unique:divisions',
            'countryId'       => 'required|exists:countries,id',
            'status'          => 'required|in:1,0',
        ],
        [
            'divisionname.required' => 'Division Name Field must not be Empty',
            'divisionname.unique'   => 'The Division Name is already exist',
            'countryId.required'    => "Country Field is required !!",
            'countryId.exists'      => "Invalid Country Field !!",
            'status.required'       => 'Status Field is required',
            'status.in'             => 'Invalid status option selected',
        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'countryId'       => 'required|exists:countries,id',
            'status'          => 'required|in:1,0',
        ],
        [
            'countryId.required' => "Country Field is required !!",
            'countryId.exists'   => "Invalid Country Field !!",
            'status.required'    => 'Status Field is required',
            'status.in'          => 'Invalid status option selected',
        ]);
    }
}