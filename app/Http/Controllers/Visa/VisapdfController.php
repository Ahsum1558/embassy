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
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\View\View;
use Mpdf\Mpdf;

class VisapdfController extends Controller
{
    public function getpdf()
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $userId = Auth::user()->id;
        $mpdf = $this->getMpdfHeader();

        $all_visa = Visa::latest()->where('userId','=',$userId) -> get();
        $visaCounts = [];

        foreach ($all_visa as $visa) {
            $visaId = $visa->id;
            $total_customer = CustomerEmbassy::where('visaId', $visaId)->where('userId', $userId)->count();
            $visaCounts[$visaId] = $total_customer;
        }
        $output = view('admin.visa.visainfo.pdf',  compact('all_visa', 'visaCounts'))->render();

        $mpdf->WriteHTML($output);
        $filename = 'Visa List.pdf';
        $mpdf->Output($filename, 'I');
    }

    public function getVisaPdf($id)
    {
        $userId = Auth::user()->id;
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $mpdf = $this->getMpdfHeader();

        $single_visa = Visa::where('userId', $userId)->find($id);
        $customer_data = $this->getVisaCustomers($id)->where('userId', $userId);

         if ($single_visa !== null) {
            $visaCounts = [];
            $visaId = $single_visa->id;
            $total_customer = CustomerEmbassy::where('visaId', $id)->where('userId', $userId)->count();
            $visaCounts[$visaId] = $total_customer;
            $output = view('admin.visa.visainfo.visaDetailsPdf', [
            'single_visa'=>$single_visa,
            'visaCounts'=>$visaCounts,
            'customer_data'=>$customer_data,
        ])->render();
        $mpdf->WriteHTML($output);
        $filename = $single_visa->visano_en.'.pdf';
        $mpdf->Output($filename, 'I');
        }else{
            return redirect('/visa');
        }
    }

    protected function getMpdfHeader(){
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        return $mpdf;
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