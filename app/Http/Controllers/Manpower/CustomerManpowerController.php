<?php

namespace App\Http\Controllers\Manpower;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerEmbassy;
use App\Models\CustomerVisa;
use App\Models\Country;
use App\Models\CustomerPassport;
use App\Models\CustomerRate;
use App\Models\Delegate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Field;
use App\Models\Visa;
use App\Models\Submission;
use App\Models\SubmissionCustomer;
use App\Models\ManpowerSubmission;
use App\Models\CustomerManpower;
use App\Models\BmetPayment;
use App\Models\CustomerDocoment;
use App\Models\Visatrade;
use App\Models\Division;
use App\Models\District;
use App\Models\Policestation;
use App\Models\Issue;
use App\Models\City;
use App\Models\Visatype;
use Milon\Barcode\DNS1D;
use Illuminate\Support\Facades\File;
use Picqer\Barcode\BarcodeGeneratorPNG;
use DateTime;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Carbon;
use App\Enums\GenderEnum;

class CustomerManpowerController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function statement($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;

        $customer_manpower = Customer::where('userId', $userId)->find($id);
        $customer_sub = CustomerManpower::latest()->where('userId','=',$userId) -> get();
        $all_manpower = ManpowerSubmission::where('status', 1)->where('userId','=',$userId)->orderBy('manpowerDate', 'desc')->limit(1)->get();
        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){        
            if($customer_manpower !== null && $customer_manpower->value == 4 && $customer_manpower->manpowerlist == 0){
                return view('admin.client.manpower.statement', [
                'customer_manpower'=>$customer_manpower,
                'customer_sub'=>$customer_sub,
                'all_manpower'=>$all_manpower,
            ]);
            }else{
                return redirect('/manpower');
            }
        }else{
            return redirect('/manpower');
        }
    }

    public function storeStatement(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $customer_manpower = Customer::where('userId', $userId)->find($id);
        $existingRecord = CustomerManpower::where([
            'finger_regno'=>$request->finger_regno,
            'userId'=>$userId,
        ])->first();
        if (!$existingRecord){
            $this->validation($request);
            $customer_id = $customer_manpower->id;

            $customer_sub = new CustomerManpower();
            $customer_sub->customerId       = $customer_id;
            $customer_sub->manpowerSubId    = $request->manpowerSubId;
            $customer_sub->customerPhone    = $request->customerPhone;
            $customer_sub->fatherPhone      = $request->fatherPhone;
            $customer_sub->motherPhone      = $request->motherPhone;
            $customer_sub->certificateNo    = $request->certificateNo;
            $customer_sub->batchNo          = $request->batchNo;
            $customer_sub->rollNo           = $request->rollNo;
            $customer_sub->ttcname          = $request->ttcname;
            $customer_sub->accountNo        = $request->accountNo;
            $customer_sub->bankname         = $request->bankname;
            $customer_sub->bankbranch       = $request->bankbranch;
            $customer_sub->medicalCenter    = $request->medicalCenter;
            $customer_sub->immigrationCosts = $request->immigrationCosts;
            $customer_sub->finger_regno     = $request->finger_regno;
            $customer_sub->salary           = $request->salary;
            $customer_sub->ordinal          = $request->ordinal;
            $customer_sub->status           = $request->status;
            $customer_sub->value            = 0;
            $customer_sub->userId           = Auth::user()->id;
            $customer_sub->save();

            if($customer_sub){
                $customer_manpower->manpowerlist        = 1;
                $customer_manpower->update();
                return redirect() -> back() -> with('message', 'Customer is added to Manpower Statement');
            }
        }else{
            return redirect()->back()->with('error_message', 'Customer Finger Registration Number is already exists in the table!');
        }
    }

    public function display($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $manpower_display = $this->getCustomersDetails($id)->where('userId', $userId);
        $manpower_display->transform(function ($customer) {
            if (isset($customer->gender)) {
                $customer->gender = GenderEnum::tryFrom($customer->gender);
            }
            return $customer;
        });
        
        if($manpower_display->count() > 0 && ($manpower_display[0]->value == 3 || $manpower_display[0]->value == 4)){
            return view('admin.client.manpower.display', compact('manpower_display'));
        }else{
            return redirect('/manpower');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editStatement($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $manpower_customers = Customer::where('userId', $userId)->find($id);
        $edit_manpower = CustomerManpower::where('customerId', $id)->where('userId', $userId)->get();
        $all_manpower = ManpowerSubmission::where('status', 1)->where('userId','=',$userId)->orderBy('manpowerDate', 'desc')->limit(1)->get();
        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            if ($manpower_customers !== null && $manpower_customers->value == 4 && $manpower_customers->manpowerlist == 1) {
                return view('admin.client.manpower.editStatement', [
                'manpower_customers'=>$manpower_customers,
                'edit_manpower'=>$edit_manpower,
                'all_manpower'=>$all_manpower,
                ]);
            }else{
                return redirect('/manpower');
            }
        }else{
            return redirect('/manpower');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatement(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $manpower_customers = Customer::where('userId', $userId)->find($id);
        $edit_manpower = CustomerManpower::where('customerId', $id)->where('userId', $userId)->first();
        $this->validationInfo($request);
        if ($manpower_customers && $edit_manpower) {
            $edit_manpower->manpowerSubId    = $request->manpowerSubId;
            $edit_manpower->customerPhone    = $request->customerPhone;
            $edit_manpower->fatherPhone      = $request->fatherPhone;
            $edit_manpower->motherPhone      = $request->motherPhone;
            $edit_manpower->certificateNo    = $request->certificateNo;
            $edit_manpower->batchNo          = $request->batchNo;
            $edit_manpower->rollNo           = $request->rollNo;
            $edit_manpower->ttcname          = $request->ttcname;
            $edit_manpower->accountNo        = $request->accountNo;
            $edit_manpower->bankname         = $request->bankname;
            $edit_manpower->bankbranch       = $request->bankbranch;
            $edit_manpower->medicalCenter    = $request->medicalCenter;
            $edit_manpower->immigrationCosts = $request->immigrationCosts;
            $edit_manpower->salary           = $request->salary;
            $edit_manpower->ordinal          = $request->ordinal;
            $edit_manpower->status           = $request->status;
            $edit_manpower->update();

            return redirect() -> back() -> with('message', 'Customer Manpower Statement Info is Updated successfully');
        } else {
        return redirect()->back()->with('error_message', 'Customer Manpower is not found');
        }
    }

    public function editFinger($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $customer_finger = Customer::where('userId', $userId)->find($id);
        $edit_finger = CustomerManpower::where('customerId', $id)->where('userId', $userId)->get();
        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){        
            if ($customer_finger !== null && $customer_finger->value == 4 && $customer_finger->manpowerlist == 1) {
                return view('admin.client.manpower.editFinger', [
                'customer_finger'=>$customer_finger,
                'edit_finger'=>$edit_finger,
                ]);
            }else{
                return redirect('/manpower');
            }
        }else{
            return redirect('/manpower');
        }
    }

    public function updateFinger(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $customer_finger = Customer::where('userId', $userId)->find($id);
        $edit_finger = CustomerManpower::where('customerId', $id)->where('userId', $userId)->first();
        $existingRecord = CustomerManpower::where([
            'finger_regno'=>$request->finger_regno,
            'userId'=>$userId,
        ])->first();
        if (!$existingRecord){
        $this -> validate($request, [
            'finger_regno'   => 'required',
        ],
        [
            'finger_regno.required'     => 'Finger Registration Number Field must not be Empty',
            'finger_regno.unique'       => 'Finger Registration Number is already Exist',
        ]);

        if ($customer_finger && $edit_finger) {

        $edit_finger->finger_regno     = $request->finger_regno;
        $edit_finger->update();

        return redirect() -> back() -> with('message', 'Customer Manpower Finger Registration Number is Updated successfully');
        } else {
        return redirect()->back()->with('error_message', 'Customer Manpower Finger Registration Number is not found');
        }
        }else{
            return redirect() -> back() -> with('error_message', 'Customer Manpower Finger Registration Number is already exist in the table !');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function remove($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
            return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $customer_man = Customer::where('userId', $userId)->find($id);
        $customer_man->manpowerlist        = 0;
        $customer_man->save();

        if($customer_man){
            CustomerManpower::where('customerId', $id)->where('userId', $userId)->delete();
            return redirect() -> back() -> with('message', 'The Customer is removed from Manpower Statement successfully');
        }
    }

    public function stampingVisa($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $data_stamped_customer = Customer::where('userId', $userId)->find($id);
        $customer_stamping = CustomerVisa::latest()->where('userId','=',$userId) -> get();
        $all_country = Country::where('status', 1)->orderBy('countryname', 'asc')->get();
        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){        
            if($data_stamped_customer !== null && $data_stamped_customer->value == 3){
                return view('admin.client.manpower.stampingVisa', [
                'data_stamped_customer'=>$data_stamped_customer,
                'customer_stamping'=>$customer_stamping,
                'all_country'=>$all_country,
            ]);
            }else{
                return redirect('/manpower');
            }
        }else{
            return redirect('/manpower');
        }
    }

    public function storeStampingVisa(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $data_stamped_customer = Customer::where('userId', $userId)->find($id);
        $existingRecord = CustomerVisa::where([
            'stamped_visano'=>$request->stamped_visano,
            'userId'=>$userId,
        ])->first();
        if (!$existingRecord){
            $this->validationVisa($request);
            $customer_id = $data_stamped_customer->id;

            $customer_stamping = new CustomerVisa();
            $customer_stamping->customerId     = $customer_id;
            $customer_stamping->stamped_visano = $request->stamped_visano;
            $customer_stamping->visa_issue     = $request->visa_issue;
            $customer_stamping->visa_expiry    = $request->visa_expiry;
            $customer_stamping->stay_duration  = $request->stay_duration;
            $customer_stamping->countryId      = $request->countryId;
            $customer_stamping->save();

            if($customer_stamping){
                $data_stamped_customer->value        = 4;
                $data_stamped_customer->update();
                return redirect() -> back() -> with('message', 'Customer Visa Stamping Info is added successfully');
            }
        }else{
            return redirect()->back()->with('error_message', 'Customer Visa Stamping Number is already exists in the table!');
        }
    }

    protected function validation($request){
        $this -> validate($request, [
            'customerId'       => 'unique:customer_manpowers',
            'manpowerSubId'    => 'required|exists:manpower_submissions,id',
            'certificateNo'    => 'required',
            'batchNo'          => 'required',
            'rollNo'           => 'required',
            'ttcname'          => 'required',
            'medicalCenter'    => 'required',
            'immigrationCosts' => 'required',
            'finger_regno'     => 'required|unique:customer_manpowers',
            'salary'           => 'required',
            'ordinal'          => 'required',
            'status'           => 'required|in:1,0',
        ],
        [
            'customerId.unique'         => 'Customer is already exist',
            'manpowerSubId.required'    => 'Manpower Submission Date Field is required',
            'manpowerSubId.exists'      => 'Manpower Submission Date Field is Invalid',
            'certificateNo.required'    => 'Certificate No. Field must not be Empty',
            'batchNo.required'          => 'Batch No. Field must not be Empty',
            'rollNo.required'           => 'Roll No. Field must not be Empty',
            'ttcname.required'          => 'Training Center Name Field must not be Empty',
            'medicalCenter.required'    => 'Medical Center Name Field must not be Empty',
            'immigrationCosts.required' => 'Immigration Costs Field must not be Empty',
            'finger_regno.required'     => 'Finger Registration Number Field must not be Empty',
            'finger_regno.unique'       => 'Finger Registration Number is already Exist',
            'salary.required'           => 'Salary Field must not be Empty',
            'ordinal.required'          => 'Ordinal No. for Serial Field must not be Empty',
            'status.required'           => 'Status Field is required',
            'status.in'                 => 'Invalid status option selected',
        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'customerId'       => 'unique:customer_manpowers',
            'manpowerSubId'    => 'required|exists:manpower_submissions,id',
            'certificateNo'    => 'required',
            'batchNo'          => 'required',
            'rollNo'           => 'required',
            'ttcname'          => 'required',
            'medicalCenter'    => 'required',
            'immigrationCosts' => 'required',
            'salary'           => 'required',
            'ordinal'          => 'required',
            'status'           => 'required|in:1,0',
        ],
        [
            'customerId.unique'         => 'Customer is already exist',
            'manpowerSubId.required'    => 'Manpower Submission Date Field is required',
            'manpowerSubId.exists'      => 'Manpower Submission Date Field is Invalid',
            'certificateNo.required'    => 'Certificate No. Field must not be Empty',
            'batchNo.required'          => 'Batch No. Field must not be Empty',
            'rollNo.required'           => 'Roll No. Field must not be Empty',
            'ttcname.required'          => 'Training Center Name Field must not be Empty',
            'medicalCenter.required'    => 'Medical Center Name Field must not be Empty',
            'immigrationCosts.required' => 'Immigration Costs Field must not be Empty',
            'salary.required'           => 'Salary Field must not be Empty',
            'ordinal.required'          => 'Ordinal No. for Serial Field must not be Empty',
            'status.required'           => 'Status Field is required',
            'status.in'                 => 'Invalid status option selected',
        ]);
    }

    protected function validationVisa($request){
        $this -> validate($request, [
            'customerId'        => 'unique:customer_visas',
            'stamped_visano'    => 'required',
            'stay_duration'     => 'required',
            'visa_issue'        => 'required|date',
            'visa_expiry'       => 'required|date',
            'countryId'         => 'required|exists:countries,id',
        ],
        [
            'customerId.unique'       => 'Customer is already exist',
            'stamped_visano.unique'   => 'Stamped Visa Number is already exist',
            'stamped_visano.required' => 'Stamped Visa Number Field must not be Empty',
            'stay_duration.required'  => 'Stay Duration Field is required',
            'visa_issue.required'     => 'Visa Issue Date Field is required',
            'visa_expiry.required'    => "Visa Expiry Date Field is required !!",
            'countryId.required'      => "Country Field is required !!",
            'countryId.exists'        => "Invalid Country Field !!",
        ]);
    }

    protected function getCustomers(){
        $data_customer = DB::table('customers')
            ->leftJoin('delegates', 'customers.agentId', '=', 'delegates.id')
            ->leftJoin('districts', 'customers.birthPlace', '=', 'districts.id')
            ->leftJoin('visatrades', 'customers.tradeId', '=', 'visatrades.id')
            ->leftJoin('customer_embassies', 'customers.id', '=', 'customer_embassies.customerId')
            ->leftJoin('customer_visas', 'customers.id', '=', 'customer_visas.customerId')
            ->leftJoin('countries', 'customer_visas.countryId', '=', 'countries.id')
            ->leftJoin('customer_manpowers', 'customers.id', '=', 'customer_manpowers.customerId')
            ->leftJoin('visas', 'customer_embassies.visaId', '=', 'visas.id')
            ->leftJoin('manpower_submissions', 'customer_manpowers.manpowerSubId', '=', 'manpower_submissions.id')
            ->leftJoin('users', 'customers.userId', '=', 'users.id')
            ->select('customers.*', 'delegates.agentname', 'delegates.agentsl', 'delegates.agentbook', 'districts.districtname', 'visatrades.visatrade_name', 'users.name as receiver', 'visas.visano_en', 'visas.visano_ar', 'visas.sponsorid_en', 'visas.sponsorid_ar', 'visas.sponsorname_en', 'visas.sponsorname_ar', 'visas.visa_date', 'visas.visa_address', 'visas.occupation_en', 'visas.occupation_ar', 'visas.delegation_no', 'visas.delegation_date', 'visas.delegated_visa', 'visas.visa_duration', 'customer_visas.stamped_visano', 'customer_visas.visa_issue', 'customer_visas.visa_expiry', 'customer_visas.stay_duration', 'countries.countryname as foreign_country', 'countries.nationality as foreign_national', 'customer_manpowers.customerPhone', 'customer_manpowers.ordinal', 'customer_manpowers.fatherPhone', 'customer_manpowers.motherPhone', 'customer_manpowers.certificateNo', 'customer_manpowers.batchNo', 'customer_manpowers.rollNo', 'customer_manpowers.ttcname', 'customer_manpowers.accountNo', 'customer_manpowers.bankname', 'customer_manpowers.bankbranch', 'customer_manpowers.medicalCenter', 'customer_manpowers.immigrationCosts', 'customer_manpowers.finger_regno', 'customer_manpowers.salary', 'manpower_submissions.manpowerDate', 'manpower_submissions.putupSl')
            ->where('customers.value','=',4)
            ->orderBy('customers.customersl', 'desc')
            ->get();
        return $data_customer;
    }

    protected function getCustomersDetails($id){
        $data_customerDetails = DB::table('customers')
            ->leftJoin('delegates', 'customers.agentId', '=', 'delegates.id')
            ->leftJoin('districts', 'customers.birthPlace', '=', 'districts.id')
            ->leftJoin('visatrades', 'customers.tradeId', '=', 'visatrades.id')
            ->leftJoin('customer_embassies', 'customers.id', '=', 'customer_embassies.customerId')
            ->leftJoin('customer_visas', 'customers.id', '=', 'customer_visas.customerId')
            ->leftJoin('countries', 'customer_visas.countryId', '=', 'countries.id')
            ->leftJoin('customer_manpowers', 'customers.id', '=', 'customer_manpowers.customerId')
            ->leftJoin('visas', 'customer_embassies.visaId', '=', 'visas.id')
            ->leftJoin('manpower_submissions', 'customer_manpowers.manpowerSubId', '=', 'manpower_submissions.id')
            ->leftJoin('users', 'customers.userId', '=', 'users.id')
            ->select('customers.*', 'delegates.agentname', 'delegates.agentsl', 'delegates.agentbook', 'districts.districtname', 'visatrades.visatrade_name', 'users.name as receiver', 'visas.visano_en', 'visas.visano_ar', 'visas.sponsorid_en', 'visas.sponsorid_ar', 'visas.sponsorname_en', 'visas.sponsorname_ar', 'visas.visa_date', 'visas.visa_address', 'visas.occupation_en', 'visas.occupation_ar', 'visas.delegation_no', 'visas.delegation_date', 'visas.delegated_visa', 'visas.visa_duration', 'customer_visas.stamped_visano', 'customer_visas.visa_issue', 'customer_visas.visa_expiry', 'customer_visas.stay_duration', 'countries.countryname as foreign_country', 'countries.nationality as foreign_national', 'customer_manpowers.customerPhone', 'customer_manpowers.ordinal', 'customer_manpowers.fatherPhone', 'customer_manpowers.motherPhone', 'customer_manpowers.certificateNo', 'customer_manpowers.batchNo', 'customer_manpowers.rollNo', 'customer_manpowers.ttcname', 'customer_manpowers.accountNo', 'customer_manpowers.bankname', 'customer_manpowers.bankbranch', 'customer_manpowers.medicalCenter', 'customer_manpowers.immigrationCosts', 'customer_manpowers.finger_regno', 'customer_manpowers.salary', 'manpower_submissions.manpowerDate', 'manpower_submissions.putupSl')
            ->where('customers.id', $id)
            ->orderBy('customer_manpowers.ordinal')
            ->get();
        return $data_customerDetails;
    }
}