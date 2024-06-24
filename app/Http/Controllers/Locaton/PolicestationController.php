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

class PolicestationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_upzila = $this->getInfo();
        return view('super.location.policestation.index', compact('all_upzila'));
    }

    public function getDivision(Request $request)
    {
        $all_division = Division::where([
            'countryId'=>$request->country_id
        ])->where('status','=',1)->orderBy('divisionname', 'asc')->get();

        return view('super.location.policestation.ajax',[
            'all_division'=>$all_division,
        ]);
    }

    public function getDistrict(Request $request)
    {
        $all_district = District::where([
            'divisionId'=>$request->division_id,
            'countryId'=>$request->country_id
        ])->where('status','=',1)->orderBy('districtname', 'asc')->get();

        if (count($all_district)>0) {
            return view('super.location.policestation.ajax_district',[
                'all_district'=>$all_district,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $upzila_create =Policestation::orderBy('policestationname', 'asc')->get();
        $all_country = Country::where('status', 1)->orderBy('countryname', 'asc')->get();

        return view('super.location.policestation.create', [
            'upzila_create'   =>  $upzila_create,
            'all_country'     =>  $all_country
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        $upzila_create = new Policestation();

        $upzila_create->policestationname = $request->policestationname; 
        $upzila_create->districtId    = $request->districtId; 
        $upzila_create->divisionId    = $request->divisionId; 
        $upzila_create->countryId     = $request->countryId; 
        $upzila_create->status        = $request->status; 
        $upzila_create->save();

        return redirect() -> back() -> with('message', 'Police Station is added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $upzila_single_data = $this->getDetails($id);
        
        if($upzila_single_data->count() > 0){
            return view('super.location.policestation.show', compact('upzila_single_data'));
        }else{
            return redirect('/super/upzila');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $upzila_data = $this->getDetails($id);
        
        if($upzila_data->count() > 0){
            return view('super.location.policestation.edit', compact('upzila_data'));
        }else{
            return redirect('/super/upzila');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this -> validate($request, [
            'policestationname'   => 'required|unique:policestations',
        ],
        [
            'policestationname.required' => 'Police Station Name Field must not be Empty',
            'policestationname.unique'   => 'The Police Station Name is already exist',
        ]);

        $upzila_data = Policestation::findOrFail($id);

        $upzila_data->policestationname = $request->policestationname; 
        $upzila_data->update();

        return redirect() -> back() -> with('message', 'Police Station Name is Updated successfully');
    }

    public function editInfo($id)
    {
        $upzila_data_info = $this->getDetails($id);
        $all_country = Country::where('status', 1)->orderBy('countryname', 'asc')->get();
        $all_division = Division::where('status', 1)->orderBy('divisionname', 'asc')->get();
        $all_district = District::where('status', 1)->orderBy('districtname', 'asc')->get();
        
        if($upzila_data_info->count() > 0){
            return view('super.location.policestation.editInfo', [
            'upzila_data_info'=>$upzila_data_info,
            'all_country'=>$all_country,
            'all_division'=>$all_division,
            'all_district'=>$all_district,
        ]);
        }else{
            return redirect('/super/upzila');
        }
    }

    public function updateInfo(Request $request, $id)
    {
        $this->validationInfo($request);
        $upzila_data_info = Policestation::findOrFail($id);

        $upzila_data_info->districtId  = $request->districtId;
        $upzila_data_info->divisionId  = $request->divisionId;
        $upzila_data_info->countryId   = $request->countryId;
        $upzila_data_info->status      = $request->status;
        $upzila_data_info->update();

        return redirect() -> back() -> with('message', 'Police Station Info is Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data_upzila = Policestation::find($id);
        $data_upzila -> delete();

        return redirect() -> back() -> with('message', 'The Police Station is deleted successfully');
    }

    public function inactive($id)
    {

        $upzila_inactive = Policestation::findOrFail($id);

        $upzila_inactive->status      = 0;
        $upzila_inactive->update();              

        return redirect('/super/upzila')->with('message', 'The Police Station is Inactive Successfully');
    }
    
    public function active($id)
    {

        $upzila_active = Policestation::findOrFail($id);

        $upzila_active->status    = 1;
        $upzila_active->update();              

        return redirect('/super/upzila')->with('message', 'The Police Station is Active Successfully');
    }

    protected function getInfo(){
        $data_info = DB::table('policestations')
            ->leftJoin('countries', 'policestations.countryId', '=', 'countries.id')
            ->leftJoin('divisions', 'policestations.divisionId', '=', 'divisions.id')
            ->leftJoin('districts', 'policestations.districtId', '=', 'districts.id')
            ->select('policestations.*', 'countries.countryname', 'countries.nationality', 'divisions.divisionname', 'districts.districtname')
            ->orderBy('countries.countryname')
            ->orderBy('divisions.divisionname')
            ->orderBy('districts.districtname')
            ->orderBy('policestations.policestationname')
            ->get();
        return $data_info;
    }

    protected function getDetails($id){
        $data_details = DB::table('policestations')
            ->leftJoin('countries', 'policestations.countryId', '=', 'countries.id')
            ->where('policestations.id', $id)
            ->leftJoin('divisions', 'policestations.divisionId', '=', 'divisions.id')
            ->leftJoin('districts', 'policestations.districtId', '=', 'districts.id')
            ->select('policestations.*', 'countries.countryname', 'countries.nationality', 'divisions.divisionname', 'districts.districtname')
            ->get();
        return $data_details;
    }

    protected function validation($request){
        $this -> validate($request, [
            'policestationname'   => 'required|unique:policestations',
            'districtId'      => 'required|exists:districts,id',
            'divisionId'      => 'required|exists:divisions,id',
            'countryId'       => 'required|exists:countries,id',
            'status'          => 'required|in:1,0',
        ],
        [
            'policestationname.required' => 'Police Station Name Field must not be Empty',
            'policestationname.unique'   => 'The Police Station Name is already exist',
            'districtId.required'    => "District Field is required !!",
            'districtId.exists'      => "Invalid District Field !!",
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
            'districtId'      => 'required|exists:districts,id',
            'divisionId'      => 'required|exists:divisions,id',
            'countryId'       => 'required|exists:countries,id',
            'status'          => 'required|in:1,0',
        ],
        [
            'districtId.required'    => "District Field is required !!",
            'districtId.exists'      => "Invalid District Field !!",
            'divisionId.required'    => "Division Field is required !!",
            'divisionId.exists'      => "Invalid Division Field !!",
            'countryId.required'     => "Country Field is required !!",
            'countryId.exists'       => "Invalid Country Field !!",
            'status.required'        => 'Status Field is required',
            'status.in'              => 'Invalid status option selected',
        ]);
    }
}