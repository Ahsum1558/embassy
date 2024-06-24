@php
    $data = app('App\Helpers\BanglaNumberConverter');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notesheet</title>
    <link href="{{ asset('public/admin/assets/css/pdf/notesheetprint.css') }}" rel="stylesheet">
</head>
<body>

<div class="app_wrapper clear">
    <div class="main_content clear">
        <div class="primary_putup">
            <div class="putup_starting">
                <div class="putup_serial">{{ $numto->bnNum($manpower_single_data[0]->putupSl) }}।</div> <div class="putup_primary">{{ Auth::user()->title_bn }} ({{ Auth::user()->license_bn }}) এর {{ Auth::user()->proprietortitle_bn }} সৌদি আরবগামী {{ $numto->bnNum($total_customer) }} ({{ $numto->bnWord($total_customer) }}) জন পুরুষ কর্মীর অনুকূলে বিভিন্ন পেশায় একক বহির্গমন ছাড়পত্র গ্রহণের জন্য আবেদনপত্র সহ নিম্নে বর্ণিত কাগজপত্রাদি দাখিল করেছেন।</div>
            </div>
            <div class="putup_condition">
                <div class="condition_value">ক) রি/ এজেন্সীর আবেদন পত্র - পতাকা ‘ক’।</div>
                <div class="condition_value">খ) আয়কর চালান, কল্যাণ ও বীমা ফি এবং স্মার্টকার্ড ফি বাবদ প্রাপ্ত পে-অর্ডারের ফটোকপি - পতাকা ‘খ’।</div>
                <div class="condition_value">গ) পুট-আপ লিষ্ট - পতাকা ‘গ’।</div>
                <div class="condition_value">ঘ) রিক্রুটিং এজেন্সী কর্তৃক দাখিল কৃত {{ $numto->bnNum(300) }}/- টাকার নন-জুডিশিয়াল ষ্ট্যাম্পে অঙ্গিকারনামা আছে - পতাকা ‘ঘ’।</div>
                <div class="condition_value">ঙ) কর্মির পাসপোর্ট ও ভিসার ফটোকপি - পতাকা ‘ঙ’ ।</div>
                <div class="condition_value">চ) এনজাজ/ ওকালা - পতাকা ‘চ’।</div>
                <div class="condition_value">ছ) চুক্তিপত্রের ফটোকপি - পতাকা ‘ছ’।</div>
                <div class="condition_value">জ) রিক্রুটিং লাইসেন্সের মেয়াদ {{ $data->convertToBanglaNumber($license_expiry) }} তারিখ পর্যন্ত নবায়ন আছে - পতাকা ‘জ’।</div>
                <div class="condition_value">ঝ) প্রশিক্ষন সনদ - পতাকা ‘ঝ’।</div>
                <div class="condition_value">ঞ) কর্মীর ডাটাশীট - পতাকা ‘ঞ’।</div>
            </div>
        </div>
        <div class="putup_customers">
            <div class="customers_headeline">
                <span class="heading_sl">{{ $numto->bnNum($manpower_single_data[0]->putupSl+1) }}।</span>
                <span class="heading_title">কর্মীর বিবরণ:-</span>
            </div>
            <div class="customers_table">
                <table id="customersData">
                    <thead>
                        <tr>
                            <th>ক্র. নং</th>
                            <th>কর্মীর নাম</th>
                            <th>পাসপোর্ট নং</th>
                            <th>ভিসা এডভাইস</th>
                            <th>নিয়োগকর্তার নাম</th>
                            <th>পেশা</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                      $i=1;
                    @endphp
                    @foreach($manpower_customers as $customer)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                                {{ $customer->cusFname .' '. $customer->cusLname }}
                                @if(isset($customer->customerPhone))
                                {{ 'S.'. $customer->customerPhone }}
                                @elseif(isset($customer->fatherPhone))
                                {{ 'F.'. $customer->fatherPhone }}
                                @elseif(isset($customer->motherPhone))
                                {{ 'M.'. $customer->motherPhone }}
                                @endif
                            </td>
                            <td>{{ $customer->passportNo }}</td>
                            <td>
                                {{ $customer->visano_en }} 
                                {{ $customer->sponsorid_en }}
                            </td>
                            <td>{{ $customer->sponsorname_en }}</td>
                            <td>{{ $customer->occupation_en }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="putup_training">
            <div class="training_headeline">
                <span class="heading_sl">{{ $numto->bnNum($manpower_single_data[0]->putupSl+2) }}।</span>
                <span class="heading_title">প্রশিক্ষন সনদ এর বিবরণ:-</span>
            </div>
            <div class="training_table">
                <table id="customersData">
                    <thead>
                        <tr>
                            <th>ক্র. নং</th>
                            <th>কর্মীর নাম</th>
                            <th>পাসপোর্ট নং</th>
                            <th>প্রশিক্ষন সনদ নং</th>
                            <th>ব্যাচ নং</th>
                            <th>রোল</th>
                            <th>টিটিসি ও নাম</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                      $a=1;
                    @endphp
                    @foreach($manpower_customers as $customer)
                        <tr>
                            <td>{{ $a++ }}</td>
                            <td>
                                {{ $customer->cusFname .' '. $customer->cusLname }}
                            </td>
                            <td>{{ $customer->passportNo }}</td>
                            <td>{{ $customer->certificateNo }}</td>
                            <td>{{ $customer->batchNo }}</td>
                            <td>{{ $customer->rollNo }}</td>
                            <td>{{ $customer->ttcname }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="putup_center">
            <div class="center_headeline">
                <span class="heading_sl">{{ $numto->bnNum($manpower_single_data[0]->putupSl+3) }}।</span>
                <span class="heading_title">ব্যাংক ও মেডিকেলের বিবরণ:-</span>
            </div>
            <div class="center_table">
                <table id="customersData">
                    <thead>
                        <tr>
                            <th>ক্র. নং</th>
                            <th>কর্মীর নাম</th>
                            <th>পাসপোর্ট নং</th>
                            <th>ব্যাংকের নাম</th>
                            <th>হিসাব নং</th>
                            <th>মেডিকেল সেন্টারের নাম</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                      $b=1;
                    @endphp
                    @foreach($manpower_customers as $customer)
                        <tr>
                            <td>{{ $b++ }}</td>
                            <td>
                                {{ $customer->cusFname .' '. $customer->cusLname }}
                            </td>
                            <td>{{ $customer->passportNo }}</td>
                            <td>{{ $customer->bankname }}</td>
                            <td>{{ $customer->accountNo }}</td>
                            <td>{{ $customer->medicalCenter }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <pagebreak></pagebreak>
        <div class="putup_payment">
            <div class="payment_headeline">
                <span class="heading_sl">{{ $numto->bnNum($manpower_single_data[0]->putupSl+4) }}।</span>
                <span class="heading_title">আয়কর চালান, কল্যাণ ফি, বীমা ফি ও স্মার্টকার্ড এর বিবরণ:-</span>
            </div>
            <div class="payment_table">
            @foreach ($manpower_payment as $payment)
            @php
                $income_tax_date = date('d/m/Y', strtotime($payment->incomeTaxDate));
                $insurance_date = date('d/m/Y', strtotime($payment->welfareInsuranceDate));
                $card_date = date('d/m/Y', strtotime($payment->smartCardDate));
            @endphp
                <table id="paymentData">
                    <thead>
                        <tr>
                            <th>ক্র. নং</th>
                            <th>জন প্রতিহার</th>
                            <th width="10%">কর্মীর সংখ্যা</th>
                            <th>মোট টাকা</th>
                            <th>পে-অর্ডার নম্বর ও তারিখ</th>
                            <th>ব্যাংক এর নাম ও শাখা</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>আয়কর চালান</td>
                            <td>{{ $numto->bnNum($payment->incomeTax / $payment->customerNumber) }}/-</td>
                            <td rowspan="3">{{ $numto->bnNum($payment->customerNumber) }} ({{ $numto->bnWord($payment->customerNumber) }}) জন</td>
                            <td>{{ $numto->bnNum($payment->incomeTax) }}/-</td>
                            <td>{{ $numto->bnNum($payment->incomeTaxNo) }}, {{ $data->convertToBanglaNumber($income_tax_date) }}</td>
                            <td>{{ $payment->taxPayBank }}</td>
                        </tr>
                        <tr>
                            <td>কল্যান বীমা ফি</td>
                            <td>{{ $numto->bnNum($payment->welfareInsurance / $payment->customerNumber) }}/-</td>
                            <td>{{ $numto->bnNum($payment->welfareInsurance) }}/-</td>
                            <td>{{ $numto->bnNum($payment->welfareInsuranceNo) }}, {{ $data->convertToBanglaNumber($insurance_date) }}</td>
                            <td>{{ $payment->insurancePayBank }}</td>
                        </tr>
                        <tr>
                            <td>স্মার্ট বাবদ ফি</td>
                            <td>{{ $numto->bnNum($payment->smartCard / $payment->customerNumber) }}/-</td>
                            <td>{{ $numto->bnNum($payment->smartCard) }}/-</td>
                            <td>{{ $numto->bnNum($payment->smartCardNo) }}, {{ $data->convertToBanglaNumber($card_date) }}</td>
                            <td>{{ $payment->smartPayBank }}</td>
                        </tr>
                    </tbody>
                </table>
            @endforeach
            </div>
        </div>

        <div class="putup_translate">
            <div class="translate_info">
                <div class="translate_serial">{{ $numto->bnNum($manpower_single_data[0]->putupSl+5) }}।</div> <div class="translate_content">দাখিলকৃত ভিসার সঠিকতা ধরণ, পেশা, নিষিদ্ধ কোম্পানীর ভিসা ও ইনজাজ কপির ডেলিগেশন ইন এ্যাম্বাসিতে ভিসা <small style="font-family: roboto; font-size: 14px;">ADVICE LIST/LOT</small> এ {{ $numto->bnNum(25) }} এর অধিক ভিসা আছে কিনা মতামতের জন্য অনুবাদকের নিকট প্রেরণ করা হলো।</div>
            </div>
        </div>
        <div class="putup_translator">অনুবাদক</div>
        <div class="putup_transbellow">
            <div class="bellow_serial">{{ $numto->bnNum($manpower_single_data[0]->putupSl+6) }}।</div>
        </div>
      
    </div>
</div>

</body>
</html>