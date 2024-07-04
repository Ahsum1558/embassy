<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Super;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SuperLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\View\View;
use App\Models\Country;
use App\Models\Division;
use App\Models\District;
use App\Models\Policestation;
use App\Models\City;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index(){
        $data = User::latest() -> get();
        $all_slider = Slider::latest()->where('status','=',1) -> get();
        if (Auth::check() && Auth::user()->status === 'active') {
            return view('admin.home.index', compact('data', 'all_slider'));
        }elseif(Auth::check() && Auth::user()->status !== 'active') {
            Auth::logout();
            return redirect('/login')->with(['error_message' => 'Your account is inactive. Please contact the administrator.']);
        }
    }

    public function login(){
        $users = User::latest() -> get();
        if (count($users) > 0) {
            return view('admin.users.login');
        }
    }

    public function userStore(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();

            $this->validation($request);

            if(Auth::attempt([
                'username' => $data['username'],
                'password' => $data['password']
            ])){
                return redirect('/');
            }else{
                return redirect()->back()->with("error_message", "Invalid Username or Password");
            }
        }
    }

    public function register(){
        $register_data = User::latest() -> get(); // as latest
        if (Auth::check() && Auth::user()->status === 'active') {
            return view('admin.home.index');
        }
        return view('admin.users.register', compact('register_data'));
    }

    public function registerStore(Request $request)
    {
        $this->validationRegister($request);
        $user_data = User::create([
            'username'             => $request->username,
            'name'                 => $request->name,
            'phone'                => $request->phone,
            'designation'          => $request->designation,
            'email'                => $request->email,
            'title'                => NULL,
            'smalltitle'           => NULL,
            'license'              => NULL,
            'title_bn'             => NULL,
            'license_bn'           => NULL,
            'title_ar'             => NULL,
            'license_ar'           => NULL,
            'type'                 => 'pending',
            'role'                 => 'admin',
            'status'               => 'active',
            'gender'               => 1,
            'password'             => Hash::make($request->password),
        ]);

        if($request->isMethod('post')){
            $data = $request->all();

            if(Auth::attempt([
                'username' => $data['username'],
                'password' => $data['password']
            ])){
                return redirect('/');
            }
        }

        return redirect() -> back() -> with('message', 'The registration is completed successfully');
    }

    public function userProfile(){
        $id = Auth::user()->id;
        $profile_data = $this->getDetails($id);
        return view('admin.users.profile', compact('profile_data'));
    }

    public function customerRef(){
        $id = Auth::user()->id;
        $customer_ref = $this->getUserDetails($id);
        return view('admin.users.customerRef', compact('customer_ref'));
    }

    public function getDivision(Request $request)
    {
        $all_division = Division::where([
            'countryId'=>$request->country_id
        ])->where('status','=',1)->orderBy('divisionname', 'asc')->get();

        return view('admin.users.ajax',[
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
            return view('admin.users.ajax_district',[
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
            return view('admin.users.ajax_city',[
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
            return view('admin.users.ajax_upzila',[
                'all_upzila'=>$all_upzila,
            ]);
        }
    }

    public function profileInfoEdit(){
        $id = Auth::user()->id;
        $user_info = User::find($id);
        $all_country = Country::where('status', 1)->orderBy('countryname', 'asc')->get();
        $all_division = Division::where('status', 1)->orderBy('divisionname', 'asc')->get();
        $all_district = District::where('status', 1)->orderBy('districtname', 'asc')->get();
        $all_city = City::where('status', 1)->orderBy('cityname', 'asc')->get();
        $all_upzila = Policestation::where('status', 1)->orderBy('policestationname', 'asc')->get();
        
        return view('admin.users.profile_info', [
            'user_info'=>$user_info,
            'all_country'=>$all_country,
            'all_division'=>$all_division,
            'all_district'=>$all_district,
            'all_city'=>$all_city,
            'all_upzila'=>$all_upzila,
        ]);
    }

    public function profileInfoUpdate(Request $request){
        $id = Auth::user()->id;
        $user_info = User::find($id);

        $this->validationInfo($request);

        $user_info->name               = $request->name;
        $user_info->licenseExpiry      = $request->licenseExpiry;
        $user_info->description        = $request->description;
        $user_info->proprietor         = $request->proprietor;
        $user_info->proprietortitle    = $request->proprietortitle;
        $user_info->address            = $request->address;
        $user_info->phone              = $request->phone;
        $user_info->description_bn     = $request->description_bn;
        $user_info->proprietor_bn      = $request->proprietor_bn;
        $user_info->proprietortitle_bn = $request->proprietortitle_bn;
        $user_info->address_bn         = $request->address_bn;
        $user_info->telephone_bn       = $request->telephone_bn;
        $user_info->description_ar     = $request->description_ar;
        $user_info->address_ar         = $request->address_ar;
        $user_info->proprietor_ar      = $request->proprietor_ar;
        $user_info->proprietortitle_ar = $request->proprietortitle_ar;
        $user_info->telephone_ar       = $request->telephone_ar;
        $user_info->policestationId    = $request->policestationId;
        $user_info->districtId         = $request->districtId;
        $user_info->divisionId         = $request->divisionId;
        $user_info->cityId             = $request->cityId;
        $user_info->countryId          = $request->countryId;
        $user_info->zipcode            = $request->zipcode;
        $user_info->dateOfBirth        = $request->dateOfBirth;
        $user_info->designation        = $request->designation;
        $user_info->gender             = $request->gender;
        $user_info->update();             

        return back()->with('message', 'The Office Information is Updated Successfully');
    }

    public function profileUsername(){
        $id = Auth::user()->id;
        $username_data = User::find($id);
        return view('admin.users.profile_username', compact('username_data'));
    }

    public function profileUsernameUpdate(Request $request){
        $id = Auth::user()->id;
        $username_data = User::find($id);

        $rules = [
                'username' => 'required|unique:users|max:255',
            ];

            $customMessage = [
                'username.required' => "Field must not be empty !!",
                'username.unique' => "Username is Already Exist !!",
            ];

            $this->validate($request, $rules, $customMessage);
        
        $username_data->username    = $request->username;
        $username_data->update();              

        return back()->with('message', 'Username is Updated Successfully');
    }

    public function profileEmail(){
        $id = Auth::user()->id;
        $email_data = User::find($id);
        return view('admin.users.profile_email', compact('email_data'));
    }

    public function profileEmailUpdate(Request $request){
        $id = Auth::user()->id;
        $email_data = User::find($id);

        $rules = [
                'email' => 'required|email|unique:users|max:255',
            ];

            $customMessage = [
                'email.required' => "Field must not be empty !!",
                'email.unique' => "E-Mail is Already Exist !!",
                'email.email' => "E-Mail Address is not valid !!",
            ];

            $this->validate($request, $rules, $customMessage);
        
        $email_data->email       = $request->email;
        $email_data->update();              

        return back()->with('message', 'E-Mail is Updated Successfully');
    }

    public function profileImage(){
        $id = Auth::user()->id;
        $image_data = User::find($id);
        return view('admin.users.profile_image', compact('image_data'));
    }

    public function profileImageUpdate(Request $request){
        $id = Auth::user()->id;
        $image_data = User::find($id);

        $request->validate([
            'new_photo' => 'required|file|max:40', 
        ]);

        if ($request->hasFile('new_photo')) {
            $img = $request -> file('new_photo');
            $unique_file_name = md5(time().rand()) . '.' . $img -> getClientOriginalExtension();

            if ($img->getSize() > 40 * 1024) {
                return back()->withErrors(['new_photo' => 'The file size should not exceed 40 KB.'])->withInput();
            }

            $img->move(public_path('admin/uploads/user/'), $unique_file_name);
            // if(file_exists('public/admin/uploads/user/' .$request->old_photo)){
            //     unlink('public/admin/uploads/user/' .$request->old_photo);
            // }
            if(File::exists('public/admin/uploads/user/' .$request->old_photo)) {
                File::delete('public/admin/uploads/user/' .$request->old_photo);
              }
        }else{
            $unique_file_name = $request->old_photo;
        }

        $image_data->photo     = $unique_file_name;
        $image_data->update();
        
        return back()->with('message', 'Profile Image is Updated Successfully');
    }

    public function profilePassword(){
        $id = Auth::user()->id;
        $password_data = User::find($id);
        return view('admin.users.profile_password', compact('password_data'));
    }

    public function profilePasswordUpdate(Request $request){
        $id = Auth::user()->id;
        $password_data = User::find($id);

        $this->validationPassword($request);

        $oldPassword = $request->old_password;
        if (!Hash::check($oldPassword, $password_data->password)) {
            return back()->with('error_message', 'Old password does not match ! Please try again');
        }

        if (Hash::check($oldPassword, $password_data->password)) {
        $password_data->password = Hash::make($request->new_password);
        $password_data->update();
        return back()->with('message', 'Password is Updated Successfully');
        }
    }

    public function userProfileTheme(){
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('admin.users.profile_theme', compact('userData'));
    }

    public function userProfileThemeUpdate(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->theme        = $request->theme;
        $data->update();              

        return back()->with('message', 'The Theme is Updated Successfully');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
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

    protected function validationRegister($request){
        $this -> validate($request, [
            'name'            => 'required',
            'username'        => 'required|unique:users',
            'email'           => 'required|email|unique:users',
            'password'        => 'required|confirmed|min:4',
            'password_confirmation' => 'required_with:password|same:password|min:4',
            'designation'     => 'required|max:255',
            'phone'           => 'required|numeric',
        ],
        [
            'name.required'     => "Name Field must not be empty !!",
            'username.required' => "Username Field must not be empty !!",
            'username.unique'   => "Username is Already Exist !!",
            'email.required'    => "E-Mail Field must not be empty !!",
            'email.unique'      => "E-Mail is Already Exist !!",
            'email.email'       => "E-Mail Address is not valid !!",
            'password.required' => "Password Field must not be empty !!",
            'password_confirmation.required' => "Confirm Password Field must not be empty !!",
            'designation.required' => "Designation Field must not be empty !!",
            'phone.required'    => "Phone Field must not be empty !!",
            'phone.numeric'     => "Phone number is not valid !!",
        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'name'            => 'required',
            'designation'     => 'required|max:255',
            'telephone_bn'    => 'required',
            'telephone_ar'    => 'required',
            'gender'          => 'required|in:1,2,3',
            'dateOfBirth'     => 'required|date',
            'address'         => 'required',
            'address_bn'      => 'required',
            'address_ar'      => 'required',
            'zipcode'         => 'required',
            'policestationId' => 'required|exists:policestations,id',
            'districtId'      => 'required|exists:districts,id',
            'divisionId'      => 'required|exists:divisions,id',
            'countryId'       => 'required|exists:countries,id',
            'cityId'          => 'required|exists:cities,id',
            'licenseExpiry'   => 'required|date',
            'description'     => 'required',
            'proprietor'      => 'required',
            'proprietortitle' => 'required',
            'description_bn'  => 'required',
            'proprietor_bn'   => 'required',
            'proprietortitle_bn' => 'required',
            'description_ar'  => 'required',
            'proprietor_ar'   => 'required',
            'proprietortitle_ar' => 'required',
            'phone'           => 'required|numeric',
        ],
        [
            'name.required'     => "Name Field must not be empty !!",
            'designation.required' => "Designation Field must not be empty !!",
            'telephone_bn.required' => "Phone Number in Bengali Field must not be empty !!",
            'telephone_ar.required' => "Phone Number in Arabic Field must not be empty !!",
            'gender.required'      => 'Gender Field is required',
            'gender.in'            => 'Invalid Gender option selected',
            'dateOfBirth.required' => 'Date of Birth Field is required',
            'address.required'     => 'Office Address Field must not be Empty',
            'address_bn.required'  => 'Office Address in Bengali Field must not be Empty',
            'address_ar.required'  => 'Office Address in Arabic Field must not be Empty',
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
            'licenseExpiry.required' => 'License Expiry Date Field must not be Empty',
            'description.required'  => 'Description Field must not be Empty',
            'proprietor.required' => 'Proprietor Name Field must not be Empty',
            'proprietortitle.required' => 'Proprietor Title Field must not be Empty',
            'description_bn.required'  => 'Description in Bengali Field must not be Empty',
            'proprietor_bn.required'  => 'Proprietor Name in Bengali Field must not be Empty',
            'proprietortitle_bn.required'  => 'Proprietor Title in Bengali Field must not be Empty',
            'description_ar.required'  => 'Description in Arabic Field must not be Empty',
            'proprietor_ar.required'  => 'Proprietor Name in Arabic Field must not be Empty',
            'proprietortitle_ar.required'  => 'Proprietor Title in Arabic Field must not be Empty',
            'phone.required'    => "Phone Field must not be empty !!",
            'phone.numeric'     => "Phone number is not valid !!",
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

    protected function getInfo(){
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

    protected function getDetails($id){
        $data_details = DB::table('users')
            ->leftJoin('countries', 'users.countryId', '=', 'countries.id')
            ->where('users.id', $id)
            ->leftJoin('divisions', 'users.divisionId', '=', 'divisions.id')
            ->leftJoin('districts', 'users.districtId', '=', 'districts.id')
            ->leftJoin('cities', 'users.cityId', '=', 'cities.id')
            ->leftJoin('policestations', 'users.policestationId', '=', 'policestations.id')
            ->select('users.*', 'countries.countryname', 'countries.nationality', 'countries.currency', 'countries.phone_code', 'divisions.divisionname', 'districts.districtname', 'cities.cityname', 'policestations.policestationname')
            ->get();
        return $data_details;
    }
}