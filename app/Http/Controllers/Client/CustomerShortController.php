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

class CustomerShortController extends Controller
{
    public function insertShort()
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
        return view('admin.client.customer.short.index', compact('all_customer'));
    }

    public function setDiv(Request $request)
    {
        $all_division = Division::where([
            'countryId'=>$request->country_id
        ])->where('status','=',1)->orderBy('divisionname', 'asc')->get();

        return view('admin.client.customer.short.ajax',[
            'all_division'=>$all_division,
        ]);
    }

    public function setDist(Request $request)
    {
        $all_district = District::where([
            'divisionId'=>$request->division_id,
            'countryId'=>$request->country_id
        ])->where('status','=',1)->orderBy('districtname', 'asc')->get();

        if (count($all_district)>0) {
            return view('admin.client.customer.short.ajax_district',[
                'all_district'=>$all_district,
            ]);
        }
    }

    public function setPs(Request $request)
    {
        $all_upzila = Policestation::where([
            'districtId'=>$request->district_id,
            'divisionId'=>$request->division_id,
            'countryId'=>$request->country_id
        ])->where('status','=',1)->orderBy('policestationname', 'asc')->get();

        if (count($all_upzila)>0) {
            return view('admin.client.customer.short.ajax_upzila',[
                'all_upzila'=>$all_upzila,
            ]);
        }
    }

    public function createShort(){
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $customer_data = Customer::latest()->where('userId','=',$userId) -> get();
        $customer_documents = CustomerDocoment::latest()->where('userId','=',$userId) -> get();
        $customer_passports = CustomerPassport::latest()->where('userId','=',$userId) -> get();
        $all_district = District::where('status', 1)->orderBy('districtname', 'asc')->get();
        $customer_embassy = CustomerEmbassy::latest()->where('userId','=',$userId) -> get();
        $all_visa = Visa::latest()->where('status','=',1)->where('userId','=',$userId) -> get();
        $visaCounts = [];
        foreach ($all_visa as $visa) {
            $visaId = $visa->id;
            $total_customer = CustomerEmbassy::where('visaId', $visaId)->where('userId', $userId)->count();
            $visaCounts[$visaId] = $total_customer;
        }

        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            return view('admin.client.customer.short.createShort', [
                'customer_data'=>$customer_data,
                'customer_documents'=>$customer_documents,
                'customer_passports'=>$customer_passports,
                'customer_embassy'=>$customer_embassy,
                'all_district'=>$all_district,
                'all_visa'=>$all_visa,
                'visaCounts'=>$visaCounts,
            ]);
        }else{
            return redirect('/customer/insertShort');
        }
    }

    public function storeShort(Request $request){
        $userId = Auth::user()->id;
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
        $this->validation($request);
        $tday = new DateTime(date('Y-m-d'));

        $barcodeData = $request->passportNo;
        $color = [0, 0, 0];
        $generator = new BarcodeGeneratorPNG();
        $barcodeImage = $generator->getBarcode($barcodeData, $generator::TYPE_CODE_128, 3, 50, $color);
        $file_ext = strtolower($request->passportNo);
        $barcodeFilename = substr(md5(time() . rand()), 0, 10) .'.'.$file_ext. '.png';
        $barcodePath = public_path('admin/uploads/passcode/') . $barcodeFilename;
        file_put_contents($barcodePath, $barcodeImage);

        $dob = $request->dateOfBirth;
        $bday = new DateTime($dob);
        $subdate = $request->submissionDate;
        $sdate = new DateTime($subdate);
        $diff = $sdate->diff($bday);
        $ageYears = $diff->y;
        $ageMonths = $diff->m;
        $ageDays = $diff->d;
        $yearLabel = ($ageYears == 1) ? 'year' : 'years';
        $monthLabel = ($ageMonths == 1) ? 'month' : 'months';
        $dayLabel = ($ageDays == 1) ? 'day' : 'days';
        $ageResult = $ageYears . ' ' . $yearLabel . ' ' . $ageMonths . ' ' . $monthLabel . ' ' . $ageDays . ' ' . $dayLabel;

        $issueDate = new \DateTime($request->passportIssue);
        $expiryDate = clone $issueDate;
        $expiryDate->modify('+' . $request->passportType . ' years');
        $expiryDate->modify('-1 day');
        $expiryDateFormatted = $expiryDate->format('Y-m-d');

        if (count($customer_data) > 0) {
            $customer = Customer::create([
            'customersl'    => $request->customersl,
            'cusFname'      => $request->cusFname,
            'cusLname'      => $request->cusLname,
            'gender'        => $request->gender,
            'passportNo'    => $request->passportNo,
            'passport_img'  => $barcodeFilename,
            'birthPlace'    => $request->birthPlace,
            'medical'       => 2,
            'received'      => $tday,
            'status'        => 1,
            'value'         => 3,
            'medical_update' => 1,
            'userId'        => Auth::user()->id,
            
        ]);
            $customer_id = $customer->id;
            DB::beginTransaction();
            try {
                $customer_documents = new CustomerDocoment();
                $customer_documents->customerId = $customer_id;
                $customer_documents->tc          = "N/A";
                $customer_documents->pc          = $request->pc;
                $customer_documents->license     = "N/A";
                $customer_documents->certificate = "N/A";
                $customer_documents->finger      = "N/A";
                $customer_documents->musaned     = $request->musaned;
                $customer_documents->userId      = $userId;
                $customer_documents->save();

                $customer_passports = new CustomerPassport();
                $customer_passports->customerId = $customer_id;
                $customer_passports->father         = $request->father;
                $customer_passports->mother         = $request->mother;
                $customer_passports->spouse         = $request->spouse;
                $customer_passports->passportIssue  = $request->passportIssue;
                $customer_passports->passportType   = $request->passportType;
                $customer_passports->passportExpiry = $expiryDateFormatted;
                $customer_passports->dateOfBirth    = $request->dateOfBirth;
                $customer_passports->maritalStatus  = $request->maritalStatus;
                $customer_passports->userId         = $userId;
                $customer_passports->save();

                $customer_embassy = new CustomerEmbassy();
                $customer_embassy->customerId = $customer_id;
                $customer_embassy->mofa           = $request->mofa;
                $customer_embassy->visaId         = $request->visaId;
                $customer_embassy->religion       = $request->religion;
                $customer_embassy->age            = $ageResult;
                $customer_embassy->submissionDate = $request->submissionDate;
                $customer_embassy->userId         = $userId;
                $customer_embassy->save();

                DB::commit();

                return redirect()->back()->with('message', 'Customer and related data are added successfully');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error_message', 'Error: ' . $e->getMessage());
            }
        } else {
            $date = new DateTime();
            $currentYear = $date->format('Y');
            $customerSerial = "RLCUS" . $currentYear . "00001";
            $customer = Customer::create([
            'customersl'    => $customerSerial,
            'cusFname'      => $request->cusFname,
            'cusLname'      => $request->cusLname,
            'gender'        => $request->gender,
            'passportNo'    => $request->passportNo,
            'passport_img'  => $barcodeFilename,
            'birthPlace'    => $request->birthPlace,
            'medical'       => 2,
            'received'      => $tday,
            'status'        => 1,
            'value'         => 3,
            'medical_update' => 1,
            'userId'        => Auth::user()->id,
        ]);

        $customer_id = $customer->id;

        DB::beginTransaction();

        try {
            $customer_documents = new CustomerDocoment();
            $customer_documents->customerId = $customer_id;
            $customer_documents->tc          = "N/A";
            $customer_documents->pc          = $request->pc;
            $customer_documents->license     = "N/A";
            $customer_documents->certificate = "N/A";
            $customer_documents->finger      = "N/A";
            $customer_documents->musaned     = $request->musaned;
            $customer_documents->userId      = $userId;
            $customer_documents->save();

            $customer_passports = new CustomerPassport();
            $customer_passports->customerId = $customer_id;
            $customer_passports->father         = $request->father;
            $customer_passports->mother         = $request->mother;
            $customer_passports->spouse         = $request->spouse;
            $customer_passports->passportIssue  = $request->passportIssue;
            $customer_passports->passportType   = $request->passportType;
            $customer_passports->passportExpiry = $expiryDateFormatted;
            $customer_passports->dateOfBirth    = $request->dateOfBirth;
            $customer_passports->maritalStatus  = $request->maritalStatus;
            $customer_passports->userId         = $userId;
            $customer_passports->save();

            $customer_embassy = new CustomerEmbassy();
            $customer_embassy->customerId = $customer_id;
            $customer_embassy->mofa           = $request->mofa;
            $customer_embassy->visaId         = $request->visaId;
            $customer_embassy->religion       = $request->religion;
            $customer_embassy->age            = $ageResult;
            $customer_embassy->submissionDate = $request->submissionDate;
            $customer_embassy->userId         = $userId;
            $customer_embassy->save();
            DB::commit();

            return redirect()->back()->with('message', 'Customer and related data are added successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error_message', 'Error: ' . $e->getMessage());
        }
        return redirect() -> back() -> with('message', 'Customer is added successfully');
        }
    }

    public function editShort(string $id)
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
        $all_district = District::where('status', 1)->orderBy('districtname', 'asc')->get();

        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            if ($customer_data_info !== null) {
                return view('admin.client.customer.short.editShort', [
                'customer_data_info'=>$customer_data_info,
                'all_district'=>$all_district,
            ]);
            }else{
                return redirect('/customer');
            }
        }else{
            return redirect('/customer');
        }
    }

    public function updateShort(Request $request, string $id)
    {
        $userId = Auth::user()->id;
        $customer_data_info = Customer::where('userId', $userId)->find($id);
        $this->validationInfo($request);

        $customer_data_info->cusFname    = $request->cusFname;
        $customer_data_info->cusLname    = $request->cusLname;
        $customer_data_info->gender      = $request->gender;
        $customer_data_info->birthPlace  = $request->birthPlace;
        $customer_data_info->medical     = $request->medical;
        $customer_data_info->medical_update = $request->medical_update;
        $customer_data_info->status      = $request->status;
        $customer_data_info->update();

        return redirect() -> back() -> with('message', 'Customer Info is Updated with short successfully');
    }

    public function editInfoShort($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $customer_info_edit = Customer::where('userId', $userId)->find($id);
        $passport_edit = CustomerPassport::where('customerId', $id)->where('userId', $userId)->get();
        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){ 
            if ($customer_info_edit !== null) {
                return view('admin.client.customer.short.editInfoShort', [
                'customer_info_edit'=>$customer_info_edit,
                'passport_edit'=>$passport_edit,
                ]);
            }else{
                return redirect('/customer');
            }
        }else{
            return redirect('/customer');
        }
    }

    public function updateInfoShort(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $customer_info_edit = Customer::where('userId', $userId)->find($id);
        $passport_edit = CustomerPassport::where('customerId', $id)->where('userId', $userId)->first();
        $this->validationInfoShort($request);

        if ($customer_info_edit && $passport_edit) {
            $passport_edit->father         = $request->father;
            $passport_edit->mother         = $request->mother;
            $passport_edit->spouse         = $request->spouse;
            $passport_edit->passportIssue  = $request->passportIssue;
            $passport_edit->passportType   = $request->passportType;
            $passport_edit->passportExpiry = $request->passportExpiry;
            $passport_edit->dateOfBirth    = $request->dateOfBirth;
            $passport_edit->maritalStatus  = $request->maritalStatus;
            $passport_edit->update();

            return redirect() -> back() -> with('message', 'Customer Passport Info is Updated with short successfully');
        } else {
        return redirect()->back()->with('error_message', 'Customer or Passport Information is not found');
        }
    }

    public function editAddress($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $customer_address = Customer::where('userId', $userId)->find($id);
        $passport_address = CustomerPassport::where('customerId', $id)->where('userId', $userId)->get();
        $all_country = Country::where('status', 1)->orderBy('countryname', 'asc')->get();
        $all_division = Division::where('status', 1)->orderBy('divisionname', 'asc')->get();
        $all_district = District::where('status', 1)->orderBy('districtname', 'asc')->get();
        $all_upzila = Policestation::where('status', 1)->orderBy('policestationname', 'asc')->get();
        $all_issue = Issue::where('status', 1)->orderBy('issuePlace', 'asc')->get();
        if(Auth::check() && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){ 
            if ($customer_address !== null) {
                return view('admin.client.customer.short.editAddress', [
                'customer_address'=>$customer_address,
                'passport_address'=>$passport_address,
                'all_country'=>$all_country,
                'all_division'=>$all_division,
                'all_district'=>$all_district,
                'all_upzila'=>$all_upzila,
                'all_issue'=>$all_issue,
                ]);
            }else{
                return redirect('/customer');
            }
        }else{
            return redirect('/customer');
        }
    }

    public function updateAddress(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $customer_address = Customer::where('userId', $userId)->find($id);
        $passport_address = CustomerPassport::where('customerId', $id)->where('userId', $userId)->first();
        $this->validationAddress($request);

        if ($customer_address && $passport_address) {
            $passport_address->address        = $request->address;
            $passport_address->issuePlaceId   = $request->issuePlaceId;
            $passport_address->policestationId = $request->policestationId;
            $passport_address->districtId     = $request->districtId;
            $passport_address->divisionId     = $request->divisionId;
            $passport_address->countryId      = $request->countryId;
            $passport_address->update();

            return redirect() -> back() -> with('message', 'Customer Passport Info is Updated successfully');
        } else {
        return redirect()->back()->with('error_message', 'Customer or Passport Information is not found');
        }
    }

    protected function validation($request){
        $this -> validate($request, [
            'cusFname'      => 'required',
            'passportNo'    => 'required',
            'birthPlace'    => 'required|exists:districts,id',
            'gender'        => 'required|in:1,2,3',
            'musaned'        => 'required',
            'father'         => 'required',
            'mother'         => 'required',
            'spouse'         => 'required',
            'passportType'   => 'required|in:5,10',
            'passportIssue'  => 'required|date',
            'dateOfBirth'    => 'required|date',
            'maritalStatus'  => 'required|in:1,2',
            'mofa'           => 'required|unique:customer_embassies',
            'visaId'         => 'required|exists:visas,id',
            'religion'       => 'required',
            'submissionDate' => 'required|date',
        ],
        [
            'cusFname.required'   => 'Customer First Name Field is required',
            'passportNo.required' => "Passport Number Field must not be empty !!",
            'passportNo.unique'   => "Passport Number is Already Exist !!",
            'birthPlace.required' => "Place of Birth Field must not be empty !!",
            'birthPlace.exists'   => "Invalid Place of Birth Field !!",
            'gender.required'     => 'Gender Field is required',
            'gender.in'           => 'Invalid Gender option selected',
            'musaned.required'    => "Musaned Field must not be empty !!",
            'father.required'        => 'Father Name Field must not be Empty',
            'mother.required'        => 'Mother Name Field is required',
            'spouse.required'        => 'Spouse Name Field is required',
            'passportType.required' => "Passport Type Field is required !!",
            'passportType.in'       => "Passport Type selection is invalid !!",
            'passportIssue.required' => "Passport Issue Date is required !!",
            'dateOfBirth.required'   => "Date of Birth Field is required !!",
            'maritalStatus.required' => "Marital Status Field is required !!",
            'maritalStatus.in'       => "Marital Status selection is invalid !!",
            'mofa.unique'            => 'Mofa Number is already exist',
            'mofa.required'          => 'Mofa Number Field must not be Empty',
            'visaId.required'        => 'Visa Info Field is required',
            'visaId.exists'          => 'Invalid Visa Info Field',
            'religion.required'      => "Religion Field must not be empty !!",
            'submissionDate.required' => "Embassy Submission Field is required !!",
        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'cusFname'      => 'required',
            'birthPlace'    => 'required|exists:districts,id',
            'status'        => 'required|in:1,0',
            'gender'        => 'required|in:1,2,3',
            'medical'       => 'required|in:1,2,3,4,5',
            'medical_update' => 'required|in:0,1',
        ],
        [
            'cusFname.required'   => 'Customer First Name Field is required',
            'birthPlace.required' => "Place of Birth Field must not be empty !!",
            'birthPlace.exists'   => "Invalid Place of Birth Field !!",
            'status.required'     => 'Status Field is required',
            'status.in'           => 'Invalid status option selected',
            'gender.required'     => 'Gender Field is required',
            'gender.in'           => 'Invalid Gender option selected',
            'medical.required'    => 'Medical Field is required',
            'medical.in'          => 'Invalid Medical option selected',
            'medical_update.required' => 'Medical Update Field is required',
            'medical_update.in'       => 'Invalid Medical Update option selected',
        ]);
    }

    protected function validationInfoShort($request){
        $this -> validate($request, [
            'customerId'        => 'unique:customer_passports',
            'father'            => 'required',
            'mother'            => 'required',
            'spouse'            => 'required',
            'passportIssue'     => 'required|date',
            'passportExpiry'    => 'required|date',
            'passportType'      => 'required|in:5,10',
            'dateOfBirth'       => 'required|date',
            'maritalStatus'     => 'required|in:1,2',
        ],
        [
            'customerId.unique'      => 'Customer is already exist',
            'father.required'        => 'Father Name Field must not be Empty',
            'mother.required'        => 'Mother Name Field is required',
            'spouse.required'        => 'Spouse Name Field is required',
            'passportIssue.required' => "Passport Issue Date is required !!",
            'passportExpiry.required' => "Passport Expiry Date Field must not be empty !!",
            'passportType.required' => "Passport Type Field is required !!",
            'passportType.in'       => "Passport Type selection is invalid !!",
            'dateOfBirth.required'   => "Date of Birth Field is required !!",
            'maritalStatus.required' => "Marital Status Field is required !!",
            'maritalStatus.in'       => "Marital Status selection is invalid !!",
        ]);
    }

    protected function validationAddress($request){
        $this -> validate($request, [
            'customerId'        => 'unique:customer_passports',
            'address'           => 'required',
            'issuePlaceId'      => 'required|exists:issues,id',
            'policestationId'   => 'required|exists:policestations,id',
            'districtId'        => 'required|exists:districts,id',
            'divisionId'        => 'required|exists:divisions,id',
            'countryId'         => 'required|exists:countries,id',
        ],
        [
            'customerId.unique'      => 'Customer is already exist',
            'address.required'       => "Address Field is required !!",
            'issuePlaceId.required'  => "Passport Issue Place Field is required !!",
            'issuePlaceId.exists'    => "Passport Issue Place Field is Invalid !!",
            'policestationId.required' => "Police Station Field is required !!",
            'policestationId.exists' => "Invalid Police Station Field !!",
            'districtId.required'    => "District Field is required !!",
            'districtId.exists'      => "Invalid District Field !!",
            'divisionId.required'    => "Division Field is required !!",
            'divisionId.exists'      => "Invalid Division Field !!",
            'countryId.required'     => "Country Field is required !!",
            'countryId.exists'       => "Invalid Country Field !!",
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
}