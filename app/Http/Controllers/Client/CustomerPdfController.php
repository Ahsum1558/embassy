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
use App\Models\Submission;
use App\Models\SubmissionCustomer;
use Mpdf\Utils\FontMetrics;
use Mpdf\Mpdf;
use App\Helpers\BarcodeHelper;
use App\Models\CustomerManpower;
use Milon\Barcode\DNS1D;
use Illuminate\Support\Facades\File;
use Picqer\Barcode\BarcodeGeneratorPNG;
use DateTime;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Carbon;
use App\Enums\GenderEnum;

class CustomerPdfController extends Controller
{
    public function print($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $mpdf = $this->getMpdfHeader();

        $customer_single_data = $this->getDetails($id)->where('userId', $userId);

        $customer_single_docs = CustomerDocoment::where('customerId', $id)->where('userId', $userId)->get();
        $passport_single_data = $this->getPassportDetails($id)->where('userId', $userId);
        $embassy_single_data = $this->getEmbassyDetails($id)->where('userId', $userId);
        $stamping_single_docs = CustomerVisa::where('customerId', $id)->where('userId', $userId)->get();
        $rate_single_docs = CustomerRate::where('customerId', $id)->where('userId', $userId)->get();
        $customer_single_data->transform(function ($customer) {
            if (isset($customer->gender)) {
                $customer->gender = GenderEnum::tryFrom($customer->gender);
            }
            return $customer;
        });

        if($customer_single_data->count() > 0  && isset($customer_single_data[0]) && $customer_single_data[0]->status == 1){
            $output = view('admin.client.customer.pdf.print', [
            'customer_single_data'=>$customer_single_data,
            'customer_single_docs'=>$customer_single_docs,
            'passport_single_data'=>$passport_single_data,
            'embassy_single_data'=>$embassy_single_data,
            'stamping_single_docs'=>$stamping_single_docs,
            'rate_single_docs'=>$rate_single_docs,
        ])->render();

        $mpdf->WriteHTML($output);
        $filename = $customer_single_data[0]->customersl.'-'.$customer_single_data[0]->cusFname.' '.$customer_single_data[0]->cusLname.'.pdf';
        $mpdf->Output($filename, 'I');

        }else{
            return redirect('/customer');
        }
    }

    public function SubmissionList($id)
    {
        if (!Auth::check() || Auth::user()->type !== 'approve') {
        return redirect('/');
        }
        $expiryDate = Carbon::parse(Auth::user()->userExpiry);
        if ($expiryDate->isPast()) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $mpdf = $this->getMpdfHeader();

        $submission_single_data = $this->getSubmissionDetails($id)->where('userId', $userId);
        $submission_information = $this->getCustomersDetails($id)->where('userId', $userId);
        $submission_count = $this->countSubmissionTypes($id);
        $new_submission = $this->getCustomersDetails($id)->where('submissionType', 1)->where('userId', $userId);
        $visa_extension = $this->getCustomersDetails($id)->where('submissionType', 2)->where('userId', $userId);
        $visa_renew = $this->getCustomersDetails($id)->where('submissionType', 3)->where('userId', $userId);
        $visa_reissue = $this->getCustomersDetails($id)->where('submissionType', 4)->where('userId', $userId);
        $visa_replacement = $this->getCustomersDetails($id)->where('submissionType', 5)->where('userId', $userId);
        $visa_cancel = $this->getCustomersDetails($id)->where('submissionType', 6)->where('userId', $userId);
        $submission_info = SubmissionCustomer::where('submissionId', $id)->where('userId', $userId)->get();
        $total_submission = $submission_info->count('submissionId');

        if($submission_single_data->count() > 0 && isset($submission_single_data[0]) && $submission_single_data[0]->status == 1){
            $output = view('admin.client.submission.printStatement', [
            'submission_single_data'=>$submission_single_data,
            'submission_information'=>$submission_information,
            'new_submission'=>$new_submission,
            'visa_extension'=>$visa_extension,
            'visa_renew'=>$visa_renew,
            'visa_reissue'=>$visa_reissue,
            'visa_replacement'=>$visa_replacement,
            'visa_cancel'=>$visa_cancel,
            'submission_info'=>$submission_info,
            'total_submission'=>$total_submission,
            'submission_count'=>$submission_count,
        ])->render();


        $mpdf->WriteHTML($output);
        $filename = date('d-M-Y', strtotime($submission_single_data[0]->submissionDate)).'.pdf';
        $mpdf->Output($filename, 'I');

        }else{
            return redirect('/submission');
        }
    }

    public function convertNumberEmbassy(float $amount){
        $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
        // Check if there is any number after decimal
        $amt_hundred = null;
        $count_length = strlen($num);
        $x = 0;
        $string = array();
        $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
         3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
         7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
         10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
         13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
         16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
         19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
         40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
         70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
        $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore', 'Hundred Crore');
        while( $x < $count_length ) {
               $get_divider = ($x == 2) ? 10 : 100;
           $amount = floor($num % $get_divider);
           $num = floor($num / $get_divider);
           $x += $get_divider == 10 ? 1 : 2;
           if ($amount) {
             $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
             $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
             $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
             '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
             '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
             }else $string[] = null;
           }
           $implode_to_Rupees = implode('', array_reverse($string));
           $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
           " . $change_words[$amount_after_decimal % 10]) . '' : '';
           return ($implode_to_Rupees ? $implode_to_Rupees . '' : '') . $get_paise;
    }
    protected function getMpdfHeader(){
        $mpdf = new \Mpdf\Mpdf([
            'default_font' => 'sutonnyMJ',
            'mode' => 'utf-8'
        ]);
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        return $mpdf;
    }

