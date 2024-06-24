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

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_country = Country::orderBy('countryname', 'asc')->get();
        return view('super.location.country.index', compact('all_country'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $country_create = Country::orderBy('countryname', 'asc')->get(); 
        return view('super.location.country.create', [
            'country_create'       =>  $country_create
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $existingRecord = Country::where([
            'countryname'=>$request->countryname,
            'nationality'=>$request->nationality,
            'currency'=>$request->currency,
            'phone_code'=>$request->phone_code,
        ])->first();
        if (!$existingRecord){
            $this->validation($request);
            Country::create([
                'countryname' => $request->countryname,
                'nationality' => $request->nationality,
                'currency'    => $request->currency,
                'phone_code'  => $request->phone_code,
                'status'      => $request->status,
            ]);
            return redirect() -> back() -> with('message', 'Country is added successfully');
        }else{
            return redirect() -> back() -> with('error_message', 'The Country Name is already exist in the table !');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $single_country = Country::find($id);
        
        if ($single_country !== null) {
            return view('super.location.country.show', compact('single_country'));
        }else{
            return redirect('/super/country');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $country_data = Country::find($id);
        
        if ($country_data !== null) {
            return view('super.location.country.edit', compact('country_data'));
        }else{
            return redirect('/super/country');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $country_data = Country::findOrFail($id);
        $existingRecord = Country::where([
            'countryname'=>$request->countryname,
            'nationality'=>$request->nationality,
            'currency'=>$request->currency,
            'phone_code'=>$request->phone_code,
        ])->first();
        if (!$existingRecord){
            $this->validationInfo($request);
            $country_data->countryname = $request->countryname;
            $country_data->nationality = $request->nationality;
            $country_data->currency    = $request->currency;
            $country_data->phone_code  = $request->phone_code;
            $country_data->update();              

            return back()->with('message', 'The Country Info is Updated Successfully');
        }else{
            return redirect() -> back() -> with('error_message', 'The Country Info is already exist in the table !');
        }
    }

    public function editNationality($id)
    {
        $country_National = Country::find($id);
        
        if ($country_National !== null) {
            return view('super.location.country.editNational', compact('country_National'));
        }else{
            return redirect('/super/country');
        }
    }

    public function updateNationality(Request $request, $id)
    {
        $this->validationNationality($request);
        $country_National = Country::findOrFail($id);

        $country_National->nationality        = $request->nationality;
        $country_National->update();              

        return back()->with('message', 'The Nationality is Updated Successfully');
    }

    public function editCurrency($id)
    {
        $country_currency = Country::find($id);
        if ($country_currency !== null) {
            return view('super.location.country.editCurrency', compact('country_currency'));
        }else{
            return redirect('/super/country');
        }
    }

    public function updateCurrency(Request $request, $id)
    {
        $this -> validate($request, [
            'currency'          => 'required|unique:countries',
        ],
        [
            'currency.required' => 'Currency Field is required',
            'currency.unique'   => 'The Currency is already exist',
        ]);
        $country_currency = Country::findOrFail($id);

        $country_currency->currency        = $request->currency;
        $country_currency->update();              

        return back()->with('message', 'The Currency is Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data_country = Country::find($id);
        $data_country -> delete();

        return redirect() -> back() -> with('message', 'The Country is deleted successfully');
    }

    public function inactive($id)
    {

        $country_inactive = Country::findOrFail($id);

        $country_inactive->status      = 0;
        $country_inactive->update();              

        return redirect('/super/country')->with('message', 'The Country is Inactive Successfully');
    }
    
    public function active($id)
    {

        $country_active = Country::findOrFail($id);

        $country_active->status        = 1;
        $country_active->update();              

        return redirect('/super/country')->with('message', 'The Country is Active Successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'countryname'       => 'required',
            'nationality'       => 'required',
            'currency'          => 'required',
            'status'            => 'required|in:1,0',
        ],
        [
            'countryname.required' => 'Country Name Field must not be Empty',
            'nationality.required' => 'Nationality Field is required',
            'currency.required'    => 'Currency Field is required',
            'status.required'      => 'Status Field is required',
            'status.in'            => 'Invalid status option selected',
        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'countryname'       => 'required',
            'nationality'       => 'required',
            'currency'          => 'required',
        ],
        [
            'countryname.required' => 'Country Name Field must not be Empty',
            'currency.required'    => 'Currency Field is required',
            'nationality.required' => 'Nationality Field is required',
        ]);
    }

    protected function validationNationality($request){
        $this -> validate($request, [
            'nationality'       => 'required|unique:countries',
        ],
        [
            'nationality.required' => 'Nationality Field is required',
            'nationality.unique'   => 'The Nationality is already exist',
        ]);
    }
}