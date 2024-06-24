<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerEmbassy;
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
use App\Models\CustomerDocoment;
use App\Models\CustomerPassport;
use App\Models\CustomerRate;
use App\Models\CustomerVisa;
use App\Models\CustomerManpower;
use App\Models\Visatrade;
use App\Models\Country;
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

class SubmissionController extends Controller
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
        $all_submission = $this->getInfo()->where('userId', $userId);
        $all_customer = $this->getCustomers()->where('userId', $userId);
        return view('admin.client.submission.index', [
            'all_submission'=>$all_submission,
            'all_customer'=>$all_customer,
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
        $submission_data = Submission::latest()->where('userId','=',$userId) -> get();
        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            return view('admin.client.submission.create', compact('submission_data'));
        }else{
            return redirect('/submission');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $submission_data = Submission::latest()->where('userId','=',$userId) -> get();
        $existingRecord = Submission::where([
            'submissionDate'=>$request->submissionDate,
            'userId'=>$userId,
        ])->first();
       if (!$existingRecord){
            $this->validation($request);
            Submission::create([
                'submissionDate'   => $request->submissionDate,
                'status'            => $request->status,
                'userId'            => $userId,
            ]);
            return redirect() -> back() -> with('message', 'Embassy Submission Date is added successfully');
        }else{
            return redirect()->back()->with('error_message', 'Embassy Submission Date is already exists in the table!');
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
        $submission_single_data = $this->getDetails($id)->where('userId', $userId);
        $submission_customers = $this->getCustomersDetails($id)->where('userId', $userId);        
        if($submission_single_data->count() > 0){
            return view('admin.client.submission.show', [
            'submission_single_data'=>$submission_single_data,
            'submission_customers'=>$submission_customers,
        ]);
        }else{
            return redirect('/submission');
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
        $submission_info = Submission::where('userId', $userId)->find($id);
        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            if($submission_info !== null){
            return view('admin.client.submission.edit', compact('submission_info'));
            }else{
                return redirect('/submission');
            }
        }else{
            return redirect('/submission');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userId = Auth::user()->id;
        $submission_info = Submission::where('userId', $userId)->find($id);
        $existingRecord = Submission::where([
            'submissionDate'=>$request->submissionDate,
            'userId'=>$userId,
        ])->first();
        if (!$existingRecord){
            $this -> validate($request, [
            'submissionDate'    => 'required|date',
        ],
        [
            'submissionDate.required' => "Embassy Submission Date Field is required !!",
        ]);

        $submission_info->submissionDate    = $request->submissionDate;
        $submission_info->update();

        return redirect() -> back() -> with('message', 'Embassy Submission Date is Updated successfully');
        }else{
            return redirect() -> back() -> with('error_message', 'Embassy Submission Date is already exist in the table !');
        }
    }

    public function editDate($id)
    {
        $submission_date_info = Submission::find($id);
        if ($submission_date_info !== null) {
            return view('admin.client.submission.editDate', compact('submission_date_info'));
        }else{
            return redirect('/submission');
        }
    }

    public function updateDate(Request $request, $id)
    {
        $submission_date_info = Submission::findOrFail($id);
        $this -> validate($request, [
            'submissionDate'    => 'required|date',
        ],
        [
            'submissionDate.required' => "Embassy Submission Date Field is required !!",
        ]);

        $submission_date_info->submissionDate = $request->submissionDate;
        $submission_date_info->update();

        return redirect() -> back() -> with('message', 'Embassy Submission Date is Updated successfully');
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
        $userId = Auth::user()->id;
        $submission = Submission::where('userId', $userId)->find($id);

        if ($submission) {
            $submission->delete();
        }
        SubmissionCustomer::where('submissionId', $id)->where('userId', $userId)->delete();
        
        return redirect()->back()->with('message', 'Submission and related records have been deleted.');
    }

    public function inactive($id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $submission_inactive = Submission::where('userId', $userId)->find($id);

        $submission_inactive->status   = 0;
        $submission_inactive->update();              

        return redirect('/submission')->with('message', 'The Submission Date is Inactive Successfully');
    }
    
    public function active($id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $submission_active = Submission::where('userId', $userId)->find($id);
        $submission_active->status   = 1;
        $submission_active->update();              

        return redirect('/submission')->with('message', 'The Submission Date is Active Successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'submissionDate' => 'required|date',
            'status'    => 'required|in:1,0',
        ],
        [
            'submissionDate.required' => "Embassy Submission Date Field is required !!",
            'status.required' => 'Status Field is required',
            'status.in' => 'Invalid status option selected',
        ]);
    }

    protected function getInfo(){
        $data_info = DB::table('submissions')
            ->leftJoin('users', 'submissions.userId', '=', 'users.id')
            ->select('submissions.*', 'users.title', 'users.license', 'users.address', 'users.proprietor', 'users.proprietortitle', 'users.title_ar', 'users.license_ar', 'users.address_ar', 'users.proprietor_ar', 'users.proprietortitle_ar', 'users.title_bn', 'users.license_bn', 'users.address_bn', 'users.proprietor_bn', 'users.proprietortitle_bn', 'users.description_bn')
            ->orderByDesc('submissions.submissionDate')
            ->get();
        return $data_info;
    }

    protected function getDetails($id){
        $data_details = DB::table('submissions')
            ->leftJoin('users', 'submissions.userId', '=', 'users.id')
            ->where('submissions.id', $id)
            ->select('submissions.*', 'users.title', 'users.license', 'users.address', 'users.proprietor', 'users.proprietortitle', 'users.title_ar', 'users.license_ar', 'users.address_ar', 'users.proprietor_ar', 'users.proprietortitle_ar', 'users.title_bn', 'users.license_bn', 'users.address_bn', 'users.proprietor_bn', 'users.proprietortitle_bn', 'users.description_bn')
            ->get();
        return $data_details;
    }

    protected function getCustomers(){
        $data_customer = DB::table('customers')
            ->leftJoin('delegates', 'customers.agentId', '=', 'delegates.id')
            ->leftJoin('districts', 'customers.birthPlace', '=', 'districts.id')
            ->leftJoin('visatrades', 'customers.tradeId', '=', 'visatrades.id')
            ->leftJoin('customer_embassies', 'customers.id', '=', 'customer_embassies.customerId')
            ->leftJoin('submission_customers', 'customers.id', '=', 'submission_customers.customerId')
            ->leftJoin('visas', 'customer_embassies.visaId', '=', 'visas.id')
            ->leftJoin('submissions', 'submission_customers.submissionId', '=', 'submissions.id')
            ->leftJoin('users', 'customers.userId', '=', 'users.id')
            ->select('customers.*', 'delegates.agentname', 'delegates.agentsl', 'delegates.agentbook', 'districts.districtname', 'visatrades.visatrade_name', 'users.name as receiver', 'visas.visano_en', 'visas.visano_ar', 'visas.sponsorid_en', 'visas.sponsorid_ar', 'visas.sponsorname_en', 'visas.sponsorname_ar', 'visas.visa_date', 'visas.visa_address', 'visas.occupation_en', 'visas.occupation_ar', 'visas.delegation_no', 'visas.delegation_date', 'visas.delegated_visa', 'visas.visa_duration', 'submission_customers.submissionType', 'submission_customers.ordinal', 'submission_customers.visaYear', 'submissions.submissionDate')
            ->where('customers.value','=',3)
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
            ->leftJoin('submission_customers', 'customers.id', '=', 'submission_customers.customerId')
            ->leftJoin('visas', 'customer_embassies.visaId', '=', 'visas.id')
            ->leftJoin('submissions', 'submission_customers.submissionId', '=', 'submissions.id')
            ->leftJoin('users', 'customers.userId', '=', 'users.id')
            ->select('customers.*', 'delegates.agentname', 'delegates.agentsl', 'delegates.agentbook', 'districts.districtname', 'visatrades.visatrade_name', 'users.name as receiver', 'visas.visano_en', 'visas.visano_ar', 'visas.sponsorid_en', 'visas.sponsorid_ar', 'visas.sponsorname_en', 'visas.sponsorname_ar', 'visas.visa_date', 'visas.visa_address', 'visas.occupation_en', 'visas.occupation_ar', 'visas.delegation_no', 'visas.delegation_date', 'visas.delegated_visa', 'visas.visa_duration', 'submission_customers.submissionType', 'submission_customers.ordinal', 'submission_customers.visaYear', 'submissions.submissionDate')
            ->where('submissions.id', $id)
            // ->where('customers.value','=',3)
            ->orderBy('submission_customers.ordinal')
            ->get();
        return $data_customerDetails;
    }
}