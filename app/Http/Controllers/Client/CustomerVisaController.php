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
use App\Models\CustomerManpower;
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

class CustomerVisaController extends Controller
{
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
                return view('admin.client.customer.stamping.stampingVisa', [
                'data_stamped_customer'=>$data_stamped_customer,
                'customer_stamping'=>$customer_stamping,
                'all_country'=>$all_country,
            ]);
            }else{
                return redirect('/customer');
            }
        }else{
            return redirect('/customer');
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
            $this->validation($request);
            $customer_id = $data_stamped_customer->id;

            $customer_stamping = new CustomerVisa();
            $customer_stamping->customerId     = $customer_id;
            $customer_stamping->stamped_visano = $request->stamped_visano;
            $customer_stamping->visa_issue     = $request->visa_issue;
            $customer_stamping->visa_expiry    = $request->visa_expiry;
            $customer_stamping->stay_duration  = $request->stay_duration;
            $customer_stamping->countryId      = $request->countryId;
            $customer_stamping->userId         = $userId;
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

    public function editStamping($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $customer_stamping_info = Customer::where('userId', $userId)->find($id);
        $stamping_edit = CustomerVisa::latest()->where('userId','=',$userId) -> get();
        $all_country = Country::where('status', 1)->orderBy('countryname', 'asc')->get();
        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){         
            if ($customer_stamping_info !== null) {
                return view('admin.client.customer.stamping.editStamping', [
                'customer_stamping_info'=>$customer_stamping_info,
                'stamping_edit'=>$stamping_edit,
                'all_country'=>$all_country,
                ]);
            }else{
                return redirect('/customer');
            }
        }else{
            return redirect('/customer');
        }
    }

    public function updateStamping(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $customer_stamping_info = Customer::where('userId', $userId)->find($id);
        $stamping_edit = CustomerVisa::where('customerId', $id)->where('userId', $userId)->first();
        $this->validationInfo($request);

        if ($customer_stamping_info && $stamping_edit) {
            $stamping_edit->visa_issue      = $request->visa_issue;
            $stamping_edit->visa_expiry     = $request->visa_expiry;
            $stamping_edit->stay_duration   = $request->stay_duration;
            $stamping_edit->countryId       = $request->countryId;
            $stamping_edit->update();

            return redirect() -> back() -> with('message', 'Customer Visa Stamping Info is Updated successfully');
        } else {
        return redirect()->back()->with('error_message', 'Customer or Customer Visa Stamping Info is not found');
        }
    }

    public function editVisano($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $customer_stamping_visa = Customer::where('userId', $userId)->find($id);
        $stamped_visano_edit = CustomerVisa::latest()->where('userId','=',$userId) -> get();
        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            if ($customer_stamping_visa !== null) {
                return view('admin.client.customer.stamping.editVisano', [
                'customer_stamping_visa'=>$customer_stamping_visa,
                'stamped_visano_edit'=>$stamped_visano_edit,
                ]);
            }else{
                return redirect('/customer');
            }
        }else{
            return redirect('/customer');
        }
    }

    public function updateVisano(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $customer_stamping_visa = Customer::where('userId', $userId)->find($id);
        $stamped_visano_edit = CustomerVisa::where('customerId', $id)->where('userId', $userId)->first();
        $existingRecord = CustomerVisa::where([
            'stamped_visano'=>$request->stamped_visano,
            'userId'=>$userId,
        ])->first();
        if (!$existingRecord){
        $this -> validate($request, [
            'stamped_visano'    => 'required',
        ],
        [
            'stamped_visano.required' => 'Stamped Visa Number Field must not be Empty',
        ]);

        if ($customer_stamping_visa && $stamped_visano_edit) {
            $stamped_visano_edit->stamped_visano = $request->stamped_visano;
            $stamped_visano_edit->update();

            return redirect() -> back() -> with('message', 'Customer Stamped Visa Number is Updated successfully');
        } else {
        return redirect()->back()->with('error_message', 'Customer or Customer Stamped Visa Number is not found');
        }
        }else{
            return redirect()->back()->with('error_message', 'Customer Stamped Visa Number is already exists in the table!');
        }
    }

    protected function validation($request){
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
            'stamped_visano.required' => 'Stamped Visa Number Field must not be Empty',
            'stay_duration.required'  => 'Stay Duration Field is required',
            'visa_issue.required'     => 'Visa Issue Date Field is required',
            'visa_expiry.required'    => "Visa Expiry Date Field is required !!",
            'countryId.required'      => "Country Field is required !!",
            'countryId.exists'        => "Invalid Country Field !!",
        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'stay_duration'     => 'required',
            'visa_issue'        => 'required|date',
            'visa_expiry'       => 'required|date',
            'countryId'         => 'required|exists:countries,id',
        ],
        [
            'stay_duration.required' => 'Stay Duration Field is required',
            'visa_issue.required'    => 'Visa Issue Date Field is required',
            'visa_expiry.required'   => "Visa Expiry Date Field is required !!",
            'countryId.required'     => "Country Field is required !!",
            'countryId.exists'       => "Invalid Country Field !!",
        ]);
    }
}