<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Super;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SuperLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use App\Models\Country;
use App\Models\Division;
use App\Models\District;
use App\Models\Policestation;
use App\Models\City;
use App\Models\Issue;
use Illuminate\Support\Facades\DB;

class SuperController extends Controller
{
    protected $redirectTo = RouteServiceProvider::SUPER;

    public function index(){
        $data = Super::latest() -> get(); // as latest
        return view('super.home.index');
    }

    public function login(){
        $users = Super::latest() -> get();
        if (count($users) > 0) {
            return view('super.users.login');
        }else{
            $user = new Super();
            $user->fullname = 'Abdullah';
            $user->username = 'Super';
            $user->type = 'Super';
            $user->gender = 1;
            $user->phone = '01815141595';
            $user->email = 'ahsum1558@gmail.com';
            $user->password = Hash::make('12345');
            $user->save();

            return view('super.users.login');
        }

    }

    public function superStore(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();

            $this->validation($request);

            if(Auth::guard('super')->attempt([
                'username' => $data['username'],
                'password' => $data['password']
            ])){
                return redirect('/super');
            }else{
                return redirect()->back()->with("error_message", "Invalid Username or Password");
            }
        }
    }

    public function superProfile(){
        $id = Auth::guard('super')->user()->id;
        $superDetails = $this->getDetails($id);
        return view('super.users.super_profile', compact('superDetails'));
    }

    public function getDivision(Request $request)
    {
        $all_division = Division::where([
            'countryId'=>$request->country_id
        ])->where('status','=',1)->orderBy('divisionname', 'asc')->get();

        return view('super.users.ajax',[
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
            return view('super.users.ajax_district',[
                'all_district'=>$all_district,
            ]);
        }
    }

    public function getCity(Request $request)
    {
        $all_city = City::where([
            'districtId'=>$request->district_id,
            'divisionId'=>$request->division_id,
            'countryId'=>$request->country_id
        ])->where('status','=',1)->orderBy('cityname', 'asc')->get();

        if (count($all_city)>0) {
            return view('super.users.ajax_city',[
                'all_city'=>$all_city,
            ]);
        }
    }

    public function getUpzila(Request $request)
    {
        $all_upzila = Policestation::where([
            'districtId'=>$request->district_id,
            'divisionId'=>$request->division_id,
            'countryId'=>$request->country_id
        ])->where('status','=',1)->orderBy('policestationname', 'asc')->get();

        if (count($all_upzila)>0) {
            return view('super.users.ajax_upzila',[
                'all_upzila'=>$all_upzila,
            ]);
        }
    }

    public function superProfileInfo(){
        $id = Auth::guard('super')->user()->id;
        $superData = Super::find($id);

        $all_country = Country::where('status', 1)->orderBy('countryname', 'asc')->get();
        $all_division = Division::where('status', 1)->orderBy('divisionname', 'asc')->get();
        $all_district = District::where('status', 1)->orderBy('districtname', 'asc')->get();
        $all_city = City::where('status', 1)->orderBy('cityname', 'asc')->get();
        $all_upzila = Policestation::where('status', 1)->orderBy('policestationname', 'asc')->get();

        return view('super.users.super_profile_info', [
            'superData'=>$superData,
            'all_country'=>$all_country,
            'all_division'=>$all_division,
            'all_district'=>$all_district,
            'all_city'=>$all_city,
            'all_upzila'=>$all_upzila,
        ]);
    }

    public function superProfileInfoUpdate(Request $request){
        $id = Auth::guard('super')->user()->id;
        $data = Super::find($id);

        $this->validationInfo($request);
        
        $data->fullname           = $request->fullname;
        $data->designation        = $request->designation;
        $data->phone              = $request->phone;
        $data->dateOfBirth        = $request->dateOfBirth;
        $data->gender             = $request->gender;
        $data->address            = $request->address;
        $data->policestationId    = $request->policestationId;
        $data->districtId         = $request->districtId;
        $data->divisionId         = $request->divisionId;
        $data->cityId             = $request->cityId;
        $data->countryId          = $request->countryId;
        $data->zipcode            = $request->zipcode;
        $data->description        = $request->description;
        $data->type               = $request->type;
        $data->update();              

        return back()->with('message', 'Super Information is Updated Successfully');
    }

    public function superProfileUsername(){
        $id = Auth::guard('super')->user()->id;
        $superData = Super::find($id);
        return view('super.users.super_profile_username', compact('superData'));
    }

    public function superProfileUsernameUpdate(Request $request){
        $id = Auth::guard('super')->user()->id;
        $data = Super::find($id);

        $rules = [
                'username' => 'required|unique:supers|max:255',
            ];

            $customMessage = [
                'username.required' => "Field must not be empty !!",
                'username.unique' => "Username is Already Exist !!",
            ];

            $this->validate($request, $rules, $customMessage);
        
        $data->username        = $request->username;
        $data->update();              

        return back()->with('message', 'Super Username is Updated Successfully');
    }

    public function superProfileEmail(){
        $id = Auth::guard('super')->user()->id;
        $superData = Super::find($id);
        return view('super.users.super_profile_email', compact('superData'));
    }

    public function superProfileEmailUpdate(Request $request){
        $id = Auth::guard('super')->user()->id;
        $data = Super::find($id);

        $rules = [
                'email' => 'required|email|unique:supers|max:255',
            ];

            $customMessage = [
                'email.required' => "Field must not be empty !!",
                'email.unique' => "E-Mail is Already Exist !!",
                'email.email' => "E-Mail Address is not valid !!",
            ];

            $this->validate($request, $rules, $customMessage);
        
        $data->email        = $request->email;
        $data->update();              

        return back()->with('message', 'Super E-Mail is Updated Successfully');
    }

    public function superProfileImage(){
        $id = Auth::guard('super')->user()->id;
        $superData = Super::find($id);
        return view('super.users.super_profile_image', compact('superData'));
    }

    public function superProfileImageUpdate(Request $request){
        $id = Auth::guard('super')->user()->id;
        $data = Super::find($id);

        $request->validate([
            'new_photo' => 'required|file|max:40', 
        ]);

        if ($request->hasFile('new_photo')) {
            $img = $request -> file('new_photo');
            $unique_file_name = md5(time().rand()) . '.' . $img -> getClientOriginalExtension();

            if ($img->getSize() > 40 * 1024) {
                return back()->withErrors(['new_photo' => 'The file size should not exceed 40 KB.'])->withInput();
            }

            $img->move(public_path('admin/uploads/super/'), $unique_file_name);
            // if(file_exists('public/admin/uploads/super/' .$request->old_photo)){
            //     unlink('public/admin/uploads/super/' .$request->old_photo);
            // }
            if(File::exists('public/admin/uploads/super/' .$request->old_photo)) {
                File::delete('public/admin/uploads/super/' .$request->old_photo);
              }
        }else{
            $unique_file_name = $request->old_photo;
        }

        $data->photo     = $unique_file_name;
        $data->update();
        
        return back()->with('message', 'Super Profile Image is Updated Successfully');
    }

    public function superProfilePassword(){
        $id = Auth::guard('super')->user()->id;
        $superData = Super::find($id);
        return view('super.users.super_profile_password', compact('superData'));
    }

    public function superProfilePasswordUpdate(Request $request){
        $id = Auth::guard('super')->user()->id;
        $data = Super::find($id);

        $this->validationPassword($request);

        $oldPassword = $request->old_password;
        if (!Hash::check($oldPassword, $data->password)) {
            return back()->with('error_message', 'Old password does not match ! Please try again');
        }

        if (Hash::check($oldPassword, $data->password)) {
        $data->password = Hash::make($request->new_password);
        $data->update();
        return back()->with('message', 'Super Password is Updated Successfully');
        }
    }

    public function superProfileTheme(){
        $id = Auth::guard('super')->user()->id;
        $superData = Super::find($id);
        return view('super.users.super_profile_theme', compact('superData'));
    }

    public function superProfileThemeUpdate(Request $request){
        $id = Auth::guard('super')->user()->id;
        $data = Super::find($id);

        $data->theme        = $request->theme;
        $data->update();              

        return back()->with('message', 'The Theme is Updated Successfully');
    }

    public function store(SuperLoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::SUPER);
    }

    public function superLogout(Request $request): RedirectResponse
    {
        Auth::guard('super')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('super/login');
    }

     protected function validation($request){
        $this -> validate($request, [
            'username' => 'required|max:255',
            'password' => 'required|max:30'
        ],
        [
            'username.required' => "Username is required",
            'password.required' => "Password is required",
        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'fullname'      => 'required|max:255',
            'designation'   => 'required|max:255',
            'phone'         => 'required|numeric',
            'dateOfBirth'   => 'required|date',
            'gender'        => 'required|in:1,2,3',
            'address'         => 'required',
            'zipcode'         => 'required',
            'policestationId' => 'required|exists:policestations,id',
            'districtId'      => 'required|exists:districts,id',
            'divisionId'      => 'required|exists:divisions,id',
            'countryId'       => 'required|exists:countries,id',
            'cityId'          => 'required|exists:cities,id',
        ],
        [
            'fullname.required'    => "Name Field must not be empty !!",
            'designation.required' => "Designation Field must not be empty !!",
            'phone.required'       => "Phone Field must not be empty !!",
            'phone.numeric'        => "Phone number is not valid !!",
            'dateOfBirth.required' => 'Date of Birth Field is required',
            'gender.required'     => 'Gender Field is required',
            'gender.in'           => 'Invalid Gender option selected',
            'address.required'     => 'Office Address Field must not be Empty',
            'zipcode.required'  => 'Zipcode Field must not be Empty',
            'policestationId.required' => "Police Station Field is required !!",
            'policestationId.exists' => "Invalid Police Station Field !!",
            'districtId.required'    => "District Field is required !!",
            'districtId.exists'      => "Invalid District Field !!",
            'divisionId.required'    => "Division Field is required !!",
            'divisionId.exists'      => "Invalid Division Field !!",
            'countryId.required'     => "Country Field is required !!",
            'countryId.exists'       => "Invalid Country Field !!",
            'cityId.required'        => "City Field is required !!",
            'cityId.exists'          => "Invalid City Field !!",
        ]);
    }

    protected function validationPassword($request){
        $this -> validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|confirmed|different:old_password',
            'new_password_confirmation' => 'required',
        ],
        [
            'old_password.required' => "Old Password Field must not be empty !!",
            'new_password.required' => "New Password Field must not be empty !!",
            'new_password.different' => "New Password should be different old password !!",
            'new_password_confirmation.required' => "Confirm New Password Field must not be empty !!",
        ]);
    }

    protected function getDetails($id){
        $data_details = DB::table('supers')
            ->leftJoin('countries', 'supers.countryId', '=', 'countries.id')
            ->where('supers.id', $id)
            ->leftJoin('divisions', 'supers.divisionId', '=', 'divisions.id')
            ->leftJoin('districts', 'supers.districtId', '=', 'districts.id')
            ->leftJoin('policestations', 'supers.policestationId', '=', 'policestations.id')
            ->leftJoin('cities', 'supers.cityId', '=', 'cities.id')
            ->select('supers.*', 'countries.countryname', 'countries.nationality', 'countries.currency', 'countries.phone_code', 'divisions.divisionname', 'districts.districtname', 'policestations.policestationname', 'cities.cityname')
            ->get();
        return $data_details;
    }
}