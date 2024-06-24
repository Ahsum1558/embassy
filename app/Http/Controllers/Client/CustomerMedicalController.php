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
use App\Models\Country;
use App\Models\Division;
use App\Models\District;
use App\Models\Policestation;
use App\Models\Issue;
use App\Models\City;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
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

class CustomerMedicalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function medical()
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $all_medical_none = $this->getInfo()->where('medical','=',4)->where('userId', $userId);
        $all_medical_done = $this->getInfo()->where('medical','=',1)->where('userId', $userId);
        $all_medical_fit = $this->getInfo()->where('medical','=',2)->where('userId', $userId);
        $all_medical_unfit = $this->getInfo()->where('medical','=',3)->where('userId', $userId);
        $all_medical_problem = $this->getInfo()->where('medical','=',5)->where('userId', $userId);
        $all_medical_update = $this->getInfo()->where('medical','=',2)->where('medical_update','=',1)->where('userId', $userId);

        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            return view('admin.client.customer.medical.medical', [
                'all_medical_none'=>$all_medical_none,
                'all_medical_done'=>$all_medical_done,
                'all_medical_fit'=>$all_medical_fit,
                'all_medical_unfit'=>$all_medical_unfit,
                'all_medical_problem'=>$all_medical_problem,
                'all_medical_update'=>$all_medical_update,
            ]);
        }else{
            return redirect('/customer/medical');
        }
    }

    public function editMedical($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $customer_medical = Customer::where('userId', $userId)->find($id);

        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){        
            if ($customer_medical !== null) {
                return view('admin.client.customer.medical.editMedical', compact('customer_medical'));
            }else{
                return redirect('/customer/medical');
            }
        }else{
            return redirect('/customer/medical');
        }
    }

    public function updateMedical(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $customer_medical = Customer::where('userId', $userId)->find($id);
        $this -> validate($request, [
            'medical'           => 'required|in:1,2,3,4,5',
            'medical_update'    => 'required|in:0,1',
        ],
        [
            'medical.required'    => 'Medical Field is required',
            'medical.in'          => 'Invalid Medical option selected',
            'medical_update.required' => 'Medical Update Field is required',
            'medical_update.in'       => 'Invalid Medical Update option selected',

        ]);

        $customer_medical->medical        = $request->medical;
        $customer_medical->medical_update = $request->medical_update;
        $customer_medical->update();

        return redirect() -> back() -> with('message', 'Customer Medical Info is Updated successfully');
    }

    protected function getInfo(){
        $data_info = DB::table('customers')
            ->leftJoin('delegates', 'customers.agentId', '=', 'delegates.id')
            ->leftJoin('districts', 'customers.birthPlace', '=', 'districts.id')
            ->leftJoin('visatrades', 'customers.tradeId', '=', 'visatrades.id')
            ->leftJoin('users', 'customers.userId', '=', 'users.id')
            ->select('customers.*', 'delegates.agentname', 'delegates.agentsl', 'delegates.agentbook', 'districts.districtname', 'visatrades.visatrade_name', 'users.name as receiver')
            ->orderBy('customers.customersl', 'desc')
            ->get();
        return $data_info;
    }
}