<?php

namespace App\Http\Controllers\Manpower;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\File;
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
use App\Models\Field;
use App\Models\Visa;
use App\Models\Visatype;
use App\Models\Submission;
use App\Models\SubmissionCustomer;
use App\Models\ManpowerSubmission;
use App\Models\CustomerManpower;
use App\Models\BmetPayment;
use Mpdf\Utils\FontMetrics;
use Mpdf\Mpdf;
use App\Helpers\BarcodeHelper;
use App\Helpers\BanglaNumberConverter;
use App\Helpers\BanglaWordConverter;
use Rakibhstu\Banglanumber\NumberToBangla;
use Milon\Barcode\DNS1D;
use Picqer\Barcode\BarcodeGeneratorPNG;
use DateTime;
use Illuminate\Support\Carbon;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Spatie\PdfToText\Pdf;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\Html;
use DOMDocument;
use Symfony\Component\HttpFoundation\StreamedResponse;
use PhpOffice\PhpWord\Element\Section;
use PhpOffice\PhpWord\Shared\Converter;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\Style\Paragraph;


class ManpowerPdfController extends Controller
{
    public function printNotesheet($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $numto = new NumberToBangla();
        $mpdf = $this->getMpdfHeader();
        $manpower_single_data = $this->getDetails($id)->where('userId', $userId);
        $manpower_customers = $this->getCustomersDetails($id)->where('userId', $userId)->where('status', '=', 1);
        $manpower_payment = BmetPayment::where('manpowerSubId', $id)->where('userId', $userId)->where('status', '=', 1)->get();
        $total_customer = CustomerManpower::where('manpowerSubId', $id)->where('userId', $userId)->count();
        
        if($manpower_single_data->count() > 0 && isset($manpower_single_data[0]) && $manpower_single_data[0]->status == 1){
            $license_expiry = date('d/m/Y', strtotime($manpower_single_data[0]->licenseExpiry));
            $output = view('admin.client.manpower.pdf.printNotesheet', [
            'manpower_single_data'=>$manpower_single_data,
            'manpower_customers'=>$manpower_customers,
            'manpower_payment'=>$manpower_payment,
            'numto'=>$numto,
            'total_customer'=>$total_customer,
            'license_expiry'=>$license_expiry,
        ])->render();
            $mpdf->WriteHTML($output);
            $filename = date('d-M-Y', strtotime($manpower_single_data[0]->manpowerDate)).'-Putup_list.pdf';
            $mpdf->Output($filename, 'I');
            exit;
        }else{
            return redirect('/manpower');
        }
    }

    public function printContact($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $numto = new NumberToBangla();
        $mpdf = $this->getMpdfHeader();
        $manpower_customers = $this->getCustomersInfo($id)->where('userId', $userId)->where('status', '=', 1);
        if($manpower_customers->count() > 0 && isset($manpower_customers[0]) && $manpower_customers[0]->status == 1){
            $output = view('admin.client.manpower.pdf.printContact', [
            'manpower_customers'=>$manpower_customers,
            'numto'=>$numto,
        ])->render();
            $mpdf->WriteHTML($output);
            $filename = $manpower_customers[0]->customersl.'-'.$manpower_customers[0]->cusFname.' '.$manpower_customers[0]->cusLname.'.pdf';
            $mpdf->Output($filename, 'I');
            exit;
        }else{
            return redirect('/manpower');
        }
    }

    public function printLetter($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $numto = new NumberToBangla();
        $mpdf = $this->getMpdfHeader();
        $manpower_data = $this->getDetails($id)->where('userId', $userId);
        $total_customer = CustomerManpower::where('manpowerSubId', $id)->where('userId', $userId)->count();
        if($manpower_data->count() > 0 && isset($manpower_data[0]) && $manpower_data[0]->status == 1){
            $license_expiry = date('d/m/Y', strtotime($manpower_data[0]->licenseExpiry));
            $output = view('admin.client.manpower.pdf.printLetter', [
            'manpower_data'=>$manpower_data,
            'numto'=>$numto,
            'total_customer'=>$total_customer,
            'license_expiry'=>$license_expiry,
        ])->render();
            $mpdf->WriteHTML($output);
            $filename = date('d-M-Y', strtotime($manpower_data[0]->manpowerDate)).'-Application.pdf';
            $mpdf->Output($filename, 'I');
            exit;
        }else{
            return redirect('/manpower');
        }
    }