    protected function getMpdfBangla(){

        $fontDir = base_path('resources/fonts/');
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

         $mpdf = new Mpdf([
            'fontDir' => array_merge($fontDirs, [
                $fontDir,
            ]),
            'fontdata' => $fontData + [
                'solaimanlipi' => [
                    'R' => "SolaimanLipi_22-02-2012.ttf",
                    'B' => "SolaimanLipi_Bold_10-03-12.ttf",
                    'useOTL' => 0xFF,
                    'useKashida' => 75,
                ]
            ],
            'default_font' => 'solaimanlipi',
            'mode' => 'utf-8',
        ]);
        return $mpdf;
    }

    protected function getDetails($id){
        $data_details = DB::table('customers')
            ->leftJoin('delegates', 'customers.agentId', '=', 'delegates.id')
            ->where('customers.id', $id)
            ->leftJoin('districts', 'customers.birthPlace', '=', 'districts.id')
            ->leftJoin('visatrades', 'customers.tradeId', '=', 'visatrades.id')
            ->leftJoin('users', 'customers.userId', '=', 'users.id')
            ->select('customers.*', 'delegates.agentname', 'delegates.agentsl', 'delegates.agentbook', 'districts.districtname', 'visatrades.visatrade_name', 'users.name as receiver')
            ->get();
        return $data_details;
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

    protected function getEmbassyDetails($id){
        $data_embassy = DB::table('customer_embassies')
            ->leftJoin('visatypes', 'customer_embassies.visaTypeId', '=', 'visatypes.id')
            ->where('customer_embassies.customerId', $id)
            ->leftJoin('customers', 'customer_embassies.customerId', '=', 'customers.id')
            ->leftJoin('submission_customers', 'customer_embassies.customerId', '=', 'submission_customers.customerId')
            ->leftJoin('submissions', 'submission_customers.submissionId', '=', 'submissions.id')
            ->leftJoin('visas', 'customer_embassies.visaId', '=', 'visas.id')
            ->leftJoin('users', 'customer_embassies.userId', '=', 'users.id')
            ->leftJoin('countries', 'users.countryId', '=', 'countries.id')
            ->leftJoin('divisions', 'users.divisionId', '=', 'divisions.id')
            ->leftJoin('districts', 'users.districtId', '=', 'districts.id')
            ->leftJoin('policestations', 'users.policestationId', '=', 'policestations.id')
            ->select('customer_embassies.*', 'submissions.submissionDate as embassy_submission', 'visatypes.visatype_name', 'visas.visano_en', 'visas.visano_img', 'visas.visano_ar', 'visas.sponsorid_en', 'visas.sponsorid_ar', 'visas.sponsorname_en', 'visas.sponsorname_ar', 'visas.visa_date', 'visas.visa_address', 'visas.occupation_en', 'visas.occupation_ar', 'visas.delegation_no', 'visas.delegation_date', 'visas.delegated_visa', 'visas.visa_duration', 'users.title', 'users.license', 'users.address', 'users.proprietor', 'users.proprietortitle', 'users.title_ar', 'users.license_ar', 'users.address_ar', 'users.proprietor_ar', 'users.proprietortitle_ar', 'users.title_bn', 'users.license_bn', 'users.address_bn', 'users.proprietor_bn', 'users.proprietortitle_bn', 'users.description_bn', 'countries.countryname', 'countries.nationality', 'divisions.divisionname', 'districts.districtname', 'policestations.policestationname')
            ->get();
        return $data_embassy;
    }

    protected function getSubmissionDetails($id){
        $data_details = DB::table('submissions')
            ->leftJoin('users', 'submissions.userId', '=', 'users.id')
            ->where('submissions.id', $id)
            ->leftJoin('submission_customers', 'submissions.id', '=', 'submission_customers.submissionId')
            ->select('submissions.*', 'submission_customers.submissionType', 'users.title', 'users.license', 'users.address', 'users.proprietor', 'users.proprietortitle', 'users.title_ar', 'users.license_ar', 'users.address_ar', 'users.proprietor_ar', 'users.proprietortitle_ar', 'users.title_bn', 'users.license_bn', 'users.address_bn', 'users.proprietor_bn', 'users.proprietortitle_bn', 'users.description_bn')
            ->get();
        return $data_details;
    }

    protected function getCustomersDetails($id)
    {
        $data_customerDetails = DB::table('customers')
            ->leftJoin('customer_embassies', 'customers.id', '=', 'customer_embassies.customerId')
            ->leftJoin('submission_customers', 'customers.id', '=', 'submission_customers.customerId')
            ->leftJoin('visas', 'customer_embassies.visaId', '=', 'visas.id')
            ->leftJoin('submissions', 'submission_customers.submissionId', '=', 'submissions.id')
            ->select('customers.*', 'visas.visano_en', 'visas.visano_ar', 'visas.sponsorid_en', 'visas.sponsorid_ar', 'visas.sponsorname_en', 'visas.sponsorname_ar', 'visas.visa_date', 'visas.visa_address', 'visas.occupation_en', 'visas.occupation_ar', 'visas.delegation_no', 'visas.delegation_date', 'visas.delegated_visa', 'visas.visa_duration', 'submission_customers.submissionType', 'submission_customers.ordinal', 'submission_customers.visaYear', 'submissions.submissionDate')
            ->where('submission_customers.submissionId', $id)
            // ->where('customers.value', '=', 3)
            ->orderBy('submission_customers.ordinal')
            ->get();
        
        return $data_customerDetails;
    }

    protected function countSubmissionTypes($id)
    {
        $submissionTypes = DB::table('submission_customers')
            ->select(DB::raw('count(submissionType) as total_submission'), 'submissionType')
            ->where('submissionId', $id)
            ->groupBy('submissionType')
            ->get();

        return $submissionTypes;
    }
}