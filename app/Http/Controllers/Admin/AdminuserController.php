<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Super;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Auth\LoginRequest;
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

class AdminuserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $id = Auth::user()->id;
        $user_info = User::find($id);
        $all_country = Country::where('status', 1)->orderBy('countryname', 'asc')->get();
        $all_division = Division::where('status', 1)->orderBy('divisionname', 'asc')->get();
        $all_district = District::where('status', 1)->orderBy('districtname', 'asc')->get();
        $all_city = City::where('status', 1)->orderBy('cityname', 'asc')->get();
        $all_upzila = Policestation::where('status', 1)->orderBy('policestationname', 'asc')->get();

        if (Auth::check() && (Auth::user()->title === NULL || Auth::user()->license === NULL || Auth::user()->title_bn === NULL || Auth::user()->license_bn === NULL || Auth::user()->title_ar === NULL || Auth::user()->license_ar === NULL)) {
            return view('admin.users.create', [
            'user_info'=>$user_info,
            'all_country'=>$all_country,
            'all_division'=>$all_division,
            'all_district'=>$all_district,
            'all_city'=>$all_city,
            'all_upzila'=>$all_upzila,
        ]);
        }else{
            return redirect('/profile');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $user_info = User::find($id);

        $this->validation($request);

        $user_info->title              = $request->title;
        $user_info->smalltitle         = $request->smalltitle;
        $user_info->license            = $request->license;
        $user_info->licenseExpiry      = $request->licenseExpiry;
        $user_info->description        = $request->description;
        $user_info->proprietor         = $request->proprietor;
        $user_info->proprietortitle    = $request->proprietortitle;
        $user_info->address            = $request->address;
        $user_info->title_bn           = $request->title_bn;
        $user_info->license_bn         = $request->license_bn;
        $user_info->description_bn     = $request->description_bn;
        $user_info->proprietor_bn      = $request->proprietor_bn;
        $user_info->proprietortitle_bn = $request->proprietortitle_bn;
        $user_info->address_bn         = $request->address_bn;
        $user_info->telephone_bn       = $request->telephone_bn;
        $user_info->title_ar           = $request->title_ar;
        $user_info->license_ar         = $request->license_ar;
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
        $user_info->gender             = $request->gender;
        $user_info->type               = 'pending';
        $user_info->role               = 'user';
        $user_info->status             = 'active';
        $user_info->update();             

        return back()->with('message', 'The Company Information is added Successfully');
    }

    public function editTitle()
    {
        $id = Auth::user()->id;
        $office_name = User::find($id);
        if (Auth::user()->role == 'admin') {
            return view('admin.users.editTitle', compact('office_name'));
        }else{
            return redirect('/profile');
        }
    }

    public function updateTitle(Request $request)
    {
        $id = Auth::user()->id;
        $this -> validate($request, [
            'title'          => 'required|unique:users',
        ],
        [
            'title.required' => 'Office Name Field must not be Empty',
            'title.unique'   => 'The Office Name is already exist',
        ]);
        
        $office_name = User::findOrFail($id);
        $office_name->title    = $request->title;
        $office_name->type     = 'pending';
        $office_name->role     = 'user';
        $office_name->update();              

        return back()->with('message', 'The Office Name is Updated Successfully');
    }

    public function editShortTitle()
    {
        $id = Auth::user()->id;
        $office_smallname = User::find($id);
        if (Auth::user()->role == 'admin') {
            return view('admin.users.editShortTitle', compact('office_smallname'));
        }else{
            return redirect('/profile');
        }
    }

    public function updateShortTitle(Request $request)
    {
        $id = Auth::user()->id;
        $this -> validate($request, [
            'smalltitle'          => 'required|unique:users',
        ],
        [
            'smalltitle.required' => 'Office Short Name Field must not be Empty',
            'smalltitle.unique'  => 'The Office Short Name is already exist',
        ]);
        
        $office_smallname = User::findOrFail($id);
        $office_smallname->smalltitle  = $request->smalltitle;
        $office_smallname->type        = 'pending';
        $office_smallname->role        = 'user';
        $office_smallname->update();              

        return back()->with('message', 'The Office Short Name is Updated Successfully');
    }

    public function editLicense()
    {
        $id = Auth::user()->id;
        $office_license = User::find($id);
        if (Auth::user()->role == 'admin') {
            return view('admin.users.editLicense', compact('office_license'));
        }else{
            return redirect('/profile');
        }
    }

    public function updateLicense(Request $request)
    {
        $id = Auth::user()->id;
        $this -> validate($request, [
            'license'          => 'required|unique:users',
        ],
        [
            'license.required' => 'License Number Field is required',
            'license.unique'   => 'The License Number is already exist',
        ]);
        
        $office_license = User::findOrFail($id);
        $office_license->license    = $request->license;
        $office_license->type       = 'pending';
        $office_license->role       = 'user';
        $office_license->update();              

        return back()->with('message', 'The License Number is Updated Successfully');
    }

    public function editTitlebn()
    {
        $id = Auth::user()->id;
        $office_namebn = User::find($id);
        if (Auth::user()->role == 'admin') {
            return view('admin.users.editTitlebn', compact('office_namebn'));
        }else{
            return redirect('/profile');
        }
    }

    public function updateTitlebn(Request $request)
    {
        $id = Auth::user()->id;
        $this -> validate($request, [
            'title_bn'          => 'required|unique:users',
        ],
        [
            'title_bn.required' => 'Office Name in Bengali Field must not be Empty',
            'title_bn.unique'   => 'The Office Name in Bengali is already exist',
        ]);
        
        $office_namebn = User::findOrFail($id);
        $office_namebn->title_bn   = $request->title_bn;
        $office_namebn->type       = 'pending';
        $office_namebn->role       = 'user';
        $office_namebn->update();              

        return back()->with('message', 'The Office Name in Bengali is Updated Successfully');
    }

    public function editLicensebn()
    {
        $id = Auth::user()->id;
        $office_licensebn = User::find($id);
        if (Auth::user()->role == 'admin') {
            return view('admin.users.editLicensebn', compact('office_licensebn'));
        }else{
            return redirect('/profile');
        }
    }

    public function updateLicensebn(Request $request)
    {
        $id = Auth::user()->id;
        $this -> validate($request, [
            'license_bn'          => 'required|unique:users',
        ],
        [
            'license_bn.required' => 'License Number in Bengali Field is required',
            'license_bn.unique'   => 'The License Number in Bengali is already exist',
        ]);
        
        $office_licensebn = User::findOrFail($id);
        $office_licensebn->license_bn    = $request->license_bn;
        $office_licensebn->type          = 'pending';
        $office_licensebn->role          = 'user';
        $office_licensebn->update();              

        return back()->with('message', 'The License Number in Bengali is Updated Successfully');
    }

    public function editTitlear()
    {
        $id = Auth::user()->id;
        $office_namear = User::find($id);
        if (Auth::user()->role == 'admin') {
            return view('admin.users.editTitlear', compact('office_namear'));
        }else{
            return redirect('/profile');
        }
    }

    public function updateTitlear(Request $request)
    {
        $id = Auth::user()->id;
        $this -> validate($request, [
            'title_ar'          => 'required|unique:users',
        ],
        [
            'title_ar.required' => 'Office Name in Arabic Field must not be Empty',
            'title_ar.unique'   => 'The Office Name in Arabic is already exist',
        ]);
        
        $office_namear = User::findOrFail($id);
        $office_namear->title_ar    = $request->title_ar;
        $office_namear->type        = 'pending';
        $office_namear->role        = 'user';
        $office_namear->update();              

        return back()->with('message', 'The Office Name in Arabic is Updated Successfully');
    }

    public function editLicensear()
    {
        $id = Auth::user()->id;
        $office_licensear = User::find($id);
        if (Auth::user()->role == 'admin') {
            return view('admin.users.editLicensear', compact('office_licensear'));
        }else{
            return redirect('/profile');
        }
    }

    public function updateLicensear(Request $request)
    {
        $id = Auth::user()->id;
        $this -> validate($request, [
            'license_ar'          => 'required|unique:users',
        ],
        [
            'license_ar.required' => 'License Number in Arabic Field is required',
            'license_ar.unique'   => 'The License Number in Arabic is already exist',
        ]);
        
        $office_licensear = User::findOrFail($id);
        $office_licensear->license_ar    = $request->license_ar;
        $office_licensear->type          = 'pending';
        $office_licensear->role          = 'user';
        $office_licensear->update();              

        return back()->with('message', 'The License Number in Arabic is Updated Successfully');
    }

    public function editLogo(){
        $id = Auth::user()->id;
        $data_logo = User::find($id);
        
        if ($data_logo !== null) {
            return view('admin.users.editLogo', compact('data_logo'));
        }else{
            return redirect('/profile');
        }
    }

    public function updateLogo(Request $request){
        $id = Auth::user()->id;
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

    public function extension()
    {
        $id = Auth::user()->id;
        $data_type = User::find($id);
        $expiryDate = strtotime($data_type->userExpiry);
        $currentDate = strtotime(date('Y-m-d'));
        $threeDaysBefore = strtotime('5 days', $currentDate);
        if ($expiryDate <= $threeDaysBefore || $data_type->type == 'pending' || $data_type->type == 'disable') {
            return view('admin.users.extension', compact('data_type'));
        }else{
            return redirect('/profile');
        }
    }

    public function updateExtension(Request $request)
    {
        $id = Auth::user()->id;
        $currentDate = date('Y-m-d');
        
        $this -> validate($request, [
            'userExpiry'   => 'required|date',
            'payment_data' => 'required',
            'trans_system' => 'required|in:cash,bank,nagad,bkash,rocket',
            'trans_amount' => 'required',
        ],
        [
            'userExpiry.required' => 'User Expiry Date Field must not be Empty',
            'payment_data.required' => 'Payment data Field must not be Empty',
            'trans_system.required' => 'Transaction Type Field is required',
            'trans_system.in'       => 'Invalid Transaction Type option selected',
            'trans_amount.required' => 'Amount data Field must not be Empty',
        ]);

        $messages = [
        'approve' => 'Your account is approved',
        'pending' => 'Your account is pending',
        'disable' => 'Your account is disabled',
        ];
        
        $data_type = User::findOrFail($id);
        $data_type->type         = 'pending';
        $data_type->payment_data = $request->payment_data;
        $data_type->trans_date   = $currentDate;
        $data_type->userExpiry   = $request->userExpiry;
        $data_type->trans_system = $request->trans_system;
        $data_type->trans_amount = $request->trans_amount;
        $data_type->update();  

        $message = $messages[$data_type->type] ?? 'Unknown type';
 
        return back()->with('message', "The account type has been changed . $message");         
    }

    protected function validation($request){
        $this -> validate($request, [
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
        ],
        [
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
        ]);
    }

    protected function getUserDetails($id){
        $data_details = DB::table('users')
            ->leftJoin('customers', 'users.id', '=', 'customers.userId')
            ->where('users.id', $id)
            ->leftJoin('delegates', 'customers.agentId', '=', 'delegates.id')
            ->leftJoin('visatrades', 'customers.tradeId', '=', 'visatrades.id')
            ->select('users.*', 'customers.customersl', 'customers.bookRef', 'customers.cusFname', 'customers.cusLname', 'customers.gender', 'customers.value', 'customers.status', 'customers.passportNo', 'customers.medical', 'customers.received', 'delegates.agentsl', 'delegates.agentname', 'customers.passportNo', 'visatrades.visatrade_name')
            ->get();
        return $data_details;
    }
}