    public function printUndertaking($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $numto = new NumberToBangla();
        $mpdf = $this->getMpdfHeaderLegal();
        $manpower_undertaking = $this->getDetails($id)->where('userId', $userId);
        $manpower_customers = $this->getCustomersDetails($id)->where('userId', $userId)->where('status', '=', 1);
        $manpower_payment = BmetPayment::where('manpowerSubId', $id)->where('userId', $userId)->where('status', '=', 1)->get();
        $total_customer = CustomerManpower::where('manpowerSubId', $id)->where('userId', $userId)->count();
        if($manpower_undertaking->count() > 0 && isset($manpower_undertaking[0]) && $manpower_undertaking[0]->status == 1){
             $license_expiry = date('d/m/Y', strtotime($manpower_undertaking[0]->licenseExpiry));
            $output = view('admin.client.manpower.pdf.printUndertaking', [
            'manpower_undertaking'=>$manpower_undertaking,
            'manpower_customers'=>$manpower_customers,
            'manpower_payment'=>$manpower_payment,
            'numto'=>$numto,
            'total_customer'=>$total_customer,
            'license_expiry'=>$license_expiry,
        ])->render();
            $mpdf->WriteHTML($output);
            $filename = date('d-M-Y', strtotime($manpower_undertaking[0]->manpowerDate)).'-Undertaking.pdf';
            $mpdf->Output($filename, 'I');
            exit;
        }else{
            return redirect('/manpower');
        }
    }

    public function printData($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $numto = new NumberToBangla();
        $mpdf = $this->getMpdfHeader();
        $customer_data = $this->getCustomersInfo($id)->where('userId', $userId)->where('status', '=', 1);
        $customer_passports = $this->getPassportDetails($id)->where('userId', $userId);
        $customer_stamping = $this->getStampingDetails($id);         
        if($customer_data->count() > 0 && isset($customer_data[0]) && $customer_data[0]->status == 1){
            $output = view('admin.client.manpower.pdf.printData', [
            'customer_data'=>$customer_data,
            'customer_passports'=>$customer_passports,
            'customer_stamping'=>$customer_stamping,
            'numto'=>$numto,
        ])->render();
            $mpdf->WriteHTML($output);
            $filename = $customer_data[0]->customersl.'-'.$customer_data[0]->cusFname.' '.$customer_data[0]->cusLname.'.pdf';
            $mpdf->Output($filename, 'I');
            exit;
        }else{
            return redirect('/manpower');
        }
    }

    public function printPutup($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $numto = new NumberToBangla();
        $mpdf = $this->getMpdfHeaderLegalLandscape();
        $manpower_single_data = $this->getDetails($id)->where('userId', $userId);
        $manpower_customers = $this->getCustomersDetails($id)->where('userId', $userId)->where('status', '=', 1);
        $manpower_payment = BmetPayment::where('manpowerSubId', $id)->where('userId', $userId)->where('status', '=', 1)->get();
        $total_customer = CustomerManpower::where('manpowerSubId', $id)->where('userId', $userId)->count();
        if($manpower_single_data->count() > 0 && isset($manpower_single_data[0]) && $manpower_single_data[0]->status == 1){
            $license_expiry = date('d/m/Y', strtotime($manpower_single_data[0]->licenseExpiry));
            $output = view('admin.client.manpower.pdf.printPutup', [
            'manpower_single_data'=>$manpower_single_data,
            'manpower_customers'=>$manpower_customers,
            'manpower_payment'=>$manpower_payment,
            'numto'=>$numto,
            'total_customer'=>$total_customer,
            'license_expiry'=>$license_expiry,
        ])->render();
            $mpdf->WriteHTML($output);
            $filename = date('d-M-Y', strtotime($manpower_single_data[0]->manpowerDate)).'-Putup_list.pdf';
            $mpdf->Output($filename, 'I');
            exit;
        }else{
            return redirect('/manpower');
        }
    }

