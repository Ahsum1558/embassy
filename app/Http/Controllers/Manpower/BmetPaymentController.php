<?php

namespace App\Http\Controllers\Manpower;

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
use Illuminate\Support\Facades\File;
use Picqer\Barcode\BarcodeGeneratorPNG;
use DateTime;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Carbon;

class BmetPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function payment($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $manpower_data = ManpowerSubmission::where('userId', $userId)->find($id);
        $bmet_payment = BmetPayment::latest()->where('userId','=',$userId) -> get();
        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){         
            if($manpower_data !== null){
                return view('admin.client.manpower.payment', [
                'manpower_data'=>$manpower_data,
                'bmet_payment'=>$bmet_payment,
            ]);
            }else{
                return redirect('/manpower');
            }
        }else{
            return redirect('/manpower');
        }
    }

    public function storePayment(Request $request, $id)
    {
        $this->validation($request);
        $userId = Auth::user()->id;
        $manpower_data = ManpowerSubmission::where('userId', $userId)->find($id);
        $manpower_id = $manpower_data->id;

        $existingIncomeTaxNo = BmetPayment::where([
            'incomeTaxNo'=>$request->incomeTaxNo,
            'userId'=>$userId,
        ])->first();

        $existingWelfare = BmetPayment::where([
            'welfareInsuranceNo'=>$request->welfareInsuranceNo,
            'userId'=>$userId,
        ])->first();

        $existingSmartCard = BmetPayment::where([
            'smartCardNo'=>$request->smartCardNo,
            'userId'=>$userId,
        ])->first();

        if ($existingWelfare || $existingIncomeTaxNo || $existingSmartCard) {
            return redirect()->back()->with('error_message', 'Income Tax Pay Order Number or Welfare Insurance Pay Order Number or Smart Card Pay Order Number is already exists in the table!');
        }

        $bmet_payment = new BmetPayment();
        $bmet_payment->manpowerSubId     = $manpower_id;
        $bmet_payment->customerNumber    = $request->customerNumber;
        $bmet_payment->taxPayBank        = $request->taxPayBank;
        $bmet_payment->incomeTax         = $request->incomeTax;
        $bmet_payment->incomeTaxNo       = $request->incomeTaxNo;
        $bmet_payment->incomeTaxDate     = $request->incomeTaxDate;
        $bmet_payment->insurancePayBank  = $request->insurancePayBank;
        $bmet_payment->welfareInsurance  = $request->welfareInsurance;
        $bmet_payment->welfareInsuranceNo = $request->welfareInsuranceNo;
        $bmet_payment->welfareInsuranceDate = $request->welfareInsuranceDate;
        $bmet_payment->smartPayBank      = $request->smartPayBank;
        $bmet_payment->smartCard         = $request->smartCard;
        $bmet_payment->smartCardNo       = $request->smartCardNo;
        $bmet_payment->smartCardDate     = $request->smartCardDate;
        $bmet_payment->status            = $request->status;
        $bmet_payment->userId            = $userId;
        $bmet_payment->save();

        return redirect() -> back() -> with('message', 'BMET Payment is added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function showPayment($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $bmet_display = $this->getDetails($id)->where('userId', $userId);
        if($bmet_display->count() > 0){
            return view('admin.client.manpower.showPayment', compact('bmet_display'));
        }else{
            return redirect('/manpower');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editPayment($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $payment_bmet = BmetPayment::where('userId', $userId)->find($id);
        $all_manpower = ManpowerSubmission::where('status', 1)->where('userId','=',$userId)->orderBy('manpowerDate', 'desc')->limit(1)->get();
        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){        
            if ($payment_bmet !== null ) {
                return view('admin.client.manpower.editPayment', [
                'payment_bmet'=>$payment_bmet,
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
    public function updatePayment(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $payment_bmet = BmetPayment::where('userId', $userId)->find($id);
        $this->validationInfo($request);

        $payment_bmet->manpowerSubId     = $request->manpowerSubId;
        $payment_bmet->customerNumber    = $request->customerNumber;
        $payment_bmet->taxPayBank        = $request->taxPayBank;
        $payment_bmet->incomeTax         = $request->incomeTax;
        $payment_bmet->incomeTaxDate     = $request->incomeTaxDate;
        $payment_bmet->insurancePayBank  = $request->insurancePayBank;
        $payment_bmet->welfareInsurance  = $request->welfareInsurance;
        $payment_bmet->welfareInsuranceDate = $request->welfareInsuranceDate;
        $payment_bmet->smartPayBank      = $request->smartPayBank;
        $payment_bmet->smartCard         = $request->smartCard;
        $payment_bmet->smartCardDate     = $request->smartCardDate;
        $payment_bmet->status            = $request->status;
        $payment_bmet->update();

        return redirect() -> back() -> with('message', 'BMET Payment Info is Updated successfully');
    }

    public function editTax($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $payment_tax = BmetPayment::where('userId', $userId)->find($id);
        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            if ($payment_tax !== null ) {
                return view('admin.client.manpower.editTax', [
                'payment_tax'=>$payment_tax,
                ]);
            }else{
                return redirect('/manpower');
            }
        }else{
            return redirect('/manpower');
        }
    }

    public function updateTax(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $payment_tax = BmetPayment::where('userId', $userId)->find($id);
        $existingRecord = BmetPayment::where([
            'incomeTaxNo'=>$request->incomeTaxNo,
            'userId'=>$userId,
        ])->first();
        if (!$existingRecord){
            $this -> validate($request, [
                'incomeTaxNo' => 'required',
            ],
            [
                'incomeTaxNo.required'        => 'Income Tax Payment Pay Order Number Field must not be Empty',
            ]);

            $payment_tax->incomeTaxNo  = $request->incomeTaxNo;
            $payment_tax->update();

            return redirect() -> back() -> with('message', 'Income Tax Pay Order Number is Updated successfully');
        }else{
            return redirect() -> back() -> with('error_message', 'Income Tax Pay Order Number is already exist in the table !');
        }
    }

    public function editInsurance($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $payment_insurance = BmetPayment::where('userId', $userId)->find($id);
        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            if ($payment_insurance !== null ) {
                return view('admin.client.manpower.editInsurance', [
                'payment_insurance'=>$payment_insurance,
                ]);
            }else{
                return redirect('/manpower');
            }
        }else{
            return redirect('/manpower');
        }
    }

    public function updateInsurance(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $payment_insurance = BmetPayment::where('userId', $userId)->find($id);
        $existingRecord = BmetPayment::where([
            'welfareInsuranceNo'=>$request->welfareInsuranceNo,
            'userId'=>$userId,
        ])->first();
        if (!$existingRecord){
            $this -> validate($request, [
                'welfareInsuranceNo' => 'required',
            ],
            [
                'welfareInsuranceNo.required' => 'Welfare Insurance Payment Pay Order Number Field must not be Empty',
            ]);

            $payment_insurance->welfareInsuranceNo = $request->welfareInsuranceNo;
            $payment_insurance->update();

            return redirect() -> back() -> with('message', 'Welfare Insurance Pay Order Number is Updated successfully');
        }else{
            return redirect() -> back() -> with('error_message', 'Welfare Insurance Pay Order Number is already exist in the table !');
        }
    }

    public function editCard($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $payment_card = BmetPayment::where('userId', $userId)->find($id);
        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){        
            if ($payment_card !== null ) {
                return view('admin.client.manpower.editCard', [
                'payment_card'=>$payment_card,
                ]);
            }else{
                return redirect('/manpower');
            }
        }else{
            return redirect('/manpower');
        }
    }

    public function updateCard(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $payment_card = BmetPayment::where('userId', $userId)->find($id);
        $existingRecord = BmetPayment::where([
            'smartCardNo'=>$request->smartCardNo,
            'userId'=>$userId,
        ])->first();
        if (!$existingRecord){

            $this -> validate($request, [
                'smartCardNo' => 'required',
            ],
            [
                'smartCardNo.required' => 'Smart Card Payment Pay Order Number Field must not be Empty',
            ]);

            $payment_card->smartCardNo = $request->smartCardNo;
            $payment_card->update();

            return redirect() -> back() -> with('message', 'Smart Card Pay Order Number is Updated successfully');
        }else{
            return redirect() -> back() -> with('error_message', 'Smart Card Pay Order Number is already exist in the table !');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
            return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $data_payment = BmetPayment::where('userId', $userId)->find($id);
        $data_payment -> delete();

        return redirect() -> back() -> with('message', 'The BMET Payment is deleted successfully');
    }

    public function inactivePayment($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
            return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $bmet_inactive = BmetPayment::where('userId', $userId)->find($id);

        $bmet_inactive->status   = 0;
        $bmet_inactive->update();              

        return redirect('/manpower')->with('message', 'The Manpower Payment is Inactive Successfully');
    }
    
    public function activePayment($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
            return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $bmet_active = BmetPayment::where('userId', $userId)->find($id);

        $bmet_active->status   = 1;
        $bmet_active->update();              

        return redirect('/manpower')->with('message', 'The Manpower Payment is Active Successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'customerNumber'        => 'required',
            'taxPayBank'            => 'required',
            'incomeTax'             => 'required',
            'incomeTaxNo'           => 'required',
            'incomeTaxDate'         => 'required|date',
            'insurancePayBank'      => 'required',
            'welfareInsurance'      => 'required',
            'welfareInsuranceNo'    => 'required',
            'welfareInsuranceDate'  => 'required|date',
            'smartPayBank'          => 'required',
            'smartCard'             => 'required',
            'smartCardNo'           => 'required',
            'smartCardDate'         => 'required|date',
            'status'                => 'required|in:1,0',
        ],
        [
            'customerNumber.required'     => 'Count of Customer Number Field is required',
            'taxPayBank.required'         => 'Income Tax Payment Bank Name Field must not be Empty',
            'incomeTax.required'          => 'Total Amount of Income Tax Field must not be Empty',
            'incomeTaxNo.required'        => 'Income Tax Payment Pay Order Number Field must not be Empty',
            'incomeTaxDate.required'      => 'Income Tax Payment Date Field must not be Empty',
            'insurancePayBank.required'   => 'Welfare Insurance Payment Bank Name Field must not be Empty',
            'welfareInsurance.required'   => 'Total Amount of Welfare Insurance Field must not be Empty',
            'welfareInsuranceNo.required' => 'Welfare Insurance Payment Pay Order Number Field must not be Empty',
            'welfareInsuranceDate.required' => 'Welfare Insurance Payment Date Field must not be Empty',
            'smartPayBank.required'         => 'Smart Card Payment Bank Name Field must not be Empty',
            'smartCard.required'            => 'Total Amount of Smart Card Field must not be Empty',
            'smartCardNo.required'          => 'Smart Card Payment Pay Order Number Field must not be Empty',
            'smartCardDate.required'        => 'Smart Card Payment Date Field must not be Empty',
            'status.required'               => 'Status Field is required',
            'status.in'                     => 'Invalid status option selected',
        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'manpowerSubId'          => 'required|exists:manpower_submissions,id',
            'customerNumber'        => 'required',
            'taxPayBank'            => 'required',
            'incomeTax'             => 'required',
            'incomeTaxDate'         => 'required|date',
            'insurancePayBank'      => 'required',
            'welfareInsurance'      => 'required',
            'welfareInsuranceDate'  => 'required|date',
            'smartPayBank'          => 'required',
            'smartCard'             => 'required',
            'smartCardDate'         => 'required|date',
            'status'                => 'required|in:1,0',
        ],
        [
            'manpowerSubId.required'     => "Manpower Submission Date Field is required !!",
            'manpowerSubId.exists'       => "Invalid Manpower Submission Date Field !!",
            'customerNumber.required'    => 'Count of Customer Number Field is required',
            'taxPayBank.required'         => 'Income Tax Payment Bank Name Field must not be Empty',
            'incomeTax.required'          => 'Total Amount of Income Tax Field must not be Empty',
            'incomeTaxDate.required'      => 'Income Tax Payment Date Field must not be Empty',
            'insurancePayBank.required'   => 'Welfare Insurance Payment Bank Name Field must not be Empty',
            'welfareInsurance.required'    => 'Total Amount of Welfare Insurance Field must not be Empty',
            'welfareInsuranceDate.required' => 'Welfare Insurance Payment Date Field must not be Empty',
            'smartPayBank.required'         => 'Smart Card Payment Bank Name Field must not be Empty',
            'smartCard.required'            => 'Total Amount of Smart Card Field must not be Empty',
            'smartCardDate.required'        => 'Smart Card Payment Date Field must not be Empty',
            'status.required'               => 'Status Field is required',
            'status.in'                     => 'Invalid status option selected',
        ]);
    }

    protected function getDetails($id){
        $data_details = DB::table('bmet_payments')
            ->leftJoin('manpower_submissions', 'bmet_payments.manpowerSubId', '=', 'manpower_submissions.id')
            ->leftJoin('users', 'manpower_submissions.userId', '=', 'users.id')
            ->where('bmet_payments.id', $id)
            ->select('bmet_payments.*', 'manpower_submissions.manpowerDate', 'manpower_submissions.putupSl', 'users.title', 'users.license', 'users.licenseExpiry', 'users.address', 'users.proprietor', 'users.proprietortitle', 'users.title_ar', 'users.license_ar', 'users.address_ar', 'users.proprietor_ar', 'users.proprietortitle_ar', 'users.title_bn', 'users.license_bn', 'users.address_bn', 'users.proprietor_bn', 'users.proprietortitle_bn', 'users.description_bn')
            ->get();
        return $data_details;
    }

    protected function getPayment(){
        $data_info = DB::table('bmet_payments')
            ->leftJoin('manpower_submissions', 'bmet_payments.manpowerSubId', '=', 'manpower_submissions.id')
            ->leftJoin('users', 'manpower_submissions.userId', '=', 'users.id')
            ->select('bmet_payments.*', 'manpower_submissions.manpowerDate', 'manpower_submissions.putupSl', 'users.title', 'users.license', 'users.licenseExpiry', 'users.address', 'users.proprietor', 'users.proprietortitle', 'users.title_ar', 'users.license_ar', 'users.address_ar', 'users.proprietor_ar', 'users.proprietortitle_ar', 'users.title_bn', 'users.license_bn', 'users.address_bn', 'users.proprietor_bn', 'users.proprietortitle_bn', 'users.description_bn')
            ->orderByDesc('manpower_submissions.manpowerDate')
            ->get();
        return $data_info;
    }
}