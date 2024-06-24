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
use App\Models\CustomerManpower;
use App\Models\SubmissionCustomer;
use Milon\Barcode\DNS1D;
use Illuminate\Support\Facades\File;
use Picqer\Barcode\BarcodeGeneratorPNG;
use DateTime;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Carbon;

class CustomerEmbassyController extends Controller
{
    public function embassy($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $data_customer = Customer::where('userId', $userId)->find($id);
        $customer_embassy = CustomerEmbassy::latest()->where('userId','=',$userId) -> get();
        $all_visa = Visa::latest()->where('status','=',1)->where('userId','=',$userId) -> get();
        $all_visa_type = Visatype::where('status', 1)->orderBy('visatype_name', 'asc')->get();
        $visaCounts = [];

        foreach ($all_visa as $visa) {
            $visaId = $visa->id;
            $total_customer = CustomerEmbassy::where('visaId', $visaId)->count();
            $visaCounts[$visaId] = $total_customer;
        }

        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
        
            if($data_customer !== null && $data_customer->value == 2){
                return view('admin.client.customer.embassy.embassy', [
                'data_customer'=>$data_customer,
                'customer_embassy'=>$customer_embassy,
                'all_visa'=>$all_visa,
                'all_visa_type'=>$all_visa_type,
                'visaCounts'=>$visaCounts,
            ]);
            }else{
                return redirect('/customer');
            }
        }else{
            return redirect('/customer');
        }
    }

    public function storeEmbassy(Request $request, $id)
    {
        $this->validation($request);
        $userId = Auth::user()->id;
        $data_customer = Customer::where('userId', $userId)->find($id);
        $customer_id = $data_customer->id;

        $customer_embassy = new CustomerEmbassy();
        $customer_embassy->customerId       = $customer_id;
        $customer_embassy->mofa             = $request->mofa;
        $customer_embassy->visaTypeId       = $request->visaTypeId;
        $customer_embassy->visaId           = $request->visaId;
        $customer_embassy->religion         = $request->religion;
        $customer_embassy->age              = $request->age;
        $customer_embassy->submissionDate   = $request->submissionDate;
        $customer_embassy->userId           = $userId;
        $customer_embassy->save();

        if($customer_embassy){
            $data_customer->value          = 3;
            $data_customer->medical        = 2;
            $data_customer->medical_update = 1;
            $data_customer->update();
            return redirect() -> back() -> with('message', 'Customer Embassy Info is added successfully');
        }
    }

    public function editEmbassy($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $data_customer_edit = Customer::where('userId', $userId)->find($id);
        $embassy_edit = CustomerEmbassy::where('customerId', $id)->where('userId', $userId)->get();
        $all_visa = Visa::latest()->where('status','=',1)->where('userId','=',$userId) -> get();
        $all_visa_type = Visatype::where('status', 1)->orderBy('visatype_name', 'asc')->get();
        $visaCounts = [];

        foreach ($all_visa as $visa) {
            $visaId = $visa->id;
            $total_customer = CustomerEmbassy::where('visaId', $visaId)->count();
            $visaCounts[$visaId] = $total_customer;
        }

        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            if ($data_customer_edit !== null) {
                return view('admin.client.customer.embassy.editEmbassy', [
                'data_customer_edit'=>$data_customer_edit,
                'embassy_edit'=>$embassy_edit,
                'all_visa'=>$all_visa,
                'all_visa_type'=>$all_visa_type,
                'visaCounts'=>$visaCounts,
                ]);
            }else{
                return redirect('/customer');
            }
        }else{
            return redirect('/customer');
        }
    }

    public function updateEmbassy(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $data_customer_edit = Customer::where('userId', $userId)->find($id);
        $embassy_edit = CustomerEmbassy::where('customerId', $id)->where('userId', $userId)->first();
        $this->validationInfo($request);

        if ($data_customer_edit && $embassy_edit) {
            $embassy_edit->visaTypeId       = $request->visaTypeId;
            $embassy_edit->religion         = $request->religion;
            $embassy_edit->age              = $request->age;
            $embassy_edit->submissionDate   = $request->submissionDate;
            $embassy_edit->update();

            return redirect() -> back() -> with('message', 'Customer Embassy Info is Updated successfully');
        } else {
        return redirect()->back()->with('error_message', 'Customer or Embassy Information is not found');
        }
    }

    public function editVisa($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $data_customer_visa = Customer::where('userId', $userId)->find($id);
        $visa_edit = CustomerEmbassy::where('customerId', $id)->where('userId', $userId)->get();
        $all_visa = Visa::latest()->where('status','=',1)->where('userId','=',$userId) -> get();
        $visaCounts = [];

        foreach ($all_visa as $visa) {
            $visaId = $visa->id;
            $total_customer = CustomerEmbassy::where('visaId', $visaId)->count();
            $visaCounts[$visaId] = $total_customer;
        }

        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            if ($data_customer_visa !== null) {
                return view('admin.client.customer.embassy.editVisa', [
                'data_customer_visa'=>$data_customer_visa,
                'visa_edit'=>$visa_edit,
                'all_visa'=>$all_visa,
                'visaCounts'=>$visaCounts,
                ]);
            }else{
                return redirect('/customer');
            }
        }else{
            return redirect('/customer');
        }
    }

    public function updateVisa(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $data_customer_visa = Customer::where('userId', $userId)->find($id);
        $visa_edit = CustomerEmbassy::where('customerId', $id)->where('userId', $userId)->first();
        $this -> validate($request, [
                'visaId'   => 'required|exists:visas,id',
            ],
            [
                'visaId.required' => 'Visa Info Field is required',
                'visaId.exists'   => 'Invalid Visa Info Field',
            ]);

        if ($data_customer_visa && $visa_edit) {            
            $visa_edit->visaId             = $request->visaId;
            $visa_edit->update();

            return redirect() -> back() -> with('message', 'Customer Visa Info is Updated successfully');
            } else {
        return redirect()->back()->with('error_message', 'Customer or Visa Information is not found');
        }
    }

    public function editMofa($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $data_customer_mofa = Customer::where('userId', $userId)->find($id);
        $mofa_edit = CustomerEmbassy::where('customerId', $id)->where('userId', $userId)->get();
        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            if ($data_customer_mofa !== null) {
                return view('admin.client.customer.embassy.editMofa', [
                'data_customer_mofa'=>$data_customer_mofa,
                'mofa_edit'=>$mofa_edit,
                ]);
            }else{
                return redirect('/customer');
            }
        }else{
            return redirect('/customer');
        }
    }

    public function updateMofa(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $data_customer_mofa = Customer::where('userId', $userId)->find($id);
        $mofa_edit = CustomerEmbassy::where('customerId', $id)->where('userId', $userId)->first();
        $this -> validate($request, [
                'mofa' => 'required|unique:customer_embassies',
            ],
            [
                'mofa.unique'               => 'Mofa Number is already exist',
                'mofa.required'             => 'Mofa Number Field must not be Empty',
            ]);

        if ($data_customer_mofa && $mofa_edit) {
            $mofa_edit->mofa             = $request->mofa;
            $mofa_edit->update();

            return redirect() -> back() -> with('message', 'Customer Mofa Number is Updated successfully');
        } else {
        return redirect()->back()->with('error_message', 'Customer or Mofa Number is not found');
        }
    }

    protected function validation($request){
        $this -> validate($request, [
            'customerId'        => 'unique:customer_embassies',
            'mofa'              => 'required|unique:customer_embassies',
            'visaTypeId'        => 'required|exists:visatypes,id',
            'visaId'            => 'required|exists:visas,id',
            'religion'          => 'required',
            'age'               => 'required',
            'submissionDate'    => 'required|date',
        ],
        [
            'customerId.unique'       => 'Customer is already exist',
            'mofa.unique'             => 'Mofa Number is already exist',
            'mofa.required'           => 'Mofa Number Field must not be Empty',
            'visaTypeId.required'     => 'Visa Type Field is required',
            'visaTypeId.exists'       => 'Visa Type Field is Invalid',
            'visaId.required'         => 'Visa Info Field is required',
            'visaId.exists'           => 'Invalid Visa Info Field',
            'religion.required'       => "Religion Field must not be empty !!",
            'age.required'            => "Age Field is required !!",
            'submissionDate.required' => "Embassy Submission Field is required !!",
        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'visaTypeId'        => 'required|exists:visatypes,id',
            'religion'          => 'required',
            'age'               => 'required',
            'submissionDate'    => 'required|date',
        ],
        [
            'visaTypeId.required'     => 'Visa Type Field is required',
            'visaTypeId.exists'       => 'Visa Type Field is Invalid',
            'religion.required'       => "Religion Field must not be empty !!",
            'age.required'            => "Age Field is required !!",
            'submissionDate.required' => "Embassy Submission Field is required !!",
        ]);
    }
}