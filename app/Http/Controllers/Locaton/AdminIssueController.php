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

class AdminIssueController extends Controller
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
        $all_issue = $this->getInfo();
        return view('admin.location.issue.index', compact('all_issue'));
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
        $issue_create = Issue::orderBy('issuePlace', 'asc')->get();
        $all_country = Country::where('status', 1)->orderBy('countryname', 'asc')->get();

        if(Auth::check() && Auth::user()->role == 'admin' && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            return view('admin.location.issue.create', [
                'issue_create'=>$issue_create,
                'all_country'=>$all_country
            ]);
        }else{
            return redirect('/issue');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);
        $issue_create = new Issue();

        $issue_create->issuePlace  = $request->issuePlace; 
        $issue_create->countryId   = $request->countryId;
        $issue_create->status      = $request->status;
        $issue_create->save();

        return redirect() -> back() -> with('message', 'Issue Place is added successfully');
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
        $issue_single_data = $this->getDetails($id);
        
        if($issue_single_data->count() > 0){
            return view('admin.location.issue.show', compact('issue_single_data'));
        }else{
            return redirect('/issue');
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
        $issue_data = $this->getDetails($id);
        
        if($issue_data->count() > 0){
            if(Auth::check() && Auth::user()->role == 'admin' && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
                return view('admin.location.issue.edit', compact('issue_data'));
            }else{
            return redirect('/issue');
        }
        }else{
            return redirect('/issue');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this -> validate($request, [
            'issuePlace'       => 'required|unique:issues',
        ],
        [
            'issuePlace.required' => 'Issue Place Name Field must not be Empty',
            'issuePlace.unique'   => 'The Issue Place Name is already exist',
        ]);

        $issue_data = Issue::findOrFail($id);

        $issue_data->issuePlace  = $request->issuePlace; 
        $issue_data->update();

        return redirect() -> back() -> with('message', 'Issue Place Name is Updated successfully');
    }

    public function editInfo($id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $issue_data_info = $this->getDetails($id);
        $all_country = Country::where('status', 1)->orderBy('countryname', 'asc')->get();
        
        if($issue_data_info->count() > 0){
            if(Auth::check() && Auth::user()->role == 'admin' && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
                return view('admin.location.issue.editInfo', [
                'issue_data_info'=>$issue_data_info,
                'all_country'=>$all_country
            ]);
            }else{
            return redirect('/issue');
        }
        }else{
            return redirect('/issue');
        }
    }

    public function updateInfo(Request $request, $id)
    {
        $this->validationInfo($request);
        $issue_data_info = Issue::findOrFail($id);

        $issue_data_info->countryId     = $request->countryId;
        $issue_data_info->status        = $request->status;
        $issue_data_info->update();

        return redirect() -> back() -> with('message', 'Issue Place Info is Updated successfully');
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
        $data_issue = Issue::find($id);
        $data_issue -> delete();

        return redirect() -> back() -> with('message', 'The Issue Place is deleted successfully');
    }

    public function inactive($id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $issue_inactive = Issue::findOrFail($id);

        $issue_inactive->status      = 0;
        $issue_inactive->update();              

        return redirect('/issue')->with('message', 'The Issue Place is Inactive Successfully');
    }
    
    public function active($id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $issue_active = Issue::findOrFail($id);

        $issue_active->status      = 1;
        $issue_active->update();              

        return redirect('/issue')->with('message', 'The Issue Place is Active Successfully');
    }

    protected function getDetails($id){
        $data_details = Issue::leftJoin('countries','issues.countryId','=','countries.id')
        ->where('issues.id', $id)
        ->select('issues.*', 'countries.countryname', 'countries.nationality')->get();
        return $data_details;
    }

    protected function getInfo(){
        $data_info = Issue::leftJoin('countries','issues.countryId','=','countries.id')
        ->select('issues.*', 'countries.countryname', 'countries.nationality')
        ->orderBy('countries.countryname')
        ->orderBy('issues.issuePlace')
        ->get();
        return $data_info;
    }

    protected function validation($request){
        $this -> validate($request, [
            'issuePlace'      => 'required|unique:issues',
            'countryId'       => 'required|exists:countries,id',
            'status'          => 'required|in:1,0',
        ],
        [
            'issuePlace.required' => 'Issue Place Name Field must not be Empty',
            'issuePlace.unique'   => 'The Issue Place Name is already exist',
            'countryId.required'  => "Country Field is required !!",
            'countryId.exists'    => "Invalid Country Field !!",
            'status.required'     => 'Status Field is required',
            'status.in'           => 'Invalid status option selected',
        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'countryId'       => 'required|exists:countries,id',
            'status'          => 'required|in:1,0',
        ],
        [
            'countryId.required'  => "Country Field is required !!",
            'countryId.exists'    => "Invalid Country Field !!",
            'status.required'     => 'Status Field is required',
            'status.in'           => 'Invalid status option selected',
        ]);
    }
}