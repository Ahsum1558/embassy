<?php

namespace App\Http\Controllers\Visa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visa;
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
use Milon\Barcode\DNS1D;
use Illuminate\Support\Facades\File;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\View\View;

class VisaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $all_visa = Visa::latest()->where('userId','=',$userId) -> get();
        $visaCounts = [];
        foreach ($all_visa as $visa) {
            $visaId = $visa->id;
            $total_customer = CustomerEmbassy::where('visaId', $visaId)->where('userId', $userId)->count();
            $visaCounts[$visaId] = $total_customer;
        }
         return view('admin.visa.visainfo.index', compact('all_visa', 'visaCounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $visa_data = Visa::latest()->where('userId','=',$userId) -> get();
        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            return view('admin.visa.visainfo.create', compact('visa_data'));
        } else {
            return redirect('/visa');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $existingRecord = Visa::where([
            'visano_en'=>$request->visano_en,
            'visano_ar'=>$request->visano_ar,
            'occupation_ar'=>$request->occupation_ar,
            'occupation_en'=>$request->occupation_en,
            'delegation_no'=>$request->delegation_no,
            'userId'=>$userId,
        ])->first();
        if (!$existingRecord){
        $this->validation($request);

        $barcodeData = $request->visano_en;
        $color = [0, 0, 0];
        $generator = new BarcodeGeneratorPNG();
        $barcodeImage = $generator->getBarcode($barcodeData, $generator::TYPE_CODE_128, 3, 50, $color);
        // $barcodeImage = $generator->getBarcode($barcodeData, $generator::TYPE_CODE_39, 3, 50, $color);

        $file_ext = strtolower($request->visano_en);

        $barcodeFilename = substr(md5(time() . rand()), 0, 10) .'.'.$file_ext. '.png';
        $barcodePath = public_path('admin/uploads/barcode/') . $barcodeFilename;
        file_put_contents($barcodePath, $barcodeImage);

        Visa::create([
            'visano_en'         => $request->visano_en,
            'visano_img'        => $barcodeFilename,
            'visano_ar'         => $request->visano_ar,
            'sponsorid_en'      => $request->sponsorid_en,
            'sponsorid_ar'      => $request->sponsorid_ar,
            'sponsorname_en'    => $request->sponsorname_en,
            'sponsorname_ar'    => $request->sponsorname_ar,
            'visa_date'         => $request->visa_date,
            'visa_address'      => $request->visa_address,
            'occupation_en'     => $request->occupation_en,
            'occupation_ar'     => $request->occupation_ar,
            'delegation_no'     => $request->delegation_no,
            'delegation_date'   => $request->delegation_date,
            'delegated_visa'    => $request->delegated_visa,
            'visa_duration'     => $request->visa_duration,
            'status'            => $request->status,
            'userId'            => $userId,
        ]);
        
        return redirect() -> back() -> with('message', 'Visa is added successfully');
        }else{
            return redirect() -> back() -> with('error_message', 'Visa no is already exist in the table !');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $single_visa = Visa::where('userId', $userId)->find($id);
        $customer_data = $this->getVisaCustomers($id)->where('userId', $userId);

        if ($single_visa !== null) {
            $visaCounts = [];

            $visaId = $single_visa->id;
            $total_customer = CustomerEmbassy::where('visaId', $id)->where('userId', $userId)->count();
            $visaCounts[$visaId] = $total_customer;

            return view('admin.visa.visainfo.show', [
            'single_visa'=>$single_visa,
            'visaCounts'=>$visaCounts,
            'customer_data'=>$customer_data,
            ]);
        } else {
            return redirect('/visa');
        }
    }


    // public function show(string $id)
    // {
        // if(strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))){
        //     return redirect('/');
        // }
    //     $userId = Auth::user()->id;
    //     $singleVisa = Visa::where('userId', $userId)->find($id);
    //     if ($singleVisa !== null) {
    //         $customerData = $this->getVisaCustomers($id)->where('userId', $userId);
    //         $totalCustomer = CustomerEmbassy::where('visaId', $id)->count();
    //         $visaCounts = [
    //             $id => $totalCustomer
    //         ];

    //         return view('admin.visa.visainfo.show', compact('singleVisa', 'visaCounts', 'customerData'));
    //     } else {
    //         return redirect('/visa');
    //     }
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $visa_data = Visa::where('userId', $userId)->find($id);

        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            if ($visa_data !== null) {
                return view('admin.visa.visainfo.edit', compact('visa_data'));
            }else{
                return redirect('/visa');
            }
        }else{
            return redirect('/visa');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userId = Auth::user()->id;
        $visa_data = Visa::where('userId', $userId)->find($id);
        $this->validationInfo($request);

        $visa_data->sponsorid_en    = $request->sponsorid_en;
        $visa_data->sponsorid_ar    = $request->sponsorid_ar;
        $visa_data->sponsorname_en  = $request->sponsorname_en;
        $visa_data->sponsorname_ar  = $request->sponsorname_ar;
        $visa_data->visa_date       = $request->visa_date;
        $visa_data->visa_address    = $request->visa_address;
        $visa_data->delegation_date = $request->delegation_date;
        $visa_data->delegated_visa  = $request->delegated_visa;
        $visa_data->visa_duration   = $request->visa_duration;
        $visa_data->status          = $request->status;
        $visa_data->update();

        return back()->with('message', 'The Visa Info is Updated Successfully');
    }

    // public function update(Request $request, string $id)
    // {
        // if(strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))){
        //     return redirect('/');
        // }
    //     $userId = Auth::user()->id;
    //     $visaData = Visa::where('userId', $userId)->find($id);
    //     if ($visaData !== null) {
    //         $this->validationInfo($request);
    //         $visaData->update([
    //             'sponsorid_en' => $request->sponsorid_en,
    //             'sponsorid_ar' => $request->sponsorid_ar,
    //             'sponsorname_en' => $request->sponsorname_en,
    //             'sponsorname_ar' => $request->sponsorname_ar,
    //             'visa_date' => $request->visa_date,
    //             'visa_address' => $request->visa_address,
    //             'delegation_date' => $request->delegation_date,
    //             'delegated_visa' => $request->delegated_visa,
    //             'visa_duration' => $request->visa_duration,
    //             'status' => $request->status,
    //         ]);

    //         return back()->with('message', 'The Visa Info is Updated Successfully');
    //     } else {
    //         return redirect('/visa');
    //     }
    // }

    public function editVisa(string $id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $visaNo_data = Visa::where('userId', $userId)->find($id);

        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            if ($visaNo_data !== null) {
                return view('admin.visa.visainfo.editVisa', compact('visaNo_data'));
            }else{
                return redirect('/visa');
            }
        }else{
            return redirect('/visa');
        }
    }

    public function updateVisa(Request $request, string $id)
    {
        $userId = Auth::user()->id;
        $visaNo_data = Visa::where('userId', $userId)->find($id);
        $existingRecord = Visa::where([
            'visano_en'=>$request->visano_en,
            'visano_ar'=>$request->visano_ar,
            'occupation_ar'=>$request->occupation_ar,
            'occupation_en'=>$request->occupation_en,
            'delegation_no'=>$request->delegation_no,
            'userId'=>$userId,
        ])->first();
        if (!$existingRecord){
        $this->validationVisa($request);

        if (File::exists(public_path('admin/uploads/barcode/' . $visaNo_data->visano_img))) {
            File::delete(public_path('admin/uploads/barcode/' . $visaNo_data->visano_img));
        }

        $barcodeData = $request->visano_en;
        $color = [0, 0, 0];
        $generator = new BarcodeGeneratorPNG();
        $barcodeImage = $generator->getBarcode($barcodeData, $generator::TYPE_CODE_128, 3, 50, $color);

        $file_ext = strtolower($request->visano_en);

        $barcodeFilename = substr(md5(time() . rand()), 0, 10) .'.'.$file_ext. '.png';
        $barcodePath = public_path('admin/uploads/barcode/') . $barcodeFilename;
        file_put_contents($barcodePath, $barcodeImage);

        $visaNo_data->visano_img = $barcodeFilename;
        $visaNo_data->visano_en = $request->visano_en;
        $visaNo_data->visano_ar = $request->visano_ar;
        $visaNo_data->occupation_ar = $request->occupation_ar;
        $visaNo_data->occupation_en = $request->occupation_en;
        $visaNo_data->delegation_no = $request->delegation_no;
        $visaNo_data->update();

        return back()->with('message', 'The Visa Number is Updated Successfully');
        }else{
            return redirect() -> back() -> with('error_message', 'Visa no is already exist in the table !');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $data_visa = Visa::where('userId', $userId)->find($id);
        if (File::exists(public_path('admin/uploads/barcode/' . $data_visa->visano_img))) {
            File::delete(public_path('admin/uploads/barcode/' . $data_visa->visano_img));
        }
        $data_visa -> delete();

        return redirect() -> back() -> with('message', 'The Visa is deleted successfully');
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
        $Visa_inactive = Visa::where('userId', $userId)->find($id);
        $Visa_inactive->status   = 0;
        $Visa_inactive->update();              

        return redirect('/visa')->with('message', 'The Visa is Inactive Successfully');
    }

    // public function inactive($id)
    // {
    //     $userId = Auth::user()->id;
    //     $visaInactive = Visa::where('userId', $userId)->find($id);
    //     if ($visaInactive !== null) {
    //         $visaInactive->status = 0;
    //         $visaInactive->save();
    //         return redirect('/visa')->with('message', 'The Visa has been set to inactive successfully');
    //     } else {
    //         return redirect('/visa');
    //     }
    // }

    
    public function active($id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $visa_active = Visa::where('userId', $userId)->find($id);
        $visa_active->status   = 1;
        $visa_active->update();              

        return redirect('/visa')->with('message', 'The Visa is Active Successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'visano_en'         => 'required',
            'visano_ar'         => 'required',
            'sponsorid_en'      => 'required',
            'sponsorid_ar'      => 'required',
            'sponsorname_en'    => 'required',
            'sponsorname_ar'    => 'required',
            'visa_date'         => 'required',
            'visa_address'      => 'required',
            'occupation_en'     => 'required',
            'occupation_ar'     => 'required',
            'delegation_no'     => 'required',
            'delegation_date'   => 'required|date',
            'delegated_visa'    => 'required',
            'visa_duration'     => 'required',
            'status'            => 'required|in:1,0',
        ],
        [
            'visano_en.required' => 'Visa No. Field must not be Empty',
            'visano_ar.required' => 'Visa No. Arabic Field is required',
            'sponsorid_en.required'     => 'Sponsor Id No. Field must not be Empty',
            'sponsorid_ar.required'     => 'Sponsor Id No. Arabic Field must not be Empty',
            'sponsorname_en.required'   => 'Sponsor Name Field must not be Empty',
            'sponsorname_ar.required'   => 'Sponsor Name Arabic Field is required',
            'visa_date.required'        => 'Visa date in Hijri Field must not be Empty',
            'visa_address.required'     => 'Visa Address Field is required',
            'occupation_en.required'    => 'Occupation Field must not be Empty',
            'occupation_ar.required'    => 'Occupation Arabic Field must not be Empty',
            'delegation_no.required'    => 'Visa Delegation No. Field must not be Empty',
            'delegation_date.required'  => 'Visa Delegation Date Field is required',
            'delegated_visa.required'   => 'Total Delegated visa count Field must not be Empty',
            'visa_duration.required'    => 'Visa Duration Field is required',
            'status.required'           => 'Status Field is required',
            'status.in'                 => 'Invalid status option selected',
        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'sponsorid_en'      => 'required',
            'sponsorid_ar'      => 'required',
            'sponsorname_en'    => 'required',
            'sponsorname_ar'    => 'required',
            'visa_date'         => 'required',
            'visa_address'      => 'required',
            'delegation_date'   => 'required|date',
            'delegated_visa'    => 'required',
            'visa_duration'     => 'required',
            'status'            => 'required|in:1,0',
        ],
        [
            'sponsorid_en.required'     => 'Sponsor Id No. Field must not be Empty',
            'sponsorid_ar.required'     => 'Sponsor Id No. Arabic Field must not be Empty',
            'sponsorname_en.required'   => 'Sponsor Name Field must not be Empty',
            'sponsorname_ar.required'   => 'Sponsor Name Arabic Field is required',
            'visa_date.required'        => 'Visa date in Hijri Field must not be Empty',
            'visa_address.required'     => 'Visa Address Field is required',
            'delegation_date.required'  => 'Visa Delegation Date Field is required',
            'delegated_visa.required'   => 'Total Delegated visa count Field must not be Empty',
            'visa_duration.required'    => 'Visa Duration Field is required',
            'status.required'           => 'Status Field is required',
            'status.in'                 => 'Invalid status option selected',
        ]);
    }

    protected function validationVisa($request){
        $this -> validate($request, [
            'visano_en'       => 'required',
            'visano_ar'       => 'required',
            'delegation_no'   => 'required',
            'occupation_en'   => 'required',
            'occupation_ar'   => 'required',
        ],
        [
            'visano_en.required' => 'Visa No. Field must not be Empty',
            'visano_ar.required' => 'Visa No. Arabic Field must not be Empty',
            'delegation_no.required'    => 'Visa Delegation No. Field must not be Empty',
            'occupation_en.required'    => 'Occupation Field must not be Empty',
            'occupation_ar.required'    => 'Occupation Arabic Field must not be Empty',
        ]);
    }

    protected function getVisaCustomers($id){
        $data_details = DB::table('customers')
            ->where('customer_embassies.visaId', $id)
            ->leftJoin('customer_embassies', 'customers.id', '=', 'customer_embassies.customerId')
            ->leftJoin('submission_customers', 'customers.id', '=', 'submission_customers.customerId')
            ->leftJoin('visas', 'customer_embassies.visaId', '=', 'visas.id')
            ->leftJoin('delegates', 'customers.agentId', '=', 'delegates.id')
            ->leftJoin('districts', 'customers.birthPlace', '=', 'districts.id')
            ->leftJoin('countries', 'customers.countryFor', '=', 'countries.id')
            ->leftJoin('visatrades', 'customers.tradeId', '=', 'visatrades.id')
            ->leftJoin('users', 'customers.userId', '=', 'users.id')
            ->select('customers.*', 'delegates.agentname', 'delegates.agentsl', 'delegates.agentbook', 'districts.districtname', 'visatrades.visatrade_name', 'users.name as receiver', 'countries.countryname as destination_country')
            ->get();
        return $data_details;
    }
}