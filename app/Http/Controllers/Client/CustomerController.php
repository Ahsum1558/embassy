<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\CustomerDocoment;
use App\Models\CustomerEmbassy;
use App\Models\CustomerPassport;
use App\Models\CustomerRate;
use App\Models\CustomerVisa;
use App\Models\CustomerManpower;
use App\Models\Delegate;
use App\Models\Visatrade;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Country;
use App\Models\Division;
use App\Models\District;
use App\Models\Policestation;
use App\Models\Issue;
use App\Models\City;
use App\Models\User;
use App\Models\Field;
use App\Models\Visa;
use App\Models\Visatype;
use App\Models\SubmissionCustomer;
use Milon\Barcode\DNS1D;
use Illuminate\Support\Facades\File;
use Picqer\Barcode\BarcodeGeneratorPNG;
use DateTime;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Carbon;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $all_customer = $this->getInfo()->where('userId', $userId);
        return view('admin.client.customer.index', compact('all_customer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $customer_data = Customer::latest()->where('userId','=',$userId) -> get();
        $all_visa_trade = Visatrade::where('status', 1)->orderBy('visatrade_name', 'asc')->get();
        $all_delegate = Delegate::where('userId', $userId)->orderBy('agentname', 'asc')->get();
        $all_country = Country::where('status', 1)->orderBy('countryname', 'asc')->get();
        $all_district = District::where('status', 1)->orderBy('districtname', 'asc')->get();
        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            return view('admin.client.customer.primary.create', [
                'customer_data'=>$customer_data,
                'all_visa_trade'=>$all_visa_trade,
                'all_delegate'=>$all_delegate,
                'all_country'=>$all_country,
                'all_district'=>$all_district,
            ]);
        }else{
            return redirect('/customer');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $this->validation($request);
        $customer_data = Customer::latest()->where('userId','=',$userId) -> get();
        $existingPassportNo = Customer::where([
            'passportNo'=>$request->passportNo,
            'userId'=>$userId,
        ])->first();

        $existingBook = Customer::where([
            'bookRef'=>$request->bookRef,
            'userId'=>$userId,
        ])->first();

        if ($existingBook || $existingPassportNo) {
            return redirect()->back()->with('error_message', 'Passport Number or Book Reference Number already exists in the table!');
        }

        $barcodeData = $request->passportNo;
        $color = [0, 0, 0];
        $generator = new BarcodeGeneratorPNG();
        $barcodeImage = $generator->getBarcode($barcodeData, $generator::TYPE_CODE_128, 3, 50, $color);

        $file_ext = strtolower($request->passportNo);

        $barcodeFilename = substr(md5(time() . rand()), 0, 10) .'.'.$file_ext. '.png';
        $barcodePath = public_path('admin/uploads/passcode/') . $barcodeFilename;
        file_put_contents($barcodePath, $barcodeImage);

        if (count($customer_data) > 0) {
            Customer::create([
            'customersl'    => $request->customersl,
            'bookRef'       => $request->bookRef,
            'cusFname'      => $request->cusFname,
            'cusLname'      => $request->cusLname,
            'gender'        => $request->gender,
            'passportNo'    => $request->passportNo,
            'passport_img'  => $barcodeFilename,
            'phone'         => $request->phone,
            'agentId'       => $request->agentId,
            'birthPlace'    => $request->birthPlace,
            'medical'       => $request->medical,
            'received'      => $request->received,
            'tradeId'       => $request->tradeId,
            'countryFor'    => $request->countryFor,
            'status'        => $request->status,
            'value'         => 0,
            'userId'        => Auth::user()->id,
            
        ]);
        return redirect() -> back() -> with('message', 'Customer is added successfully');
        }else{
            $date = new DateTime();
            $currentYear = $date->format('Y');
            $customerSerial = "RLCUS" . $currentYear . "00001";
            Customer::create([
            'customersl'    => $customerSerial,
            'bookRef'       => $request->bookRef,
            'cusFname'      => $request->cusFname,
            'cusLname'      => $request->cusLname,
            'gender'        => $request->gender,
            'passportNo'    => $request->passportNo,
            'passport_img'  => $barcodeFilename,
            'phone'         => $request->phone,
            'agentId'       => $request->agentId,
            'birthPlace'    => $request->birthPlace,
            'medical'       => $request->medical,
            'received'      => $request->received,
            'tradeId'       => $request->tradeId,
            'countryFor'    => $request->countryFor,
            'status'        => $request->status,
            'value'         => 0,
            'userId'        => Auth::user()->id,
        ]);

        return redirect() -> back() -> with('message', 'Customer is added successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $customer_single_data = $this->getDetails($id)->where('userId', $userId);
        $customer_single_docs = CustomerDocoment::where('customerId', $id)->where('userId', $userId)->get();
        $passport_single_data = $this->getPassportDetails($id)->where('userId', $userId);
        $embassy_single_data = $this->getEmbassyDetails($id)->where('userId', $userId);
        $stamping_single_docs = $this->getStampingDetails($id)->where('userId', $userId);
        $rate_single_docs = CustomerRate::where('customerId', $id)->where('userId', $userId)->get();

        if($customer_single_data->count() > 0){
            return view('admin.client.customer.primary.show', [
            'customer_single_data'=>$customer_single_data,
            'customer_single_docs'=>$customer_single_docs,
            'passport_single_data'=>$passport_single_data,
            'embassy_single_data'=>$embassy_single_data,
            'stamping_single_docs'=>$stamping_single_docs,
            'rate_single_docs'=>$rate_single_docs,
        ]);

        }else{
            return redirect('/customer');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $customer_data_info = Customer::where('userId', $userId)->find($id);

        $all_visa_trade = Visatrade::where('status', 1)->orderBy('visatrade_name', 'asc')->get();
        $all_delegate = Delegate::where('userId', $userId)->orderBy('agentname', 'asc')->get();
        $all_country = Country::where('status', 1)->orderBy('countryname', 'asc')->get();
        $all_district = District::where('status', 1)->orderBy('districtname', 'asc')->get();

        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            if ($customer_data_info !== null) {
                return view('admin.client.customer.primary.edit', [
                'customer_data_info'=>$customer_data_info,
                'all_visa_trade'=>$all_visa_trade,
                'all_delegate'=>$all_delegate,
                'all_country'=>$all_country,
                'all_district'=>$all_district,
            ]);
            }else{
                return redirect('/customer');
            }
        }else{
            return redirect('/customer');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userId = Auth::user()->id;
        $customer_data_info = Customer::where('userId', $userId)->find($id);
        $this->validationInfo($request);

        $customer_data_info->cusFname    = $request->cusFname;
        $customer_data_info->cusLname    = $request->cusLname;
        $customer_data_info->gender      = $request->gender;
        $customer_data_info->phone       = $request->phone;
        $customer_data_info->agentId     = $request->agentId;
        $customer_data_info->birthPlace  = $request->birthPlace;
        $customer_data_info->medical     = $request->medical;
        $customer_data_info->medical_update = $request->medical_update;
        $customer_data_info->tradeId     = $request->tradeId;
        $customer_data_info->countryFor  = $request->countryFor;
        $customer_data_info->status      = $request->status;
        $customer_data_info->update();

        return redirect() -> back() -> with('message', 'Customer Info is Updated successfully');
    }

    public function editBook($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $customer_book_ref = Customer::where('userId', $userId)->find($id);

        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){        
            if ($customer_book_ref !== null) {
                return view('admin.client.customer.primary.editBook', compact('customer_book_ref'));
            }else{
                return redirect('/customer');
            }
        }else{
            return redirect('/customer');
        }
    }

    public function updateBook(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $customer_book_ref = Customer::where('userId', $userId)->find($id);
        $existingRecord = Customer::where([
            'bookRef'=>$request->bookRef,
            'userId'=>$userId,
        ])->first();
        if (!$existingRecord){
        $this -> validate($request, [
            'bookRef'       => 'required',
        ],
        [
            'bookRef.required'          => 'Book Ref No. Field must not be Empty',
        ]);

        $customer_book_ref->bookRef    = $request->bookRef;
        $customer_book_ref->update();

        return redirect() -> back() -> with('message', 'Customer Book Reference Number is Updated successfully');
        }else{
            return redirect() -> back() -> with('error_message', 'Book Reference Number is already exist in the table !');
        }
    }

    public function editPassportNo($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $customer_passport_no = Customer::where('userId', $userId)->find($id);

        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){        
            if ($customer_passport_no !== null) {
                return view('admin.client.customer.primary.editPassportNo', compact('customer_passport_no'));
            }else{
                return redirect('/customer');
            }
        }else{
            return redirect('/customer');
        }
    }

    public function updatePassportNo(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $customer_passport_no = Customer::where('userId', $userId)->find($id);
        $existingRecord = Customer::where([
            'passportNo'=>$request->passportNo,
            'userId'=>$userId,
        ])->first();
        if (!$existingRecord){
        $this -> validate($request, [
            'passportNo'    => 'required',
        ],
        [
            'passportNo.required'       => "Passport Number Field must not be empty !!",
        ]);

        $customer_passport_no = Customer::findOrFail($id);

        if (File::exists(public_path('admin/uploads/passcode/' . $customer_passport_no->passport_img))) {
            File::delete(public_path('admin/uploads/passcode/' . $customer_passport_no->passport_img));
        }

        $barcodeData = $request->passportNo;
        $color = [0, 0, 0];
        $generator = new BarcodeGeneratorPNG();
        $barcodeImage = $generator->getBarcode($barcodeData, $generator::TYPE_CODE_128, 3, 50, $color);

        $file_ext = strtolower($request->passportNo);

        $barcodeFilename = substr(md5(time() . rand()), 0, 10) .'.'.$file_ext. '.png';
        $barcodePath = public_path('admin/uploads/passcode/') . $barcodeFilename;
        file_put_contents($barcodePath, $barcodeImage);

        $customer_passport_no->passport_img  = $barcodeFilename;
        $customer_passport_no->passportNo    = $request->passportNo;
        $customer_passport_no->update();

        return redirect() -> back() -> with('message', 'Customer Passport Number is Updated successfully');
        }else{
            return redirect() -> back() -> with('error_message', 'Passport Number is already exist in the table !');
        }
    }

    public function editImage($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $customer_image_data = Customer::where('userId', $userId)->find($id);

        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){        
            if ($customer_image_data !== null) {
                return view('admin.client.customer.primary.editImage', compact('customer_image_data'));
            }else{
                return redirect('/customer');
            }
        }else{
            return redirect('/customer');
        }
    }

    public function updateImage(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $customer_image_data = Customer::where('userId', $userId)->find($id);
        $request->validate([
            'new_photo' => 'required|file|max:40', 
        ]);

        if ($request->hasFile('new_photo')) {
            $img = $request -> file('new_photo');
            $unique_file_name = md5(time().rand()) . '.' . $img -> getClientOriginalExtension();

            if ($img->getSize() > 40 * 1024) {
                return back()->withErrors(['new_photo' => 'The file size should not exceed 40 KB.'])->withInput();
            }

            $img->move(public_path('admin/uploads/customer/'), $unique_file_name);
            
            if(File::exists('public/admin/uploads/customer/' .$request->old_photo)) {
                File::delete('public/admin/uploads/customer/' .$request->old_photo);
              }
        }else{
            $unique_file_name = $request->old_photo;
        }

        $customer_image_data->photo     = $unique_file_name;
        $customer_image_data->update();
        
        return back()->with('message', 'Customer Image is Updated Successfully');
    }

    public function editPassportCopy($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $passport_copy_data = Customer::where('userId', $userId)->find($id);

        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            if ($passport_copy_data !== null) {
                return view('admin.client.customer.primary.editPassportCopy', compact('passport_copy_data'));
            }else{
                return redirect('/customer');
            }
        }else{
            return redirect('/customer');
        }
    }

    public function updatePassportCopy(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $passport_copy_data = Customer::where('userId', $userId)->find($id);
        $request->validate([
            'new_passport_copy' => 'required|file|max:60', 
        ]);

        if ($request->hasFile('new_passport_copy')) {
            $img = $request -> file('new_passport_copy');
            $unique_file_name = md5(time().rand()) . '.' . $img -> getClientOriginalExtension();

            if ($img->getSize() > 60 * 1024) {
                return back()->withErrors(['new_photo' => 'The file size should not exceed 60 KB.'])->withInput();
            }

            $img->move(public_path('admin/uploads/customer/'), $unique_file_name);
            
            if(File::exists('public/admin/uploads/customer/' .$request->old_passport_copy)) {
                File::delete('public/admin/uploads/customer/' .$request->old_passport_copy);
              }
        }else{
            $unique_file_name = $request->old_passport_copy;
        }

        $passport_copy_data->passportCopy     = $unique_file_name;
        $passport_copy_data->update();
        
        return back()->with('message', 'Customer Passport Copy is Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
            return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        // Begin a database transaction
        DB::beginTransaction();
        try {
            // Delete customer from the "customers" table
            $data_customer = Customer::where('userId', $userId)->find($id);
            $data_customer->delete();
            // Customer::where('id', $id)->delete();
            CustomerDocoment::where('customerId', $id)->where('userId', $userId)->delete();
            CustomerPassport::where('customerId', $id)->where('userId', $userId)->delete();
            CustomerEmbassy::where('customerId', $id)->where('userId', $userId)->delete();
            CustomerVisa::where('customerId', $id)->where('userId', $userId)->delete();
            CustomerRate::where('customerId', $id)->where('userId', $userId)->delete();
            SubmissionCustomer::where('customerId', $id)->where('userId', $userId)->delete();
            CustomerManpower::where('customerId', $id)->where('userId', $userId)->delete();

            // Commit the transaction if all queries succeeded
            DB::commit();

            if(File::exists('public/admin/uploads/customer/' .$data_customer->photo)) {
            File::delete('public/admin/uploads/customer/' .$data_customer->photo);
            }
            if(File::exists('public/admin/uploads/customer/' .$data_customer->passportCopy)) {
            File::delete('public/admin/uploads/customer/' .$data_customer->passportCopy);
            }
            if (File::exists(public_path('admin/uploads/passcode/' . $data_customer->passport_img))) {
            File::delete(public_path('admin/uploads/passcode/' . $data_customer->passport_img));
            }
            return redirect() -> back() -> with('message', 'The Customer is deleted successfully');
        } catch (\Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollback();
            return "Error deleting customer: " . $e->getMessage();
        }
    }

    public function inactive($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $customer_inactive = Customer::where('userId', $userId)->find($id);

        $customer_inactive->status   = 0;
        $customer_inactive->update();              

        return redirect('/customer')->with('message', 'The Customer is Inactive Successfully');
    }
    
    public function active($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $customer_active = Customer::where('userId', $userId)->find($id);

        $customer_active->status   = 1;
        $customer_active->update();              

        return redirect('/customer')->with('message', 'The Customer is Active Successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'bookRef'       => 'required',
            'cusFname'      => 'required',
            'phone'         => 'required|numeric',
            'passportNo'    => 'required',
            'birthPlace'    => 'required|exists:districts,id',
            'agentId'       => 'required|exists:delegates,id',
            'tradeId'       => 'required|exists:visatrades,id',
            'countryFor'    => 'required|exists:countries,id',
            'received'      => 'required|date',
            'status'        => 'required|in:1,0',
            'gender'        => 'required|in:1,2,3',
            'medical'       => 'required|in:1,2,3,4,5',
        ],
        [
            'bookRef.required'    => 'Book Ref No. Field must not be Empty',
            'cusFname.required'   => 'Customer First Name Field is required',
            'phone.required'      => 'Phone Number Field must not be Empty',
            'phone.numeric'       => "Phone number is not valid !!",
            'passportNo.required' => "Passport Number Field must not be empty !!",
            'birthPlace.required' => "Place of Birth Field must not be empty !!",
            'birthPlace.exists'   => "Invalid Place of Birth Field !!",
            'agentId.required'    => "Delegate Field must not be empty !!",
            'agentId.exists'      => "Invalid Delegate Field !!",
            'tradeId.required'    => "Visa Trade Field must not be empty !!",
            'tradeId.exists'      => "Invalid Visa Trade Field !!",
            'countryFor.required' => "Country Field is required !!",
            'countryFor.exists'   => "Invalid Country Field !!",
            'received.required'   => "Passport Receive Date Field must not be empty !!",
            'status.required'     => 'Status Field is required',
            'status.in'           => 'Invalid status option selected',
            'gender.required'     => 'Gender Field is required',
            'gender.in'           => 'Invalid Gender option selected',
            'medical.required'    => 'Medical Field is required',
            'medical.in'          => 'Invalid Medical option selected',

        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'cusFname'      => 'required',
            'phone'         => 'required|numeric',
            'birthPlace'    => 'required|exists:districts,id',
            'agentId'       => 'required|exists:delegates,id',
            'status'        => 'required|in:1,0',
            'gender'        => 'required|in:1,2,3',
            'medical'       => 'required|in:1,2,3,4,5',
            'medical_update' => 'required|in:0,1',
            'tradeId'       => 'required|exists:visatrades,id',
            'countryFor'    => 'required|exists:countries,id',
        ],
        [
            'cusFname.required'   => 'Customer First Name Field is required',
            'phone.required'      => 'Phone Number Field must not be Empty',
            'phone.numeric'        => "Phone number is not valid !!",
            'birthPlace.required' => "Place of Birth Field must not be empty !!",
            'birthPlace.exists'   => "Invalid Place of Birth Field !!",
            'agentId.required' => "Delegate Field must not be empty !!",
            'agentId.exists'   => "Invalid Delegate Field !!",
            'status.required'     => 'Status Field is required',
            'status.in'           => 'Invalid status option selected',
            'gender.required'     => 'Gender Field is required',
            'gender.in'           => 'Invalid Gender option selected',
            'medical.required'    => 'Medical Field is required',
            'medical.in'          => 'Invalid Medical option selected',
            'medical_update.required' => 'Medical Update Field is required',
            'medical_update.in'       => 'Invalid Medical Update option selected',
            'tradeId.required'    => "Visa Trade Field must not be empty !!",
            'tradeId.exists'      => "Invalid Visa Trade Field !!",
            'countryFor.required' => "Country Field is required !!",
            'countryFor.exists'   => "Invalid Country Field !!",

        ]);
    }

    protected function getInfo(){
        $data_info = DB::table('customers')
            ->leftJoin('delegates', 'customers.agentId', '=', 'delegates.id')
            ->leftJoin('countries', 'customers.countryFor', '=', 'countries.id')
            ->leftJoin('districts', 'customers.birthPlace', '=', 'districts.id')
            ->leftJoin('visatrades', 'customers.tradeId', '=', 'visatrades.id')
            ->leftJoin('users', 'customers.userId', '=', 'users.id')
            ->select('customers.*', 'delegates.agentname', 'delegates.agentsl', 'delegates.agentbook', 'districts.districtname', 'visatrades.visatrade_name', 'users.name as receiver', 'countries.countryname as destination_country')
            ->orderBy('customers.customersl', 'desc')
            ->get();
        return $data_info;
    }

    protected function getDetails($id){
        $data_details = DB::table('customers')
            ->leftJoin('delegates', 'customers.agentId', '=', 'delegates.id')
            ->where('customers.id', $id)
            ->leftJoin('districts', 'customers.birthPlace', '=', 'districts.id')
            ->leftJoin('countries', 'customers.countryFor', '=', 'countries.id')
            ->leftJoin('visatrades', 'customers.tradeId', '=', 'visatrades.id')
            ->leftJoin('users', 'customers.userId', '=', 'users.id')
            ->select('customers.*', 'delegates.agentname', 'delegates.agentsl', 'delegates.agentbook', 'districts.districtname', 'visatrades.visatrade_name', 'users.name as receiver', 'countries.countryname as destination_country')
            ->get();
        return $data_details;
    }

    protected function getPassportDetails($id){
        $data_passport = DB::table('customer_passports')
            ->leftJoin('countries', 'customer_passports.countryId', '=', 'countries.id')
            ->where('customer_passports.customerId', $id)
            ->leftJoin('divisions', 'customer_passports.divisionId', '=', 'divisions.id')
            ->leftJoin('districts', 'customer_passports.districtId', '=', 'districts.id')
            ->leftJoin('policestations', 'customer_passports.policestationId', '=', 'policestations.id')
            ->leftJoin('issues', 'customer_passports.issuePlaceId', '=', 'issues.id')
            ->select('customer_passports.*', 'countries.countryname', 'countries.nationality', 'divisions.divisionname', 'districts.districtname', 'policestations.policestationname', 'issues.issuePlace')
            ->get();
        return $data_passport;
    }

    protected function getEmbassyDetails($id){
        $data_embassy = DB::table('customer_embassies')
            ->leftJoin('visatypes', 'customer_embassies.visaTypeId', '=', 'visatypes.id')
            ->where('customer_embassies.customerId', $id)
            ->leftJoin('visas', 'customer_embassies.visaId', '=', 'visas.id')
            ->select('customer_embassies.*', 'visatypes.visatype_name', 'visas.visano_en', 'visas.visano_ar', 'visas.sponsorid_en', 'visas.sponsorid_ar', 'visas.sponsorname_en', 'visas.sponsorname_ar', 'visas.visa_date', 'visas.visa_address', 'visas.occupation_en', 'visas.occupation_ar', 'visas.delegation_no', 'visas.delegation_date', 'visas.delegated_visa', 'visas.visa_duration')
            ->get();
        return $data_embassy;
    }

    protected function getStampingDetails($id){
        $data_stamping = DB::table('customer_visas')
            ->leftJoin('countries', 'customer_visas.countryId', '=', 'countries.id')
            ->where('customer_visas.customerId', $id)
            ->select('customer_visas.*', 'countries.countryname as foreign_country', 'countries.nationality as foreign_national')
            ->get();
        return $data_stamping;
    }
}