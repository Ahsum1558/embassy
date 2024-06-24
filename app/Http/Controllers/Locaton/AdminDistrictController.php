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

class AdminDistrictController extends Controller
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
        $all_district = $this->getInfo();
        return view('admin.location.district.index', compact('all_district'));
    }

    public function getDivision(Request $request)
    {
        $all_division = Division::where([
            'countryId'=>$request->country_id
        ])->where('status','=',1)->orderBy('divisionname', 'asc')->get();

        return view('admin.location.district.ajax',[
            'all_division'=>$all_division,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $district_create = District::where('status', 1)->orderBy('districtname', 'asc')->get();
        $all_country = Country::where('status', 1)->orderBy('countryname', 'asc')->get();

        if(Auth::check() && Auth::user()->role == 'admin' && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            return view('admin.location.district.create', [
                'district_create'   =>  $district_create,
                'all_country'       =>  $all_country
            ]);
        }else{
            return redirect('/district');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        $district_create = new District();

        $district_create->districtname  = $request->districtname; 
        $district_create->divisionId    = $request->divisionId; 
        $district_create->countryId     = $request->countryId; 
        $district_create->status        = $request->status; 
        $district_create->save();

        return redirect() -> back() -> with('message', 'District is added successfully');
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
        $district_single_data = $this->getDetails($id);
        
        if($district_single_data->count() > 0){
                return view('admin.location.district.show', compact('district_single_data'));
        }else{
            return redirect('/district');
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
        $district_data = $this->getDetails($id);
        
        if($district_data->count() > 0){
            if(Auth::check() && Auth::user()->role == 'admin' && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            return view('admin.location.district.edit', compact('district_data'));
            }else{
            return redirect('/district');
        }
        }else{
            return redirect('/district');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this -> validate($request, [
            'districtname'   => 'required|unique:districts',
        ],
        [
            'districtname.required' => 'District Name Field must not be Empty',
            'districtname.unique'   => 'The District Name is already exist',
        ]);

        $district_data = District::findOrFail($id);

        $district_data->districtname  = $request->districtname; 
        $district_data->update();

        return redirect() -> back() -> with('message', 'District Name is Updated successfully');
    }

    public function editInfo($id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $district_data_info = $this->getDetails($id);
        $all_country = Country::where('status', 1)->orderBy('countryname', 'asc')->get();
        $all_division = Division::where('status', 1)->orderBy('divisionname', 'asc')->get();
        
        if($district_data_info->count() > 0){
            if(Auth::check() && Auth::user()->role == 'admin' && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
                return view('admin.location.district.editInfo', [
                'district_data_info'=>$district_data_info,
                'all_country'=>$all_country,
                'all_division'=>$all_division,
            ]);
            }else{
            return redirect('/district');
        }
        }else{
            return redirect('/district');
        }
    }

    public function updateInfo(Request $request, $id)
    {
        $this->validationInfo($request);
        $district_data_info = District::findOrFail($id);

        $district_data_info->divisionId  = $request->divisionId;
        $district_data_info->countryId   = $request->countryId;
        $district_data_info->status      = $request->status;
        $district_data_info->update();

        return redirect() -> back() -> with('message', 'District Info is Updated successfully');
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
        $data_district = District::find($id);
        $data_district -> delete();

        return redirect() -> back() -> with('message', 'The District is deleted successfully');
    }

    public function inactive($id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $district_inactive = District::findOrFail($id);

        $district_inactive->status       = 0;
        $district_inactive->update();              

        return redirect('/district')->with('message', 'The District is Inactive Successfully');
    }
    
    public function active($id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $district_active = District::findOrFail($id);

        $district_active->status    = 1;
        $district_active->update();              

        return redirect('/district')->with('message', 'The District is Active Successfully');
    }

    protected function getInfo(){
        $data_info = DB::table('districts')
            ->leftJoin('countries', 'districts.countryId', '=', 'countries.id')
            ->leftJoin('divisions', 'districts.divisionId', '=', 'divisions.id')
            ->select('districts.*', 'countries.countryname', 'countries.nationality', 'divisions.divisionname')
            ->orderBy('countries.countryname')
            ->orderBy('divisions.divisionname')
            ->orderBy('districts.districtname')
            ->get();
        return $data_info;
    }

    protected function getDetails($id){
        $data_details = DB::table('districts')
            ->leftJoin('countries', 'districts.countryId', '=', 'countries.id')
            ->where('districts.id', $id)
            ->leftJoin('divisions', 'districts.divisionId', '=', 'divisions.id')
            ->select('districts.*', 'countries.countryname', 'countries.nationality', 'divisions.divisionname')
            ->get();
        return $data_details;
    }

    protected function validation($request){
        $this -> validate($request, [
            'districtname'    => 'required|unique:districts',
            'divisionId'      => 'required|exists:divisions,id',
            'countryId'       => 'required|exists:countries,id',
            'status'          => 'required|in:1,0',
        ],
        [
            'districtname.required' => 'District Name Field must not be Empty',
            'districtname.unique'   => 'The District Name is already exist',
            'divisionId.required'    => "Division Field is required !!",
            'divisionId.exists'      => "Invalid Division Field !!",
            'countryId.required'     => "Country Field is required !!",
            'countryId.exists'       => "Invalid Country Field !!",
            'status.required'        => 'Status Field is required',
            'status.in'              => 'Invalid status option selected',
        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'divisionId'      => 'required|exists:divisions,id',
            'countryId'       => 'required|exists:countries,id',
            'status'          => 'required|in:1,0',
        ],
        [
            'divisionId.required'    => "Division Field is required !!",
            'divisionId.exists'      => "Invalid Division Field !!",
            'countryId.required'     => "Country Field is required !!",
            'countryId.exists'       => "Invalid Country Field !!",
            'status.required'        => 'Status Field is required',
            'status.in'              => 'Invalid status option selected',
        ]);
    }
}