    public function printPutupUpdate($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $numto = new NumberToBangla();
        $mpdf = $this->getMpdfHeaderLegalLandscape();
        $manpower_single_data = $this->getDetails($id)->where('userId', $userId);
        $manpower_customers = $this->getCustomersDetails($id)->where('userId', $userId)->where('status', '=', 1);
        $manpower_payment = BmetPayment::where('manpowerSubId', $id)->where('userId', $userId)->where('status', '=', 1)->get();
        $total_customer = CustomerManpower::where('manpowerSubId', $id)->where('userId', $userId)->count();        
        if($manpower_single_data->count() > 0 && isset($manpower_single_data[0]) && $manpower_single_data[0]->status == 1){
            $license_expiry = date('d/m/Y', strtotime($manpower_single_data[0]->licenseExpiry));
            $output = view('admin.client.manpower.pdf.printPutupUpdate', [
            'manpower_single_data'=>$manpower_single_data,
            'manpower_customers'=>$manpower_customers,
            'manpower_payment'=>$manpower_payment,
            'numto'=>$numto,
            'total_customer'=>$total_customer,
            'license_expiry'=>$license_expiry,
        ])->render();
            $mpdf->WriteHTML($output);
            $filename = date('d-M-Y', strtotime($manpower_single_data[0]->manpowerDate)).'-Putup_list.pdf';
            $mpdf->Output($filename, 'I');
            exit;
        }else{
            return redirect('/manpower');
        }
    }

    public function printNotesheetUpdate($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $numto = new NumberToBangla();
        $mpdf = $this->getMpdfHeader();
        $manpower_single_data = $this->getDetails($id)->where('userId', $userId);
        $manpower_customers = $this->getCustomersDetails($id)->where('userId', $userId)->where('status', '=', 1);
        $manpower_payment = BmetPayment::where('manpowerSubId', $id)->where('userId', $userId)->where('status', '=', 1)->get();
        $total_customer = CustomerManpower::where('manpowerSubId', $id)->where('userId', $userId)->count();
        if($manpower_single_data->count() > 0 && isset($manpower_single_data[0]) && $manpower_single_data[0]->status == 1){
            $license_expiry = date('d/m/Y', strtotime($manpower_single_data[0]->licenseExpiry));
            $output = view('admin.client.manpower.pdf.printNotesheetUpdate', [
            'manpower_single_data'=>$manpower_single_data,
            'manpower_customers'=>$manpower_customers,
            'manpower_payment'=>$manpower_payment,
            'numto'=>$numto,
            'total_customer'=>$total_customer,
            'license_expiry'=>$license_expiry,
        ])->render();
            $mpdf->WriteHTML($output);
            $filename = date('d-M-Y', strtotime($manpower_single_data[0]->manpowerDate)).'-Putup_list.pdf';
            $mpdf->Output($filename, 'I');
            exit;
        }else{
            return redirect('/manpower');
        }
    }

    public function printLetterUpdate($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $numto = new NumberToBangla();
        $mpdf = $this->getMpdfHeader();
        $manpower_data = $this->getDetails($id)->where('userId', $userId);
        $manpower_customers = $this->getCustomersDetails($id)->where('userId', $userId)->where('status', '=', 1);
        $total_customer = CustomerManpower::where('manpowerSubId', $id)->where('userId', $userId)->count();
        if($manpower_data->count() > 0 && isset($manpower_data[0]) && $manpower_data[0]->status == 1){
            $license_expiry = date('d/m/Y', strtotime($manpower_data[0]->licenseExpiry));
            $output = view('admin.client.manpower.pdf.printLetterUpdate', [
            'manpower_data'=>$manpower_data,
            'numto'=>$numto,
            'manpower_customers'=>$manpower_customers,
            'total_customer'=>$total_customer,
            'license_expiry'=>$license_expiry,
        ])->render();
            $mpdf->WriteHTML($output);
            $filename = date('d-M-Y', strtotime($manpower_data[0]->manpowerDate)).'-Application.pdf';
            $mpdf->Output($filename, 'I');
            exit;
        }else{
            return redirect('/manpower');
        }
    }

