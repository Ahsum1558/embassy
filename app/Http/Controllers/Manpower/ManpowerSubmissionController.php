<?php

namespace App\Http\Controllers\Manpower;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\File;
use App\Models\Customer;
use App\Models\CustomerEmbassy;
use App\Models\Delegate;
use App\Models\User;
use App\Models\Field;
use App\Models\Visa;
use App\Models\Submission;
use App\Models\SubmissionCustomer;
use App\Models\ManpowerSubmission;
use App\Models\CustomerManpower;
use App\Models\BmetPayment;
use App\Models\CustomerDocoment;
use App\Models\CustomerPassport;
use App\Models\CustomerRate;
use App\Models\CustomerVisa;
use App\Models\Visatrade;
use App\Models\Country;
use App\Models\Division;
use App\Models\District;
use App\Models\Policestation;
use App\Models\Issue;
use App\Models\City;
use App\Models\Visatype;
use Milon\Barcode\DNS1D;
use Picqer\Barcode\BarcodeGeneratorPNG;
use DateTime;
use Illuminate\Support\Carbon;

class ManpowerSubmissionController extends Controller
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
        $all_manpower = $this->getInfo()->where('userId', $userId);
        $all_customer = $this->getCustomers()->where('value','=',4)->where('userId', $userId);
        $stamped_customer = $this->getCustomers()->where('value','=',3)->where('userId', $userId);
        $all_payment = $this->getPayment()->where('userId', $userId);
        return view('admin.client.manpower.index', [
            'all_manpower'=>$all_manpower,
            'all_customer'=>$all_customer,
            'stamped_customer'=>$stamped_customer,
            'all_payment'=>$all_payment,
        ]);
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
        $manpower_data = ManpowerSubmission::latest()->where('userId','=',$userId) -> get();
        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            return view('admin.client.manpower.create', compact('manpower_data'));
        }else{
            return redirect('/manpower');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $manpower_data = ManpowerSubmission::latest()->where('userId','=',$userId) -> get();
        $this->validation($request);

        $existingManpowerDate = ManpowerSubmission::where([
            'manpowerDate'=>$request->manpowerDate,
            'userId'=>$userId,
        ])->first();

        $existingNotesheet = ManpowerSubmission::where([
            'putupSl'=>$request->putupSl,
            'userId'=>$userId,
        ])->first();

        if ($existingNotesheet || $existingManpowerDate) {
            return redirect()->back()->with('error_message', 'Manpower Date or Notesheet Number already exists in the table!');
        }
            ManpowerSubmission::create([
                'manpowerDate'   => $request->manpowerDate,
                'putupSl'        => $request->putupSl,
                'countrynamebn'  => $request->countrynamebn,
                'status'         => $request->status,
                'userId'         => $userId,
            ]);

            return redirect() -> back() -> with('message', 'Manpower Submission Date is added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $manpower_single_data = $this->getDetails($id)->where('userId', $userId);
        $manpower_customers = $this->getCustomersDetails($id)->where('userId', $userId)->where('status', '=', 1);
        $manpower_payment = BmetPayment::where('manpowerSubId', $id)->where('userId', $userId)->where('status', '=', 1)->get();        
        if($manpower_single_data->count() > 0){
            return view('admin.client.manpower.show', [
            'manpower_single_data'=>$manpower_single_data,
            'manpower_customers'=>$manpower_customers,
            'manpower_payment'=>$manpower_payment,
        ]);
        }else{
            return redirect('/manpower');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $manpower_info = ManpowerSubmission::where('userId', $userId)->find($id);
        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            if($manpower_info !== null){
                return view('admin.client.manpower.edit', compact('manpower_info'));
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
    public function update(Request $request, string $id)
    {
        $userId = Auth::user()->id;
        $manpower_info = ManpowerSubmission::where('userId', $userId)->find($id);
        $this->validationInfo($request);

        $manpower_info->countrynamebn = $request->countrynamebn;
        $manpower_info->status       = $request->status;
        $manpower_info->update();

        return redirect() -> back() -> with('message', 'Manpower Submission Info is Updated successfully');
    }

    public function editDate($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $manpower_date_info = ManpowerSubmission::where('userId', $userId)->find($id);
        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            if ($manpower_date_info !== null) {
                return view('admin.client.manpower.editDate', compact('manpower_date_info'));
            }else{
                return redirect('/manpower');
            }
        }else{
            return redirect('/manpower');
        }
    }

    public function updateDate(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $manpower_date_info = ManpowerSubmission::where('userId', $userId)->find($id);
        $existingRecord = ManpowerSubmission::where([
            'manpowerDate'=>$request->manpowerDate,
            'userId'=>$userId,
        ])->first();
        if (!$existingRecord){
            $this -> validate($request, [
                'manpowerDate' => 'required|date',
            ],
            [
                'manpowerDate.required' => "Manpower Submission Date Field is required !!",
            ]);
            $manpower_date_info->manpowerDate = $request->manpowerDate;
            $manpower_date_info->update();

            return redirect() -> back() -> with('message', 'Manpower Submission Date is Updated successfully');
        }else{
            return redirect() -> back() -> with('error_message', 'Manpower Submission Date is already exist in the table !');
        }
    }

    public function editNotesheet($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $manpower_putup_info = ManpowerSubmission::where('userId', $userId)->find($id);
        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            if ($manpower_putup_info !== null) {
                return view('admin.client.manpower.editNotesheet', compact('manpower_putup_info'));
            }else{
                return redirect('/manpower');
            }
        }else{
            return redirect('/manpower');
        }
    }

    public function updateNotesheet(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $manpower_putup_info = ManpowerSubmission::where('userId', $userId)->find($id);
        $existingRecord = ManpowerSubmission::where([
            'putupSl'=>$request->putupSl,
            'userId'=>$userId,
        ])->first();
        if (!$existingRecord){
        $this -> validate($request, [
            'putupSl' => 'required',
        ],
        [
            'putupSl.required' => "Notesheet Number Field is required !!",
        ]);

        $manpower_putup_info->putupSl = $request->putupSl;
        $manpower_putup_info->update();

        return redirect() -> back() -> with('message', 'Notesheet Number is Updated successfully');
        }else{
            return redirect() -> back() -> with('error_message', 'Notesheet Number is already exist in the table !');
        }
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
        $manpower = ManpowerSubmission::where('userId', $userId)->find($id);
        if ($manpower) {
            $manpower->delete();
        }
        CustomerManpower::where('manpowerSubId', $id)->where('userId', $userId)->delete();
        BmetPayment::where('manpowerSubId', $id)->where('userId', $userId)->delete();
        
        return redirect()->back()->with('message', 'Manpower Submission and related records have been deleted.');
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
        $manpower_inactive = ManpowerSubmission::where('userId', $userId)->find($id);
        $manpower_inactive->status   = 0;
        $manpower_inactive->update();              

        return redirect('/manpower')->with('message', 'The Manpower Submission Date is Inactive Successfully');
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
        $manpower_active = ManpowerSubmission::where('userId', $userId)->find($id);
        $manpower_active->status   = 1;
        $manpower_active->update();              

        return redirect('/manpower')->with('message', 'The Manpower Submission Date is Active Successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'manpowerDate' => 'required|date',
            'putupSl'      => 'required',
            'status'       => 'required|in:1,0',
            'countrynamebn' => 'required',
        ],
        [
            'manpowerDate.required'   => "Manpower Submission Date Field is required !!",
            'putupSl.required'        => "Notesheet Number Field is required !!",
            'status.required'         => 'Status Field is required',
            'status.in'               => 'Invalid status option selected',
            'countrynamebn.required'   => "Country Name in Bengali Field is required !!",
        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'status'    => 'required|in:1,0',
            'countrynamebn' => 'required',
        ],
        [
            'status.required'    => 'Status Field is required',
            'status.in'          => 'Invalid status option selected',
            'countrynamebn.required'   => "Country Name in Bengali Field is required !!",
        ]);
    }

    protected function getInfo(){
        $data_info = DB::table('manpower_submissions')
            ->leftJoin('users', 'manpower_submissions.userId', '=', 'users.id')
            ->select('manpower_submissions.*', 'users.title', 'users.license', 'users.licenseExpiry', 'users.address', 'users.proprietor', 'users.proprietortitle', 'users.title_ar', 'users.license_ar', 'users.address_ar', 'users.proprietor_ar', 'users.proprietortitle_ar', 'users.title_bn', 'users.license_bn', 'users.address_bn', 'users.proprietor_bn', 'users.proprietortitle_bn', 'users.description_bn')
            ->orderByDesc('manpower_submissions.manpowerDate')
            ->get();
        return $data_info;
    }

    protected function getDetails($id){
        $data_details = DB::table('manpower_submissions')
            ->leftJoin('users', 'manpower_submissions.userId', '=', 'users.id')
            ->where('manpower_submissions.id', $id)
            ->select('manpower_submissions.*', 'users.title', 'users.license', 'users.licenseExpiry', 'users.address', 'users.proprietor', 'users.proprietortitle', 'users.title_ar', 'users.license_ar', 'users.address_ar', 'users.proprietor_ar', 'users.proprietortitle_ar', 'users.title_bn', 'users.license_bn', 'users.address_bn', 'users.proprietor_bn', 'users.proprietortitle_bn', 'users.description_bn')
            ->get();
        return $data_details;
    }

    protected function getPayment(){
        $data_info = DB::table('bmet_payments')
            ->leftJoin('manpower_submissions', 'bmet_payments.manpowerSubId', '=', 'manpower_submissions.id')
            ->select('bmet_payments.*', 'manpower_submissions.manpowerDate', 'manpower_submissions.putupSl')
            ->orderByDesc('manpower_submissions.manpowerDate')
            ->get();
        return $data_info;
    }

    protected function getPaymentDetails($id){
        $data_info = DB::table('bmet_payments')
            ->leftJoin('manpower_submissions', 'bmet_payments.manpowerSubId', '=', 'manpower_submissions.id')
            ->select('bmet_payments.*', 'manpower_submissions.manpowerDate', 'manpower_submissions.putupSl')
            ->where('manpower_submissions.id', $id)
            ->orderByDesc('manpower_submissions.manpowerDate')
            ->get();
        return $data_info;
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
            ->orderBy('manpower_submissions.manpowerDate', 'desc')
            ->orderBy('customer_manpowers.ordinal', 'desc')
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
            ->where('manpower_submissions.id', $id)
            ->where('customers.value','=',4)
            ->orderBy('customer_manpowers.ordinal')
            ->get();
        return $data_customerDetails;
    }
}