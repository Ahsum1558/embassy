@php
    $data = app('App\Helpers\BanglaNumberConverter');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Letter</title>
    <link href="{{ asset('public/admin/assets/css/pdf/letterprintUpdate.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/assets/css/fonts.css') }}" rel="stylesheet">
</head>
<body>

{{-- Application Letter Area --}}
    <div class="application_area">
        <div class="letter_header">
            <div class="application_to">বরাবর,</div>
            <div class="application_head">মহা-পরিচালক</div>
            <div class="application_bmet">জনশক্তি, কর্মসংস্থান ও প্রশিক্ষণব্যুরো</div>
            <div class="application_address">{{ $numto->bnNum(89) }}/{{ $numto->bnNum(2) }}, কাকরাইল, ঢাকা।</div>
        </div>
        <div class="letter_subject">
            <div class="application_view">দৃষ্টি আকর্ষণ: পরিচালক (বহির্গমন)</div>
            <div class="subject_name">বিষয়:</div>
            <div class="subject">সৌদি আরবগামী ষ্ট্যাম্পিংকৃত ভিসায় {{ $numto->bnNum($total_customer) }} ({{ $numto->bnWord($total_customer) }}) জন পুরুষ কর্মীর একক বহির্গমন ছাড়পত্রের জন্য আবেদন।</div>
        </div>

        <div class="letter_body">
            <div class="greeting">
                জনাব,
            </div>
            <div class="greeting_body">
                বিনীত নিবেদন এই যে,
            </div>
            <div class="training_table">
                <table id="customersData">
                    <thead>
                        <tr>
                            <th>ক্র. নং</th>
                            <th>কর্মীর নাম</th>
                            <th>পাসপোর্ট নং</th>
                            <th>আরএল নম্বর</th>
                            <th>ভিসা নম্বর</th>
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
                            <td>{{ $manpower_data[0]->license }}</td>
                            <td>
                                {{ $customer->visano_en }} &nbsp;&nbsp;&nbsp; {{ $customer->sponsorid_en }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="body_top">সৌদি আরব গমনেচ্ছুক {{ $numto->bnNum($total_customer) }} ({{ $numto->bnWord($total_customer) }}) জন পুরুষ কর্মী তাদের স্ব-উদ্যোগে সংগৃহীত ভিসা, মূল পাসপোর্ট সহ অন্যান্য কাগজ পত্রাদি আমার রিক্রুটিং এজেন্সী {{ $manpower_data[0]->title_bn }} ({{ $manpower_data[0]->license_bn }}) এর মাধ্যমে বহির্গমন ছাড়পত্র গ্রহণের জন্য জমা দিয়েছে। কর্মীদের নিকট হতে প্রাপ্ত ভিসা সহ নিম্নে বর্ণিত কাগজ পত্রাদি এতদ সঙ্গে দাখিল করলাম। ভিসাগুলো আমার অফিসে পরীক্ষান্তে সঠিক পাওয়া গিয়েছে এবং সৌদি আরব হতে প্রাপ্ত ওকালার সাথে মিল আছে। উল্লেখ্য যে, ভিসাগুলো {{ $numto->bnNum(25) }} এর অধিক বা গ্রুপ ভিসা নই। উপস্থাপিত কর্মীগণের ভিসাগুলো <strong>EMPLOYMENT</strong> ভিসা। যার মেয়াদ {{ $numto->bnNum(2) }} বৎসর এবং পরবর্তীতে নবায়নযোগ্য। কর্মীগণের বেতন, ভাতাদি, থাকা, খাওয়া, সামাজিক নিরাপত্তা বা অন্য কোন কারণে চাকুরিতে অসুবিধা হলে তার সকলের দায়িত্ব আমার রি/এজেন্সী বহন করতে বাধ্য থাকবে।</div>
            <div class="body_center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;অতএব, মহোদয় সমীপে বিনীত আরজ, সৌদি আরব গমনেচ্ছুক {{ $numto->bnNum($total_customer) }} ({{ $numto->bnWord($total_customer) }}) জন পুরুষ কর্মীর অনুকূলে একক ভিসায় বহির্গমন ছাড়পত্র প্রদানের বিষয়ে সদয় মর্জি হয়।</div>
            <div class="body_bottom">
                <div class="left_body">
                    <div class="left_bottom">সংযুক্তিঃ</div>
                    <div class="left_bottom">{{ $numto->bnNum(1) }}। {{ $numto->bnNum(300) }} টাকার নন-জুডিশিয়াল ষ্ট্যাম্পে অঙ্গীকারনামা।</div>
                    <div class="left_bottom">{{ $numto->bnNum(2) }}। পাসপোর্ট, চুক্তিপত্র ও ভিসার ফটোকপি।</div>
                    <div class="left_bottom">{{ $numto->bnNum(3) }}। পে-অর্ডার ও চালানের মূলকপি।</div>
                    <div class="left_bottom">{{ $numto->bnNum(4) }}। প্রশিক্ষণ সনদের মূলকপি।</div>
                    <div class="left_bottom">{{ $numto->bnNum(5) }}। উপস্থাপিত (<small style="font-family: playfair;">PUT UP</small>) তালিকা।</div>
                    <div class="left_bottom">{{ $numto->bnNum(6) }}। কর্মীর ডাটাশীট।</div>
                </div>
                <div class="right_body">
                    <div class="right_bottom">রিক্রুটিং এজেন্সীর নামঃ {{ Auth::user()->title_bn }}</div>
                    <div class="right_bottom">স্বত্তাধিকারী {{ Auth::user()->proprietor_bn }}</div>
                    <div class="right_bottom">স্বাক্ষর ও সীলঃ</div>
                    <div class="right_bottom">তারিখঃ</div>
                    <div class="right_bottom">মোবাইল নং: {{ $numto->bnNum(Auth::user()->phone) }}</div>
                </div>
            </div>
            <div class="body_footer">প্রতিনিধি: {{ Auth::user()->name }}</div>
            <div class="body_footerno">মোবাইল নং: {{ Auth::user()->telephone_bn }}</div>
        </div>
    </div>
</body>
</html>