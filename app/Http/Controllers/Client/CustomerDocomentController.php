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

class CustomerDocomentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function document($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $customer_docs = Customer::where('userId', $userId)->find($id);
        $customer_documents = CustomerDocoment::latest()->where('userId','=',$userId) -> get();

        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){        
            if($customer_docs !== null && $customer_docs->value == 0){
                return view('admin.client.customer.document.document', [
                'customer_docs'=>$customer_docs,
                'customer_documents'=>$customer_documents,
            ]);
            }else{
                return redirect('/customer');
            }
        }else{
            return redirect('/customer');
        }
    }

    public function storeDocuments(Request $request, $id)
    {
        $this->validation($request);
        $userId = Auth::user()->id;
        $customer_docs = Customer::where('userId', $userId)->find($id);

        $customer_id = $customer_docs->id;

        $customer_documents = new CustomerDocoment();
        $customer_documents->customerId     = $customer_id;
        $customer_documents->tc             = $request->tc;
        $customer_documents->pc             = $request->pc;
        $customer_documents->license        = $request->license;
        $customer_documents->certificate    = $request->certificate;
        $customer_documents->finger         = $request->finger;
        $customer_documents->musaned        = $request->musaned;
        $customer_documents->userId         = $userId;
        $customer_documents->save();

        if($customer_documents){
            $customer_docs->value        = 1;
            $customer_docs->update();
            return redirect() -> back() -> with('message', 'Customer Document Info is added successfully');
        }
    }

    public function editDocs($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $customer_edit_docs = Customer::where('userId', $userId)->find($id);
        $docs_edit = CustomerDocoment::where('customerId', $id)->where('userId', $userId)->get();

        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){        
            if ($customer_edit_docs !== null) {
                return view('admin.client.customer.document.editDocs', [
                'customer_edit_docs'=>$customer_edit_docs,
                'docs_edit'=>$docs_edit,
                ]);
            }else{
                return redirect('/customer');
            }
        }else{
            return redirect('/customer');
        }
    }

    public function updateDocs(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $customer_edit_docs = Customer::where('userId', $userId)->find($id);
        $docs_edit = CustomerDocoment::where('customerId', $id)->where('userId', $userId)->first();
        $this->validation($request);

        if ($customer_edit_docs && $docs_edit) {
            $docs_edit->tc             = $request->tc;
            $docs_edit->pc             = $request->pc;
            $docs_edit->license        = $request->license;
            $docs_edit->certificate    = $request->certificate;
            $docs_edit->finger         = $request->finger;
            $docs_edit->musaned        = $request->musaned;
            $docs_edit->update();

            return redirect() -> back() -> with('message', 'Customer Document Info is Updated successfully');
        } else {
        return redirect()->back()->with('error_message', 'Customer or Document is not found');
        }
    }

    protected function validation($request){
        $this -> validate($request, [
            'customerId'     => 'unique:customer_docoments',
            'tc'             => 'required',
            'pc'             => 'required',
            'license'        => 'required',
            'certificate'    => 'required',
            'finger'         => 'required',
            'musaned'        => 'required',
        ],
        [
            'customerId.unique'     => 'Customer is already exist',
            'tc.required'           => 'Training Certificate Field must not be Empty',
            'pc.required'           => 'Police Clearance Certificate Field is required',
            'license.required'      => 'Driving License Field must not be Empty',
            'certificate.required'  => "Educational Certificate Field must not be empty !!",
            'finger.required'       => "Finger Print Field must not be empty !!",
            'musaned.required'      => "Musaned Field must not be empty !!",
        ]);
    }
}