    public function printPutupWord($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $numto = new NumberToBangla();

        $manpower_single_data = $this->getDetails($id)->where('userId', $userId);
        $manpower_customers = $this->getCustomersDetails($id)->where('userId', $userId)->where('status', '=', 1);
        $manpower_payment = BmetPayment::where('manpowerSubId', $id)->where('userId', $userId)->where('status', '=', 1)->get();
        $total_customer = CustomerManpower::where('manpowerSubId', $id)->where('userId', $userId)->count();        
        if($manpower_single_data->count() > 0 && isset($manpower_single_data[0]) && $manpower_single_data[0]->status == 1){
            $license_expiry = date('d/m/Y', strtotime($manpower_single_data[0]->licenseExpiry));
            return view('admin.client.manpower.pdf.printPutupWord', [
            'manpower_single_data'=>$manpower_single_data,
            'manpower_customers'=>$manpower_customers,
            'manpower_payment'=>$manpower_payment,
            'numto'=>$numto,
            'total_customer'=>$total_customer,
            'license_expiry'=>$license_expiry,
        ]);
        }else{
            return redirect('/manpower');
        }
    }

    protected function getMpdfHeader(){
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        return $mpdf;
    }

    protected function getMpdfHeaderLegal(){
        $mpdf = new \Mpdf\Mpdf(['format' => 'Legal']);
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        return $mpdf;
    }

    protected function getMpdfHeaderLegalLandscape(){
        $mpdf = new \Mpdf\Mpdf([
            'format' => 'Legal',
            'orientation' => 'L'
        ]);
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        return $mpdf;
    }

    protected function getDetails($id){
        $data_details = DB::table('manpower_submissions')
            ->where('manpower_submissions.id', $id)
            ->leftJoin('users', 'manpower_submissions.userId', '=', 'users.id')
            ->select('manpower_submissions.*', 'users.title', 'users.license', 'users.licenseExpiry', 'users.address', 'users.proprietor', 'users.proprietortitle', 'users.phone', 'users.title_ar', 'users.license_ar', 'users.address_ar', 'users.proprietor_ar', 'users.proprietortitle_ar', 'users.title_bn', 'users.license_bn', 'users.address_bn', 'users.telephone_bn', 'users.proprietor_bn', 'users.proprietortitle_bn', 'users.description_bn')
            ->get();
        return $data_details;
    }

    protected function getCustomersDetails($id){
        $data_customerDetails = DB::table('customers')
    ->leftJoin('districts', 'customers.birthPlace', '=', 'districts.id')
    ->leftJoin('visatrades', 'customers.tradeId', '=', 'visatrades.id')
    ->leftJoin('customer_embassies', 'customers.id', '=', 'customer_embassies.customerId')
    ->leftJoin('customer_passports', 'customers.id', '=', 'customer_passports.customerId')
    ->leftJoin('customer_visas', 'customers.id', '=', 'customer_visas.customerId')
    ->leftJoin('countries', 'customer_visas.countryId', '=', 'countries.id')
    ->leftJoin('customer_manpowers', 'customers.id', '=', 'customer_manpowers.customerId')
    ->leftJoin('visas', 'customer_embassies.visaId', '=', 'visas.id')
    ->leftJoin('manpower_submissions', 'customer_manpowers.manpowerSubId', '=', 'manpower_submissions.id')
    ->select(
        'customers.*', 'districts.districtname',
        'visatrades.visatrade_name',
        'visas.visano_en', 'visas.visano_ar', 'visas.sponsorid_en',
        'visas.sponsorid_ar', 'visas.sponsorname_en',
        'visas.sponsorname_ar', 'visas.visa_date',
        'visas.visa_address', 'visas.occupation_en',
        'visas.occupation_ar', 'visas.delegation_no',
        'visas.delegation_date', 'visas.delegated_visa',
        'visas.visa_duration', 'customer_visas.stamped_visano',
        'customer_visas.visa_issue',
        'customer_visas.visa_expiry',
        'customer_visas.stay_duration',
        'countries.countryname as foreign_country',
        'countries.nationality as foreign_national',
        'customer_manpowers.customerPhone',
        'customer_manpowers.ordinal',
        'customer_manpowers.fatherPhone',
        'customer_manpowers.motherPhone',
        'customer_manpowers.certificateNo',
        'customer_manpowers.batchNo',
        'customer_manpowers.rollNo',
        'customer_manpowers.ttcname',
        'customer_manpowers.accountNo',
        'customer_manpowers.bankname',
        'customer_manpowers.bankbranch',
        'customer_manpowers.medicalCenter',
        'customer_manpowers.immigrationCosts',
        'customer_manpowers.finger_regno',
        'customer_manpowers.salary', 'customer_passports.passportIssue', 'customer_passports.passportExpiry', 'customer_passports.dateOfBirth',
        'manpower_submissions.manpowerDate',
        'manpower_submissions.putupSl',
        DB::raw('(SELECT COUNT(*) FROM customer_manpowers WHERE customer_manpowers.manpowerSubId = manpower_submissions.id) AS total_customer')
    )
    ->where('manpower_submissions.id', $id)
    // ->where('customers.value', '=', 4)
    ->orderBy('customer_manpowers.ordinal')
    ->get();
    return $data_customerDetails;
    }

