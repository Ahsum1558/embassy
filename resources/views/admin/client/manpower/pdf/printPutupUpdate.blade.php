@php
    $data = app('App\Helpers\BanglaNumberConverter');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Put Up List</title>
    <link href="{{ asset('public/admin/assets/css/pdf/putupprintUpdate.css') }}" rel="stylesheet">
    <style>
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div class="app_wrapper clear">
    @php
        $customers = $manpower_customers->toArray();
        $maxColumns = 8;
        $chunks = array_chunk($customers, $maxColumns); 
        $i=1;
    @endphp

    @foreach($chunks as $chunk)
        <div class="main_content clear">
            <div class="putup_headline clear">
                <div class="top_heading clear">একক বহির্গমন ছাড়পত্রের পুটআপশীট ও ডাটাএন্ট্রি ফরম</div>
            </div>
            <div class="putup_customers">
                <div class="customers_table">
                    <table id="tableHeadline">
                        <thead>
                            <tr>
                                <td width="13%">নিয়োগকারী দেশের নাম:</td>
                                <td style="text-align: center;">{{ $manpower_single_data[0]->countrynamebn }}</td>
                                <td style="text-align: center;">লাইসেন্স নং:</td>
                                <td colspan="2" style="text-align: center;">ভিসার ধরন</td>
                                <td>উৎস আয়করের পরিমান জনপ্রতি:</td>
                                <td style="text-align: center;">{{ $numto->bnNum(500) }}</td>
                            </tr>
                            <tr>
                                <td rowspan="2">রিক্রুটিং এজেন্সীর নাম:</td>
                                <td rowspan="2" style="text-align: center;">{{ Auth::user()->title_bn }}</td>
                                <td rowspan="3" style="text-align: center;">{{ Auth::user()->license_bn }}</td>
                                <td rowspan="3" style="text-align: center;">সত্যায়িত</td>
                                <td rowspan="3" style="text-align: center;">অসত্যায়িত</td>
                                <td>কল্যাণ ফি পরিমান জনপ্রতি:</td>
                                <td style="text-align: center;">{{ $numto->bnNum(4500) }}</td>
                            </tr>
                            <tr>
                                <td>স্মার্ট কার্ড ফি:</td>
                                <td style="text-align: center;">{{ $numto->bnNum(250) }}</td>
                            </tr>
                            <tr>
                                <td>টাকা জমার পারমিট নং:</td>
                                <td></td>
                                <td>তারিখ:</td>
                                @php
                                    $mp_date = date('d/m/Y', strtotime($manpower_single_data[0]->manpowerDate));
                                @endphp
                                <td style="text-align: center;">{{ $data->convertToBanglaNumber($mp_date) }}</td>
                            </tr>
                        </thead>
                    </table>
                    <table id="customersData">
                        <tbody>
                            <tr>
                                <td>Employee No.</td>
                            @foreach($chunk as $customer)
                                <td>{{ $i++ }}</td>
                            @endforeach
                            </tr>
                            <tr>
                                <td>Worker SI. No</td>
                            @foreach($chunk as $customer)
                                <td></td>
                            @endforeach
                            </tr>
                            <tr>
                                <td>Company Name</td>
                            @foreach($chunk as $customer)
                                <td style="font-size: 10px; font-weight: bold;">{{ $customer->sponsorname_en }}</td>
                            @endforeach
                            </tr>
                            <tr>
                                <td>Employee Name</td>
                            @foreach($chunk as $customer)
                                <td style="font-weight: bold;">{{ $customer->cusFname .' '. $customer->cusLname }}</td>
                            @endforeach
                            </tr>
                            <tr>
                                <td>Job Post</td>
                            @foreach($chunk as $customer)
                                <td>{{ $customer->occupation_en }}</td>
                            @endforeach
                            </tr>
                            <tr>
                                <td>Salary</td>
                            @foreach($chunk as $customer)
                                <td>{{ $customer->salary }}</td>
                            @endforeach
                            </tr>
                            <tr>
                                <td>Reg Id No.</td>
                            @foreach($chunk as $customer)
                                <td style="font-weight: bold;">{{ $customer->finger_regno }}</td>
                            @endforeach
                            </tr>
                            <tr>
                                <td>Visa Number</td>
                            @foreach($chunk as $customer)
                                <td>{{ $customer->stamped_visano }}</td>
                            @endforeach
                            </tr>
                            <tr>
                                <td>Visa Issue Date</td>
                            @foreach($chunk as $customer)
                                <td>{{ date('d/m/Y', strtotime($customer->visa_issue)) }}</td>
                            @endforeach
                            </tr>
                            <tr>
                                <td>Visa Expiry Date</td>
                            @foreach($chunk as $customer)
                                <td>{{ date('d/m/Y', strtotime($customer->visa_expiry)) }}</td>
                            @endforeach
                            </tr>
                            <tr>
                                <td>Passport No.</td>
                            @foreach($chunk as $customer)
                                <td style="font-weight: bold;">{{ $customer->passportNo }}</td>
                            @endforeach
                            </tr>
                            <tr>
                                <td>Passport Issue Date</td>
                            @foreach($chunk as $customer)
                                <td>{{ date('d/m/Y', strtotime($customer->passportIssue)) }}</td>
                            @endforeach
                            </tr>
                            <tr>
                                <td>Passport Expiry Date</td>
                            @foreach($chunk as $customer)
                                <td>{{ date('d/m/Y', strtotime($customer->passportExpiry)) }}</td>
                            @endforeach
                            </tr>
                            <tr>
                                <td>Date Of Birth</td>
                            @foreach($chunk as $customer)
                                <td>{{ date('d/m/Y', strtotime($customer->dateOfBirth)) }}</td>
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="putup_promise clear">
                <div class="promise_info">
                    <div class="promise_heading">এজেন্সীর অঙ্গীকারঃ</div>
                    <div class="promise_content">বর্ণিত কর্মী গ্রুপ ভিসার অন্তর্ভুক্ত নয়। কর্মীদের পাসপোর্ট, ভিসা, চাকুরীর চুক্তিপত্রে বর্ণিত বেতন ও শর্তাদি সঠিক আছে। উক্ত বিষয়ে ত্রুটির কারণে কর্মীদের কোন প্রকার সমস্যা হলে আমার রি/এজেন্সি <span style="font-size: 20px;">মেসার্স {{ Auth::user()->title_bn }}, {{ Auth::user()->license_bn }}</span> সম্পূর্ণ দায় দায়িত্ব গ্রহন ও কর্মীদের ক্ষতিপূরণ দান করতে বাধ্য থাকবে।</div>
                </div>
            </div>
            <div class="putup_translate">
                <div class="translate_info">
                    <div class="translate_content">
                        <table id="paymentTable">
                            <tbody>
                            @foreach ($manpower_payment as $payment)
                            @php
                                $income_tax_date = date('d/m/Y', strtotime($payment->incomeTaxDate));
                                $insurance_date = date('d/m/Y', strtotime($payment->welfareInsuranceDate));
                                $card_date = date('d/m/Y', strtotime($payment->smartCardDate));
                            @endphp
                                <tr>
                                    <td>পে-অর্ডার নং- {{ $numto->bnNum($payment->welfareInsuranceNo) }}</td>
                                    <td>তারিখঃ {{ $data->convertToBanglaNumber($insurance_date) }}</td>
                                    <td>টাকাঃ- {{ $numto->bnNum($payment->welfareInsurance*$payment->customerNumber) }}/-</td>
                                    <td>আয়কর চালান নং- {{ $numto->bnNum($payment->incomeTaxNo) }}</td>
                                    <td>তারিখঃ {{ $data->convertToBanglaNumber($income_tax_date) }}</td>
                                    <td>টাকাঃ- {{ $numto->bnNum($payment->incomeTax*$payment->customerNumber) }}/-</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="putup_sign clear">
                <div class="sign_first">
                    <div class="note">এজেন্সীর মালিক/প্রতিনিধির স্বাক্ষর</div>
                    <div class="signature"></div>
                </div>
                <div class="sign_second">
                    <div class="note">পরীক্ষিত হয়েছে। কাগজপত্র সঠিক আছে/নাই</div>
                    <div class="signature">সহকারীর স্বাক্ষর</div>
                </div>
                <div class="sign_third">
                    <div class="note">বর্ণিত তথ্যাদি সঠিক আছে/নাই</div>
                    <div class="signature">সহকারী পরিচালকের স্বাক্ষর</div>
                </div>
                <div class="sign_forth">
                    <div class="note">বহির্গমনের ছাড়পত্র দেওয়া যায়/যায় না</div>
                    <div class="signature">উপ-পরিচালকের স্বাক্ষর</div>
                </div>
                <div class="sign_fifth">
                    <div class="note">বহির্গমনের ছাড়পত্র দেওয়া যায়/যায় না</div>
                    <div class="signature">পরিচালকের স্বাক্ষর</div>
                </div>
            </div>
        </div>
    @if (!$loop->last)
        <div class="page-break"></div>
    @endif
    @endforeach
    </div>
</body>
</html>