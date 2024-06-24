<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Super;
use App\Models\User;
use App\Models\UserPayment;
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

class SuperuserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_superuser = User::latest() -> get();
        return view('super.operator.index', compact('all_superuser'));
    }

    public function getDivision(Request $request)
    {
        $all_division = Division::where([
            'countryId'=>$request->country_id
        ])->where('status','=',1)->orderBy('divisionname', 'asc')->get();

        return view('super.operator.ajax',[
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
            return view('super.operator.ajax_district',[
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
            return view('super.operator.ajax_city',[
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
            return view('super.operator.ajax_upzila',[
                'all_upzila'=>$all_upzila,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_data = User::orderBy('username') -> get();
        $all_country = Country::where('status', 1)->orderBy('countryname', 'asc')->get();
        $all_division = Division::where('status', 1)->orderBy('divisionname', 'asc')->get();
        $all_district = District::where('status', 1)->orderBy('districtname', 'asc')->get();
        $all_city = City::where('status', 1)->orderBy('cityname', 'asc')->get();
        $all_upzila = Policestation::where('status', 1)->orderBy('policestationname', 'asc')->get();
        return view('super.operator.create', [
            'user_data'=>$user_data,
            'all_country'=>$all_country,
            'all_division'=>$all_division,
            'all_district'=>$all_district,
            'all_city'=>$all_city,
            'all_upzila'=>$all_upzila,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);
        $user_data = User::create([
            'username'             => $request->username,
            'name'                 => $request->name,
            'title'                => $request->title,
            'smalltitle'           => $request->smalltitle,
            'license'              => $request->license,
            'licenseExpiry'        => $request->licenseExpiry,
            'description'          => $request->description,
            'proprietor'           => $request->proprietor,
            'proprietortitle'      => $request->proprietortitle,
            'address'              => $request->address,
            'phone'                => $request->phone,
            'title_bn'             => $request->title_bn,
            'license_bn'           => $request->license_bn,
            'description_bn'       => $request->description_bn,
            'proprietor_bn'        => $request->proprietor_bn,
            'proprietortitle_bn'   => $request->proprietortitle_bn,
            'address_bn'           => $request->address_bn,
            'telephone_bn'         => $request->telephone_bn,
            'title_ar'             => $request->title_ar,
            'license_ar'           => $request->license_ar,
            'description_ar'       => $request->description_ar,
            'address_ar'           => $request->address_ar,
            'proprietor_ar'        => $request->proprietor_ar,
            'proprietortitle_ar'   => $request->proprietortitle_ar,
            'telephone_ar'         => $request->telephone_ar,
            'policestationId'      => $request->policestationId,
            'districtId'           => $request->districtId,
            'divisionId'           => $request->divisionId,
            'cityId'               => $request->cityId,
            'countryId'            => $request->countryId,
            'zipcode'              => $request->zipcode,
            'dateOfBirth'          => $request->dateOfBirth,
            'designation'          => $request->designation,
            'payment_data'         => $request->payment_data,
            'userExpiry'           => $request->userExpiry,
            'type'                 => $request->type,
            'email'                => $request->email,
            'gender'               => $request->gender,
            'role'                 => 'user',
            'status'               => $request->status,
            'password'             => Hash::make($request->password),
        ]);
        return redirect() -> back() -> with('message', 'The Office is added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $single_user = $this->getDetails($id);
        $payments_info = UserPayment::where('userId', $id)->get();
        if($single_user->count() > 0){
            return view('super.operator.show', [
            'single_user'=>$single_user,
            'payments_info'=>$payments_info,
        ]);
        }else{
            return redirect('/super/operator');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user_info = User::find($id);
        $all_country = Country::where('status', 1)->orderBy('countryname', 'asc')->get();
        $all_division = Division::where('status', 1)->orderBy('divisionname', 'asc')->get();
        $all_district = District::where('status', 1)->orderBy('districtname', 'asc')->get();
        $all_city = City::where('status', 1)->orderBy('cityname', 'asc')->get();
        $all_upzila = Policestation::where('status', 1)->orderBy('policestationname', 'asc')->get();
        if ($user_info !== null) {
            return view('super.operator.edit', [
            'user_info'=>$user_info,
            'all_country'=>$all_country,
            'all_division'=>$all_division,
            'all_district'=>$all_district,
            'all_city'=>$all_city,
            'all_upzila'=>$all_upzila,
        ]);
        }else{
            return redirect('/super/operator');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user_info = User::findOrFail($id);
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

    public function editTitle($id)
    {
        $office_name = User::find($id);
        if ($office_name !== null) {
            return view('super.operator.editTitle', compact('office_name'));
        }else{
            return redirect('/super/operator');
        }
    }

    public function updateTitle(Request $request, $id)
    {
        $this -> validate($request, [
            'title'          => 'required|unique:users',
        ],
        [
            'title.required' => 'Office Name Field must not be Empty',
            'title.unique'   => 'The Office Name is already exist',
        ]);
        
        $office_name = User::findOrFail($id);
        $office_name->title    = $request->title;
        $office_name->update();              

        return back()->with('message', 'The Office Name is Updated Successfully');
    }

    public function editShortTitle($id)
    {
        $office_smallname = User::find($id);
        if ($office_smallname !== null) {
            return view('super.operator.editShortTitle', compact('office_smallname'));
        }else{
            return redirect('/super/operator');
        }
    }

    public function updateShortTitle(Request $request, $id)
    {
        $this -> validate($request, [
            'smalltitle'          => 'required|unique:users',
        ],
        [
            'smalltitle.required' => 'Office Short Name Field must not be Empty',
            'smalltitle.unique'  => 'The Office Short Name is already exist',
        ]);
        
        $office_smallname = User::findOrFail($id);
        $office_smallname->smalltitle  = $request->smalltitle;
        $office_smallname->update();              

        return back()->with('message', 'The Office Short Name is Updated Successfully');
    }

    public function editLicense($id)
    {
        $office_license = User::find($id);
        if ($office_license !== null) {
            return view('super.operator.editLicense', compact('office_license'));
        }else{
            return redirect('/super/operator');
        }
    }

    public function updateLicense(Request $request, $id)
    {
        $this -> validate($request, [
            'license'          => 'required|unique:users',
        ],
        [
            'license.required' => 'License Number Field is required',
            'license.unique'   => 'The License Number is already exist',
        ]);
        
        $office_license = User::findOrFail($id);
        $office_license->license    = $request->license;
        $office_license->update();              

        return back()->with('message', 'The License Number is Updated Successfully');
    }

    public function editTitlebn($id)
    {
        $office_namebn = User::find($id);
        if ($office_namebn !== null) {
            return view('super.operator.editTitlebn', compact('office_namebn'));
        }else{
            return redirect('/super/operator');
        }
    }

    public function updateTitlebn(Request $request, $id)
    {
        $this -> validate($request, [
            'title_bn'          => 'required|unique:users',
        ],
        [
            'title_bn.required' => 'Office Name in Bengali Field must not be Empty',
            'title_bn.unique'   => 'The Office Name in Bengali is already exist',
        ]);
        
        $office_namebn = User::findOrFail($id);
        $office_namebn->title_bn    = $request->title_bn;
        $office_namebn->update();              

        return back()->with('message', 'The Office Name in Bengali is Updated Successfully');
    }

    public function editLicensebn($id)
    {
        $office_licensebn = User::find($id);
        if ($office_licensebn !== null) {
            return view('super.operator.editLicensebn', compact('office_licensebn'));
        }else{
            return redirect('/super/operator');
        }
    }

    public function updateLicensebn(Request $request, $id)
    {
        $this -> validate($request, [
            'license_bn'          => 'required|unique:users',
        ],
        [
            'license_bn.required' => 'License Number in Bengali Field is required',
            'license_bn.unique'   => 'The License Number in Bengali is already exist',
        ]);
        
        $office_licensebn = User::findOrFail($id);
        $office_licensebn->license_bn    = $request->license_bn;
        $office_licensebn->update();              

        return back()->with('message', 'The License Number in Bengali is Updated Successfully');
    }

    public function editTitlear($id)
    {
        $office_namear = User::find($id);
        if ($office_namear !== null) {
            return view('super.operator.editTitlear', compact('office_namear'));
        }else{
            return redirect('/super/operator');
        }
    }

    public function updateTitlear(Request $request, $id)
    {
        $this -> validate($request, [
            'title_ar'          => 'required|unique:users',
        ],
        [
            'title_ar.required' => 'Office Name in Arabic Field must not be Empty',
            'title_ar.unique'   => 'The Office Name in Arabic is already exist',
        ]);
        
        $office_namear = User::findOrFail($id);
        $office_namear->title_ar    = $request->title_ar;
        $office_namear->update();              

        return back()->with('message', 'The Office Name in Arabic is Updated Successfully');
    }

    public function editLicensear($id)
    {
        $office_licensear = User::find($id);
        if ($office_licensear !== null) {
            return view('super.operator.editLicensear', compact('office_licensear'));
        }else{
            return redirect('/super/operator');
        }
    }

    public function updateLicensear(Request $request, $id)
    {
        $this -> validate($request, [
            'license_ar'          => 'required|unique:users',
        ],
        [
            'license_ar.required' => 'License Number in Arabic Field is required',
            'license_ar.unique'   => 'The License Number in Arabic is already exist',
        ]);
        
        $office_licensear = User::findOrFail($id);
        $office_licensear->license_ar    = $request->license_ar;
        $office_licensear->update();              

        return back()->with('message', 'The License Number in Arabic is Updated Successfully');
    }

    public function editType($id)
    {
        $data_type = User::find($id);
        if ($data_type !== null) {
            return view('super.operator.editType', compact('data_type'));
        }else{
            return redirect('/super/operator');
        }
    }

    public function updateType(Request $request, $id)
    {
        $this -> validate($request, [
            'type'         => 'required|in:approve,pending,disable',
            'trans_date'   => 'required|date',
            'userExpiry'   => 'required|date',
            'payment_data' => 'required',
            'role'         => 'required|in:admin,author,editor,contributor,user',
            'trans_system' => 'required|in:cash,bank,nagad,bkash,rocket',
            'trans_amount' => 'required',
            'status'       => 'required|in:active,inactive',
        ],
        [
            'type.required'       => 'Type Field is required',
            'type.in'             => 'Invalid Type option selected',
            'trans_date.required' => 'Transaction Date Field must not be Empty',
            'userExpiry.required' => 'User Expiry Date Field must not be Empty',
            'payment_data.required' => 'Payment data Field must not be Empty',
            'role.required'     => 'User Role Field is required',
            'role.in'           => 'Invalid User Role option selected',
            'trans_system.required' => 'Transaction Type Field is required',
            'trans_system.in'       => 'Invalid Transaction Type option selected',
            'trans_amount.required' => 'Amount data Field must not be Empty',
            'status.required'   => 'Status Field is required',
            'status.in'         => 'Invalid status option selected',
        ]);

        $messages = [
        'approve' => 'Your account is approved',
        'pending' => 'Your account is pending',
        'disable' => 'Your account is disabled',
        ];
        
        $data_type = User::findOrFail($id);
        $data_type->type         = $request->type;
        $data_type->payment_data = $request->payment_data;
        $data_type->trans_system = $request->trans_system;
        $data_type->trans_amount = $request->trans_amount;
        $data_type->trans_date   = $request->trans_date;
        $data_type->userExpiry   = $request->userExpiry;
        $data_type->role         = $request->role;
        $data_type->status       = $request->status;
        $data_type->update();  

        $message = $messages[$data_type->type] ?? 'Unknown type';
 
        return back()->with('message', "The account type has been changed . $message");         
    }

    public function editLogo($id){
        $data_logo = User::find($id);
        
        if ($data_logo !== null) {
            return view('super.operator.editLogo', compact('data_logo'));
        }else{
            return redirect('/super/operator');
        }
    }

    public function updateLogo(Request $request, $id){
       $data_logo = User::findOrFail($id);

       $request->validate([
            'new_photo' => 'required|file|max:40', 
        ]);

        if ($request->hasFile('new_photo')) {
            $img = $request -> file('new_photo');
            $unique_file_name = md5(time().rand()) . '.' . $img -> getClientOriginalExtension();

            if ($img->getSize() > 40 * 1024) {
                return back()->withErrors(['new_photo' => 'The file size should not exceed 40 KB.'])->withInput();
            }

            $img->move(public_path('admin/uploads/field/'), $unique_file_name);
            if(File::exists('public/admin/uploads/field/' .$request->old_photo)) {
                File::delete('public/admin/uploads/field/' .$request->old_photo);
              }
        }else{
            $unique_file_name = $request->old_photo;
        }

        $data_logo->logo     = $unique_file_name;
        $data_logo->update();
        
        return back()->with('message', 'Logo is Updated Successfully');
    }

    public function editInfo(string $id)
    {
        $data_info = User::find($id);
        $all_country = Country::where('status', 1)->orderBy('countryname', 'asc')->get();
        $all_division = Division::where('status', 1)->orderBy('divisionname', 'asc')->get();
        $all_district = District::where('status', 1)->orderBy('districtname', 'asc')->get();
        $all_city = City::where('status', 1)->orderBy('cityname', 'asc')->get();
        $all_upzila = Policestation::where('status', 1)->orderBy('policestationname', 'asc')->get();
        if ($data_info !== null) {
            return view('super.operator.editInfo', [
            'data_info'=>$data_info,
            'all_country'=>$all_country,
            'all_division'=>$all_division,
            'all_district'=>$all_district,
            'all_city'=>$all_city,
            'all_upzila'=>$all_upzila,
        ]);
        }else{
            return redirect('/super/operator');
        }
    }

    public function updateInfo(Request $request, string $id)
    {
        $data_info = User::findOrFail($id);
        $this->validationInfomation($request);

        $data_info->name               = $request->name;
        $data_info->dateOfBirth        = $request->dateOfBirth;
        $data_info->designation        = $request->designation;
        $data_info->gender             = $request->gender;
        $data_info->address            = $request->address;
        $data_info->policestationId    = $request->policestationId;
        $data_info->districtId         = $request->districtId;
        $data_info->divisionId         = $request->divisionId;
        $data_info->cityId             = $request->cityId;
        $data_info->countryId          = $request->countryId;
        $data_info->zipcode            = $request->zipcode;
        $data_info->update(); 
      
        return back()->with('message', 'The Office Information is Updated Successfully');
    }

    public function editEn($id)
    {
        $data_en = User::find($id);
        if ($data_en !== null) {
            return view('super.operator.editEn', compact('data_en'));
        }else{
            return redirect('/super/operator');
        }
    }

    public function updateEn(Request $request, string $id)
    {
        $data_en = User::findOrFail($id);
        $this->validationEn($request);

        $data_en->licenseExpiry      = $request->licenseExpiry;
        $data_en->description        = $request->description;
        $data_en->proprietor         = $request->proprietor;
        $data_en->proprietortitle    = $request->proprietortitle;
        $data_en->phone              = $request->phone;
        $data_en->update(); 
      
        return back()->with('message', 'The Office data in English is Updated Successfully');
    }

    public function editBn($id)
    {
        $data_bn = User::find($id);
        if ($data_bn !== null) {
            return view('super.operator.editBn', compact('data_bn'));
        }else{
            return redirect('/super/operator');
        }
    }

    public function updateBn(Request $request, string $id)
    {
        $data_bn = User::findOrFail($id);
        $this->validationBn($request);

        $data_bn->description_bn     = $request->description_bn;
        $data_bn->proprietor_bn      = $request->proprietor_bn;
        $data_bn->proprietortitle_bn = $request->proprietortitle_bn;
        $data_bn->address_bn         = $request->address_bn;
        $data_bn->telephone_bn       = $request->telephone_bn;
        $data_bn->update(); 
      
        return back()->with('message', 'The Office data in Bengali is Updated Successfully');
    }

    public function editAr($id)
    {
        $data_ar = User::find($id);
        if ($data_ar !== null) {
            return view('super.operator.editAr', compact('data_ar'));
        }else{
            return redirect('/super/operator');
        }
    }

    public function updateAr(Request $request, string $id)
    {
        $data_ar = User::findOrFail($id);
        $this->validationAr($request);

        $data_ar->description_ar     = $request->description_ar;
        $data_ar->address_ar         = $request->address_ar;
        $data_ar->proprietor_ar      = $request->proprietor_ar;
        $data_ar->proprietortitle_ar = $request->proprietortitle_ar;
        $data_ar->telephone_ar       = $request->telephone_ar;
        $data_ar->update(); 
      
        return back()->with('message', 'The Office data in Arabic is Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data_user = User::find($id);
        $data_user -> delete();

        if(File::exists('public/admin/uploads/user/' .$data_user->photo)) {
            File::delete('public/admin/uploads/user/' .$data_user->photo);
        }

        if(File::exists('public/admin/uploads/user/' .$data_user->logo)) {
            File::delete('public/admin/uploads/field/' .$data_user->logo);
        }
        UserPayment::where('userId', $id)->delete();

        return redirect() -> back() -> with('message', 'The User is deleted successfully');   
    }

    public function inactive($id)
    {
        $user_inactive = User::findOrFail($id);
        $user_inactive->status       = 'inactive';
        $user_inactive->update();              

        // return redirect('/super/operator')->with('message', 'The User is Inactive Successfully');

        return redirect() -> back() -> with('message', 'The Office is Inactived successfully');
    }
    
    public function active($id)
    {
        $user_active = User::findOrFail($id);
        $user_active->status       = 'active';
        $user_active->update(); 

        return redirect() -> back() -> with('message', 'The Office is Actived successfully');             

        // return redirect('/super/operator')->with('message', 'The User is Active Successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'name'            => 'required',
            'username'        => 'required|unique:users',
            'email'           => 'required|email|unique:users',
            'password'        => 'required|confirmed|min:4',
            'password_confirmation' => 'required_with:password|same:password|min:4',
            'designation'     => 'required|max:255',
            'phone'           => 'required|numeric',
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
            'title'           => 'required|unique:users',
            'smalltitle'      => 'required|unique:users',
            'license'         => 'required|unique:users',
            'licenseExpiry'   => 'required|date',
            'description'     => 'required',
            'proprietor'      => 'required',
            'proprietortitle' => 'required',
            'title_bn'        => 'required|unique:users',
            'license_bn'      => 'required|unique:users',
            'description_bn'  => 'required',
            'proprietor_bn'   => 'required',
            'proprietortitle_bn' => 'required',
            'title_ar'        => 'required|unique:users',
            'license_ar'      => 'required|unique:users',
            'description_ar'  => 'required',
            'proprietor_ar'   => 'required',
            'proprietortitle_ar' => 'required',
            'type'            => 'required|in:approve,pending,disable',
            'userExpiry'      => 'required|date',
            'payment_data'    => 'required',
            'status'          => 'required|in:active,inactive',
        ],
        [
            'name.required'     => "Name Field must not be empty !!",
            'username.required' => "Field must not be empty !!",
            'username.unique'   => "Username is Already Exist !!",
            'email.required'    => "Field must not be empty !!",
            'email.unique'      => "E-Mail is Already Exist !!",
            'email.email'       => "E-Mail Address is not valid !!",
            'designation.required' => "Designation Field must not be empty !!",
            'phone.required'    => "Phone Field must not be empty !!",
            'phone.numeric'     => "Phone number is not valid !!",
            'telephone_bn.required' => "Phone Number in Bengali Field must not be empty !!",
            'telephone_ar.required' => "Phone Number in Arabic Field must not be empty !!",
            'password.required' => "Password Field must not be empty !!",
            'password_confirmation.required' => "Confirm Password Field must not be empty !!",
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
            'title.required' => 'Office Name Field must not be Empty',
            'title.unique'   => 'The Office Name is already exist',
            'smalltitle.required'  => 'Office Short Name Field must not be Empty',
            'smalltitle.unique'  => 'The Office Short Name is already exist',
            'license.required'   => 'License Number Field is required',
            'license.unique'   => 'The License Number is already exist',
            'licenseExpiry.required' => 'License Expiry Date Field must not be Empty',
            'description.required'  => 'Description Field must not be Empty',
            'proprietor.required' => 'Proprietor Name Field must not be Empty',
            'proprietortitle.required' => 'Proprietor Title Field must not be Empty',
            'title_bn.required'  => 'Office Name in Bengali Field must not be Empty',
            'title_bn.unique'    => 'The Office Name in Bengali is already exist',
            'license_bn.required' => 'License Number in Bengali Field is required',
            'license_bn.unique'   => 'The License Number in Bengali is already exist',
            'description_bn.required'  => 'Description in Bengali Field must not be Empty',
            'proprietor_bn.required'  => 'Proprietor Name in Bengali Field must not be Empty',
            'proprietortitle_bn.required'  => 'Proprietor Title in Bengali Field must not be Empty',
            'title_ar.required'  => 'Office Name in Arabic Field must not be Empty',
            'title_ar.unique'    => 'The Office Name in Arabic is already exist',
            'license_ar.required' => 'License Number in Arabic Field is required',
            'license_ar.unique'   => 'The License Number in Arabic is already exist',
            'description_ar.required'  => 'Description in Arabic Field must not be Empty',
            'proprietor_ar.required'  => 'Proprietor Name in Arabic Field must not be Empty',
            'proprietortitle_ar.required'  => 'Proprietor Title in Arabic Field must not be Empty',
            'type.required'     => 'Type Field is required',
            'type.in'           => 'Invalid Type option selected',
            'userExpiry.required' => 'User Expiry Date Field must not be Empty',
            'payment_data.required' => 'Payment data Field must not be Empty',
            'status.required'   => 'Status Field is required',
            'status.in'         => 'Invalid status option selected',
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

    protected function validationInfomation($request){
        $this -> validate($request, [
            'name'            => 'required',
            'designation'     => 'required|max:255',
            'gender'          => 'required|in:1,2,3',
            'dateOfBirth'     => 'required|date',
            'address'         => 'required',
            'zipcode'         => 'required',
            'policestationId' => 'required|exists:policestations,id',
            'districtId'      => 'required|exists:districts,id',
            'divisionId'      => 'required|exists:divisions,id',
            'countryId'       => 'required|exists:countries,id',
            'cityId'          => 'required|exists:cities,id',
        ],
        [
            'name.required'     => "Name Field must not be empty !!",
            'designation.required' => "Designation Field must not be empty !!",
            'gender.required'      => 'Gender Field is required',
            'gender.in'            => 'Invalid Gender option selected',
            'dateOfBirth.required' => 'Date of Birth Field is required',
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

    protected function validationEn($request){
        $this -> validate($request, [
            'licenseExpiry'   => 'required|date',
            'description'     => 'required',
            'proprietor'      => 'required',
            'proprietortitle' => 'required',
            'phone'           => 'required|numeric',
        ],
        [
            'licenseExpiry.required' => 'License Expiry Date Field must not be Empty',
            'description.required'  => 'Description Field must not be Empty',
            'proprietor.required' => 'Proprietor Name Field must not be Empty',
            'proprietortitle.required' => 'Proprietor Title Field must not be Empty',
            'phone.required'    => "Phone Field must not be empty !!",
            'phone.numeric'     => "Phone number is not valid !!",
        ]);
    }

    protected function validationBn($request){
        $this -> validate($request, [
            'telephone_bn'    => 'required',
            'address_bn'      => 'required',
            'description_bn'  => 'required',
            'proprietor_bn'   => 'required',
            'proprietortitle_bn' => 'required',
        ],
        [
            'telephone_bn.required' => "Phone Number in Bengali Field must not be empty !!",
            'address_bn.required'  => 'Office Address in Bengali Field must not be Empty',
            'description_bn.required'  => 'Description in Bengali Field must not be Empty',
            'proprietor_bn.required'  => 'Proprietor Name in Bengali Field must not be Empty',
            'proprietortitle_bn.required'  => 'Proprietor Title in Bengali Field must not be Empty',
        ]);
    }

    protected function validationAr($request){
        $this -> validate($request, [
            'telephone_ar'    => 'required',
            'address_ar'      => 'required',
            'description_ar'  => 'required',
            'proprietor_ar'   => 'required',
            'proprietortitle_ar' => 'required',
        ],
        [
            'telephone_ar.required' => "Phone Number in Arabic Field must not be empty !!",
            'address_ar.required'  => 'Office Address in Arabic Field must not be Empty',
            'description_ar.required'  => 'Description in Arabic Field must not be Empty',
            'proprietor_ar.required'  => 'Proprietor Name in Arabic Field must not be Empty',
            'proprietortitle_ar.required'  => 'Proprietor Title in Arabic Field must not be Empty',
        ]);
    }

    protected function getDetails($id){
        $data_details = DB::table('users')
            ->leftJoin('countries', 'users.countryId', '=', 'countries.id')
            ->where('users.id', $id)
            ->leftJoin('divisions', 'users.divisionId', '=', 'divisions.id')
            ->leftJoin('districts', 'users.districtId', '=', 'districts.id')
            ->leftJoin('policestations', 'users.policestationId', '=', 'policestations.id')
            ->leftJoin('cities', 'users.cityId', '=', 'cities.id')
            ->select('users.*', 'countries.countryname', 'countries.nationality', 'countries.currency', 'countries.phone_code', 'divisions.divisionname', 'districts.districtname', 'policestations.policestationname', 'cities.cityname')
            ->get();
        return $data_details;
    }
}