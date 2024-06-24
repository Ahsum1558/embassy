@php
    $data = app('App\Helpers\BanglaNumberConverter');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undertaking</title>
    <link href="{{ asset('public/admin/assets/css/pdf/undertakingprint.css') }}" rel="stylesheet">
</head>
<body>

<div class="app_wrapper clear">
    <div class="main_content clear">
        <div class="primary_undertaking">
            <div class="undertaking_heading">
                সৌদি আরবগামী নিম্নলিখিত {{ $numto->bnNum($total_customer) }} ({{ $numto->bnWord($total_customer) }}) জন পুরুষ কর্মী প্রেরণ সংক্রান্ত রিক্রুটিং এজেন্সী {{ Auth::user()->title_bn }} ({{ Auth::user()->license_bn }}) অঙ্গীকারনামা।
            </div>
        </div>
        <div class="undertaking_customers">
            <div class="customers_table">
                <table id="customersData">
                    <thead>
                        <tr>
                            <th width="5%">ক্র. নং</th>
                            <th>কর্মীর নাম, ঠিকানা, মোবাইল নং</th>
                            <th>পাসপোর্ট নম্বর</th>
                            <th>নিয়োগকর্তার নাম, ঠিকানা ও টেলিফোন নম্বর</th>
                            <th>ভিসা নম্বর</th>
                            <th>পদের নাম</th>
                            <th>অভিবাসন ব্যয়</th>
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
                            <td>{{ $customer->sponsorname_en }}</td>
                            <td>{{ $customer->visano_en }}</td>
                            <td>{{ $customer->occupation_en }}</td>
                            <td>{{ $customer->immigrationCosts }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="undertaking_training">
            <div class="training_table">
                <table id="customersData">
                    <thead>
                        <tr>
                            <th width="5%">ক্র. নং</th>
                            <th width="17%">কর্মীর নাম</th>
                            <th>পাসপোর্ট নং</th>
                            <th>প্রশিক্ষন সনদ নং</th>
                            <th width="20%">মেডিকেল</th>
                            <th>ব্যাংক একাউন্ট</th>
                            <th width="20%">টিটিসি ও নাম</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                      $a=1;
                    @endphp
                    @foreach($manpower_customers as $customer)
                        <tr>
                            <td>{{ $a++ }}</td>
                            <td>{{ $customer->cusFname .' '. $customer->cusLname }}</td>
                            <td>{{ $customer->passportNo }}</td>
                            <td>{{ $customer->certificateNo }}</td>
                            <td>{{ $customer->medicalCenter }}</td>
                            <td>{{ $customer->accountNo }}</td>
                            <td>{{ $customer->ttcname }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="page_running">চলমান পাতা # {{ $numto->bnNum(0) }}{{ $numto->bnNum(2) }}</div>
        <pagebreak></pagebreak>

        <div class="undertaking_main">
            <div class="undertaking_info">
                <div class="undertaking_page">পাতা # {{ $numto->bnNum(0) }}{{ $numto->bnNum(2) }}</div>
                <div class="undertaking_content">
                    <div class="content_top">আমি রিক্রুটিং এজেন্সী মেসার্স {{ Auth::user()->title_bn }} ({{ Auth::user()->license_bn }}) এর স্বত্ত্বাধিকারী/ ব্যবস্থা অংশীদার/ ব্যবস্থাপনা পরিচালক এই মর্মে অঙ্গীকার করছি যে, চাকুরীর উদ্দেশ্যে সৌদি আরব দেশের বিভিন্ন নিয়োগ কর্তার অধীনে {{ $numto->bnNum($total_customer) }} ({{ $numto->bnWord($total_customer) }}) জন পুরুষ কর্মীর ভিসা প্রসেসিং সহ জনশক্তি কর্মসংস্থান ও প্রশিক্ষণ ব্যুরো হতে একক বহির্গমন ছাড়পত্র গ্রহণের নিমিত্তে বিদেশগামী কর্মীর নিকট হতে প্রয়োজনীয় কাগজপত্র দাখিল করলাম, যা সঠিক আছে।</div>
                    <div class="content_bottom">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;উপর্যুক্ত কর্মীদের সৌদি আরব বিমানবন্দরে নিয়োগকর্তা বা নিয়োগকর্তার প্রতিনিধি গ্রহণ করবেন এবং বর্ণিত কর্মীগণকে সৌদি আরব দেশে প্রেরণের জন্য বহির্গমন ছাড়পত্র গ্রহণের পর উক্ত দেশ ব্যতীত অন্য কোন দেশে প্রেরণ করব না মর্মে অঙ্গীকার করছি।</div>
                </div>
            </div>
        </div>
        <div class="page_running">চলমান পাতা # {{ $numto->bnNum(0) }}{{ $numto->bnNum(3) }}</div>
        <pagebreak></pagebreak>

        <div class="undertaking_main">
            <div class="undertaking_info">
                <div class="undertaking_page">পাতা # {{ $numto->bnNum(0) }}{{ $numto->bnNum(3) }}</div>
                <div class="undertaking_content">
                    <div class="content_top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;আমি আরও অঙ্গীকার করছে যে, উপর্যুক্ত কর্মীদের ভিসা সঠিক আছে। কর্মীগণ বিদেশে যাওয়ার পর সংশ্লিষ্ট নিয়োগকর্তার অধীনে নির্ধারিত পেশায় চাকুরী প্রদানের নিশ্চয়তা প্রদান করছি এবং কর্মীগণ বিদেশে যাওয়ার পর চুক্তিপত্র অনুযায়ী বেতন ভাতাদি ও অন্যান্য সুযোগ সুবিধা প্রাপ্য না হলে, তার সকল দায়-দায়িত্ব বহন করব এবং কর্মীদের যাবতীয় ক্ষতিপূরণ দিতে বাধ্য থাকব। আরও অঙ্গীকার করছি যে, কর্মীদের নিকট হতে সরকার কর্তৃক নির্ধারিত অভিবাসন ব্যয়ের বেশি ব্যয় গ্রহণ করা হয় নি।</div>
                    <div class="content_bottom">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;উপর্যুক্ত অঙ্গীকারনামায় বর্ণিত বিষয়ের কোন ব্যত্যয় ঘটলে প্রবাসী কল্যাণ ও বৈদেশিক কর্মসংস্থান মন্ত্রণালয় অথবা জনশক্তি কর্মসংস্থান ও প্রশিক্ষণ ব্যুরো আমার বা আমার রিক্রুটিং এজেন্সীর বিরুদ্ধে বৈদেশিক কর্মসংস্থান ও অভিবাসী আইন-{{ $numto->bnNum(2013) }} অনুযায়ী যে কোন ব্যবস্থা গ্রহণ করতে পারবে।</div>
                    <div class="content_below">এই অঙ্গীকারনামায় আমি স্বেচ্ছায়, স্বজ্ঞানে, সুস্থ মস্থিষ্কে এবং কারো দ্বারা প্ররোচিত না হয়ে স্বাক্ষর করলাম।</div>
                </div>
            </div>
            <div class="undertaking_footer">
                <div class="footer_data">রিক্রুটিং এজেন্সীর নাম: {{ Auth::user()->title_bn }}</div>
                <div class="footer_data">মালিকের নাম: {{ Auth::user()->proprietor_bn }}</div>
            </div>
        </div>
    </div>
</div>

</body>
</html>