    protected function getCustomersInfo($id){
        $data_customerDetails = DB::table('customers')
    ->leftJoin('districts', 'customers.birthPlace', '=', 'districts.id')
    ->leftJoin('visatrades', 'customers.tradeId', '=', 'visatrades.id')
    ->leftJoin('customer_embassies', 'customers.id', '=', 'customer_embassies.customerId')
    ->leftJoin('customer_passports', 'customers.id', '=', 'customer_passports.customerId')
    ->leftJoin('customer_visas', 'customers.id', '=', 'customer_visas.customerId')
    ->leftJoin('customer_manpowers', 'customers.id', '=', 'customer_manpowers.customerId')
    ->leftJoin('countries', 'customer_passports.countryId', '=', 'countries.id')
    ->leftJoin('visas', 'customer_embassies.visaId', '=', 'visas.id')
    ->leftJoin('users', 'customer_embassies.userId', '=', 'users.id')
    ->leftJoin('visatypes', 'customer_embassies.visaTypeId', '=', 'visatypes.id')
    ->select(
        'customers.*', 'districts.districtname',
        'visatrades.visatrade_name', 'visas.visano_en', 'visas.visano_ar', 'visas.sponsorid_en',
        'visas.sponsorid_ar', 'visas.sponsorname_en',
        'visas.sponsorname_ar', 'visas.visa_date',
        'visas.visa_address', 'visas.occupation_en',
        'visas.occupation_ar', 'visas.delegation_no',
        'visas.delegation_date', 'visas.delegated_visa',
        'visas.visa_duration', 'customer_visas.stamped_visano',
        'customer_visas.visa_issue', 'customer_visas.visa_expiry',
        'customer_visas.stay_duration', 'countries.countryname',
        'countries.nationality', 'users.title', 'users.license', 'users.licenseExpiry', 'users.address', 'users.proprietor', 'users.proprietortitle', 'customer_manpowers.finger_regno',
        'customer_manpowers.salary', 'customer_embassies.age', 'visatypes.visatype_name'
    )
    ->where('customers.id', $id)
    // ->where('customers.value', '=', 4)
    ->get();
    return $data_customerDetails;
    }

    protected function getPassportDetails($id){
        $data_passport = DB::table('customer_passports')
            ->leftJoin('countries', 'customer_passports.countryId', '=', 'countries.id')
            ->where('customer_passports.customerId', $id)
            ->leftJoin('divisions', 'customer_passports.divisionId', '=', 'divisions.id')
            ->leftJoin('districts', 'customer_passports.districtId', '=', 'districts.id')
            ->leftJoin('policestations', 'customer_passports.policestationId', '=', 'policestations.id')
            ->leftJoin('issues', 'customer_passports.issuePlaceId', '=', 'issues.id')
            ->select('customer_passports.*', 'countries.countryname', 'countries.nationality', 'divisions.divisionname', 'districts.districtname', 'policestations.policestationname', 'issues.issuePlace')
            ->get();
        return $data_passport;
    }

    protected function getStampingDetails($id){
        $data_stamping = DB::table('customer_visas')
            ->leftJoin('countries', 'customer_visas.countryId', '=', 'countries.id')
            ->where('customer_visas.customerId', $id)
            ->select('customer_visas.*', 'countries.countryname as foreign_country', 'countries.nationality as foreign_national')
            ->get();
        return $data_stamping;
    }
}