@php
    $data = app('App\Http\Controllers\Client\CustomerPdfController');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Embassy File</title>
    <link href="{{ asset('public/admin/assets/css/pdf/embassyprint.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/assets/css/fonts.css') }}" rel="stylesheet">

</head>
<body>

<div class="app_wrapper clear">
    <div class="header_area clear">
        
@foreach ($embassy_single_data as $embassy)

        <div class="top_header clear">
            <div class="barcodecell top_barcode"><img src="{{ asset('public/admin/uploads/barcode/'.$embassy->visano_img) }}"  width="220"> 
                <div class="barcode_text">{{ $embassy->visano_en }}</div>
                <div class="barcode_doc">Document Date: {{ $embassy->visa_date }}</div>
            </div>
            <div class="top_mofa">{{ $embassy->mofa }}</div>
        </div>
@endforeach
        <div class="middle_header clear">
            <div class="left_middle">
                <div class="img_header">
                    <span class="arabic_middle">صورة</span>
                    <span class="english_middle">Photo</span>
                </div>
            </div>
            <div class="center_middle">
                <img src="{{ asset('public/admin/assets/images/ksa_logo.png') }}" width="60" alt="">
            </div>
            <div class="right_middle">
                <div class="right_arabic">سفارة المملكة العربية السعودية القسم القنصلي</div>
                <div class="right_english">Embassy Of Saudi Arabia <br> Consular Section</div>
            </div>
        </div>
    </div>
    <div class="main_content clear">
@foreach ($passport_single_data as $passport_data)
        <div class="name_description clear">
            <div class="cust_full">Full name:</div>
            <div class="cust_name">{{ $customer_single_data[0]->cusFname .' '. $customer_single_data[0]->cusLname }}</div>
            <div class="father_name">S/O: {{ $passport_data->father }}</div>
            <div class="cust_fullarabic">:الاسم الكامل</div>
        </div>
        <div class="mother_description clear">
            <div class="mother_full">Mother's name:</div>
            <div class="mother_name">{{ $passport_data->mother }}</div>
            <div class="mother_fullarabic">:إسم الأم</div>
        </div>

        <div class="birth_description clear">
            <div class="birth_full">Date of birth: </div>
            <div class="birth_dath">{{ date('d/m/Y', strtotime($passport_data->dateOfBirth)) }}</div>
            <div class="birth_datharabic">:تاريخ الولادة</div>
            <div class="birth_placefull">Place of birth: </div>
            <div class="birth_place">{{ $customer_single_data[0]->districtname }}</div>
            <div class="birth_placearabic">:محل الولادة</div>
        </div>

        <div class="nationality_description clear">
            <div class="nationality_previousfull">Previous nationality: </div>
@if(isset($passport_data->nationality))
            <div class="nationality_previous">{{ $passport_data->nationality }}</div>
@else
            <div class="nationality_previous">Bangladeshi</div>
@endif
            <div class="nationality_previousarabic">:الجنسية السابقة</div>

            <div class="nationality_presentfull">Present nationality: </div>
@if(isset($passport_data->nationality))
            <div class="nationality_present">{{ $passport_data->nationality }}</div>
@else
            <div class="nationality_present">Bangladeshi</div>
@endif
            <div class="nationality_presentarabic">:الجنسية الحالية</div>

        </div>
@endforeach
        <div class="social_status clear">
@if($customer_single_data[0]->gender == 1)
            <div class="gender_full">Sex:</div>
            <div class="gender_selection">
                <div class="gender_female">Female <span>أنثى</span></div>
                <div id="selected_option" class="gender_male">Male <span id="selected_option">ذكر</span></div>
            </div>
            <div class="gender_arabic">:الجنس</div>
@elseif($customer_single_data[0]->gender == 2)
            <div class="gender_full">Sex:</div>
            <div class="gender_selection">
                <div id="selected_option" class="gender_female">Female <span>أنثى</span></div>
                <div class="gender_male">Male <span>ذكر</span></div>
            </div>
            <div class="gender_arabic">:الجنس</div>
@endif
@foreach ($passport_single_data as $passport_data)
@if($passport_data->maritalStatus == 1)
            <div class="marital_statusfull">Marital Status: </div>
            <div class="marital_status">Single</div>
            <div class="marital_statusarabic">:الحالة الإجتماعية</div>
@elseif($passport_data->maritalStatus == 2)
            <div class="marital_statusfull">Marital Status: </div>
            <div class="marital_status">Married</div>
            <div class="marital_statusarabic">:الحالة الإجتماعية</div>
@endif
        </div>
@endforeach
@foreach ($embassy_single_data as $embassy)
        <div class="section_deen clear">
            <div class="section_full">Sect.: </div>
            <div class="section_name"> </div>
            <div class="section_arabic">:المـذهـــب</div>
            <div class="deen_full">Religion: </div>
            <div class="deen_name">{{ $embassy->religion }}</div>
            <div class="deen_arabic">:الديـانــة</div>
        </div>

        <div class="section_efficiencyarabic clear">
            <div class="issue_placearabic">:مصدره</div>
            <div class="qualification_arabic">:المؤهل العلمي</div>
            <div class="profession_namearabic">{{ $embassy->occupation_ar }}</div>
            <div class="profession_arabic">:المهنــة</div>
        </div>

        <div class="section_efficiency clear">
            <div class="issue_placefull">Place of issue: </div>
            <div class="issue_place"> </div>
            <div class="qualification_full">Qualification: </div>
            <div class="qualification"> </div>
            <div class="profession_full">Profession: </div>
            <div class="profession_name">{{ $embassy->occupation_en }}</div>
        </div>
@endforeach

@foreach ($passport_single_data as $passport_data)
        <div class="address_area clear">
            <div class="address_full">Home address and telephone No.: </div>
            <div class="address_all">{{ $passport_data->address }}</div>
            <div class="address_arabic">:عنوان المنزل ورقم التلفون</div>
        </div>
        <div class="district_area clear">
            <span class="address_district">{{ $passport_data->policestationname }}, {{ $passport_data->districtname }}</span>
        </div>
@endforeach

@foreach ($embassy_single_data as $embassy)
        <div class="business_area clear">
            <div class="business_full">Business address and telephone No.: </div>
            <div class="business_name">{{ Auth::user()->title }} ({{ Auth::user()->license }})</div>
            <div class="business_arabic">:عنوان الشركة (المؤسسة) ورقم التلفون</div>
        </div>
        <div class="business_address clear">
            <span class="business_location">{{ Auth::user()->address }}, {{ $embassy->policestationname }}, {{ $embassy->districtname }}</span>
        </div>
@endforeach
        <div class="purpose_travel clear">
            <div class="purpose_full">Purpose of travel: </div>
            <div class="purpose_all">
                <div id="selected_option" class="work_purpose"><div id="selected_option">عمل</div>Work</div>
                <div class="transit_purose"><div>مرور</div>Transit</div>
                <div class="visit_purose"><div>زيارة</div>Visit</div>
                <div class="umrah_purose"><div>عمـرة</div>Umrah</div>
                <div class="residence_purose"><div>للأقامة</div>Residence</div>
                <div class="hajj_purose"><div>حــج</div>Hajj</div>
                <div class="diplomacy_purose"><div>دبلوماسية</div>Diplomacy</div>
            </div>
            <div class="purose_arabic">:الغاية من السفر</div>
        </div>
@foreach ($passport_single_data as $passport_data)
        <div class="pasport_infoarabic clear">
            <div class="issue_placenamearabic">:محل الإصدار</div>
            <div class="issue_datenamearabic">:تاريخ الإصدار</div>
            <div class="passport_nofullarabic">:رقم الجواز</div>
        </div>

        <div class="passport_info clear">
            <div class="issue_placefullname">Place of issue:</div>
@if(isset($passport_data->issuePlace))
            <div class="issue_placename">{{ $passport_data->issuePlace }}</div>
@else
            <div class="issue_placename">Dip/Dhaka</div>
@endif
            <div class="issue_datefull">Date passport issued:</div>
            <div class="issue_date">{{ date('d/m/Y', strtotime($passport_data->passportIssue)) }}</div>
            <div class="passport_nofull">Passport No.:</div>
            <div class="passport_no">{{ $customer_single_data[0]->passportNo }}</div>
        </div>

        <div class="passport_information clear">
            <div class="expiry_datefull">Date of passport's expiry:</div>
            <div class="expiry_date">{{ date('d/m/Y', strtotime($passport_data->passportExpiry)) }}</div>
            <div class="expiry_datenamearabic">:تاريخ انتهاء صلاحية الجواز</div>
        </div>
@endforeach

@foreach ($embassy_single_data as $embassy)
        <div class="residency_infoarabic clear">
            <div class="residency_arabic">:مدة الإقامة بالمملكة</div>
            <div class="arrival_arabic">:تاريخ الوصول</div>
            <div class="departure_arabic">:تاريخ المغادرة</div>
        </div>
        
        <div class="residency_info clear">
            <div class="residency_full">Duration of stay in the Kingdom:</div>
            <div class="residency_time">{{ $embassy->visa_duration }}</div>
            <div class="arrival_full">Date of arrival:</div>
            <div class="departure_full">Date of Departure:</div>
        </div>
@endforeach
        <div class="payment_modearabic clear">
            <div class="payment_datearabic">:تاريخ</div>
            <div class="payment_noarabic">:ايصال     رقم (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>
            <div class="payment_chequedatearabic">:تاريخ</div>
            <div class="payment_chequenoarabic">:بشيك     رقم (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>
            <div class="payment_casharabic">نقدا (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>
            <div class="payment_freearabic">مجاملة</div>
            <div class="payment_typearabic">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;) :طريقة الدفع</div>
        </div>
        <div class="payment_mode clear">
            <div class="payment_type">Mode of Payment:</div>
            <div class="payment_free">(     ) Free</div>
            <div class="payment_cash">(     ) Cash</div>
            <div class="payment_chequeno">(     ) Cheque No.</div>
            <div class="payment_chequedate">Date</div>
            <div class="payment_symbol">(&nbsp;&nbsp;&nbsp;&nbsp;)</div>
            <div class="payment_no">No.</div>
            <div class="payment_date">Date:</div>
        </div>

        <div class="relation_arabic clear">
            <div class="relationship_arabic">:صلتـــه</div>
            <div class="relationship_namearabic">:اسم المحرم</div>
        </div>
        <div class="relation clear">
            <span class="relationship">Relationship: </span>
        </div>

        <div class="destination clear">
            <div class="destination_full">Destination</div>
            <div class="destination_fullarabic">:جهة الوصول بالمملكة</div>
            <div class="destination_carrier">Carrier\'s name: </div>
            <div class="destination_carrierarabic">:اسم الشركة الناقلة</div>
        </div>
@foreach ($embassy_single_data as $embassy)
        <div class="dependents clear">
            <div class="dependents_full">Dependents traveling in the same passport:</div>
            <div class="dependents_arabic">:ايضاحات تخص أفراد العائلة (المضافين) على نفس جواز السفر</div>
        </div>

        <div class="dependents_table clear">
            <table id="mydependents">
                <thead>
                    <tr>
                        <th width="30%" class="relation_table">نوع الصلة<div style="font-size: 12px; font-family: playfair;">Relationship</div></th>
                        <th class="birthdate_table">تــــاريـخ الميـــــلاد<div style="font-size: 12px; font-family: playfair;">Date of Birth</div></th>
                        <th class="gender_table">الجنـــــــــــــس<div style="font-size: 12px; font-family: playfair;">Sex</div></th>
                        <th width="30%" class="fullname_table">الاسم بــــالكــــــامل<div style="font-size: 12px; font-family: playfair;">Full name</div></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Group: {{ $embassy->delegated_visa }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>City: {{ $embassy->visa_address }}</td>
                        <td></td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Tel:</td>
                        <td></td>
                        <td> </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="employer clear">
            <div class="employer_full">Name and address of company or individual in the kingdom:</div>
            <div class="employer_fullarabic">:اسم وعنوان الشركة أو اسم الشخص وعنوانه بالمملكة</div>
        </div>
        <div class="employer_name clear">{{ $embassy->sponsorname_en }}
        </div>

        <div class="recognition clear">
            <div class="recognition_full">
                The undersigned hereby certify that all the information I have provided are correct.
                I will abide by the laws of the Kingdom during the period of my residence in it.
            </div>
            <div class="recognition_fullarabic">
            أنا الموقع أدناه أقر بأن كل المعلومات التي دونتها صحيحة وسأكون ملتزما بقوانين المملكة اثناء فترة وجودي بها
            </div>
        </div>

        <div class="signature clear">
            <div class="signature_datefull">Date:</div>
@if(isset($embassy->embassy_submission))
            <div class="signature_date">{{ date('d/m/Y', strtotime($embassy->embassy_submission)) }}</div>
@else
<div class="signature_date">{{ date('d/m/Y', strtotime($embassy->submissionDate)) }}</div>
@endif
            <div class="signature_datearabic">:التاريخ</div>
            <div class="signature_full">Signature:</div>
            <div class="signature_fullarabic">:التوقيع</div>
            <div class="signature_namefull">Name:</div>
            <div class="signature_name">{{ $customer_single_data[0]->cusFname .' '. $customer_single_data[0]->cusLname }}</div>
            <div class="signature_namearabic">:الاسم</div>
        </div>

        <div class="official_only clear">
            <div class="official_full">For official use only:</div>
            <div class="official_arabic">:للاستعمال الرسمي فقط</div>
        </div>
        <div class="authorization clear">
            <div class="hijri_datefull">Date:</div>
            <div class="hijri">ھ</div>
            <div class="hijri_date">{{ $embassy->visa_date }}</div>
            <div class="hijri_datearabic">:تاريخه</div>
            <div class="authorization_full">Authorization:</div>
            <div class="authorization_visa">{{ $embassy->visano_ar }}</div>
            <div class="authorization_arabic">رقم الامر المعتمد عليه في اعطاء التأشيرة</div>
        </div>
        <div class="company_name clear">
            <div class="work_for">Visit /Work for:</div>
            <div class="company_namearabic">{{ $embassy->sponsorname_ar }}</div>
            <div class="work_forarabic">:لزيارة – العمل لدى</div>
        </div>

        <div class="visa_info clear">
            <div class="visa_date">Date:</div>
            <div class="visa_datearabic">وتاريخ</div>
            <div class="visa_nofull">Visa No.:</div>
            <div class="visa_nofullarabic">:أشر له برقم</div>
        </div>
        <div class="payment clear">
            <div class="fee_collection">FEE COLLECTED:</div>
            <div class="fee_collectionarabic">المبلغ المحصل</div>
            <div class="visa_type">Type:</div>
            <div class="visa_typearabic">:نوعها</div>
            <div class="visa_duration">Duration:</div>
            <div class="visa_durationarabic">:مدتها</div>
        </div>

        <div class="consular_arabic clear">
            <div class="consular_leftarabic">رئيس القسم القنصلي</div>
            <div class="employer_id">{{ $embassy->sponsorid_ar }}</div>
            <div class="employer_middlearabic">:رقم الكفيل</div>
            <div class="consular_rightarabic">مدقق البيانات</div>
        </div>

        <div class="consular_section clear">
            <div class="consular_left">Head of consular section</div>
            <div class="consular_right">Checked by:</div>
        </div>

        <div class="barcodecell passport_barcode clear"><img src="{{ asset('public/admin/uploads/passcode/'.$customer_single_data[0]->passport_img) }}"  width="220">
            <div class="barcode_text">{{ $customer_single_data[0]->passportNo }}</div>
        </div>
@endforeach
    </div>
</div>

<pagebreak></pagebreak>
{{-- Contract Area --}}
    <div class="contract_area clear">
        <div class="contract_headline clear">
            <div class="contract_headlineleft">Employment Contract</div>
            <div class="contract_headlineright">عـــــقـد عــمـــــــــل</div>
        </div>

        <div class="contract_header clear">
            <table id="contract_thead">
                <thead>
@foreach ($embassy_single_data as $embassy)
                    <tr>
                        <th class="left_side">First Party</th>
                        <th class="middle_side">: {{ $embassy->sponsorname_en }}</th>
                        <th class="right_side">:الطـــــــــرف الأول</th>
                    </tr>
                    <tr>
                        <th class="left_side">Second Party</th>
                        <th class="middle_side">: {{ $customer_single_data[0]->cusFname .' '. $customer_single_data[0]->cusLname }}</th>
                        <th class="right_side">:الطـــــــرف الثاني</th>
                    </tr>
@endforeach

@foreach ($passport_single_data as $passport_data)
                    <tr>
                        <th class="left_side">Nationality</th>
                        @if(isset($passport_data->issuePlace))
                        <th class="middle_side">: {{ $passport_data->nationality }}</th>
@else
                        <th class="middle_side">: Bangladeshi</th>
@endif
                        <th class="right_side">:الجنســـــــــــــــيـــة</th>
                    </tr>
@endforeach

@foreach ($embassy_single_data as $embassy)
                    <tr>
                        <th class="left_side">Passport No.</th>
                        <th class="middle_side">: {{ $customer_single_data[0]->passportNo }}</th>
                        <th class="right_side">:جواز ســـــفر رقم</th>
                    </tr>
                    <tr>
                        <th class="left_side">Profession</th>
                        <th class="middle_side">: {{ $embassy->occupation_en }}</th>
                        <th class="right_side">:المــهــــــــــــــــنـــة</th>
                    </tr>
@endforeach
                </thead>
            </table>
        </div>

        <div class="contract_body clear">
            <table id="contract_tbody">
                <tbody>
                    <tr>
                        <td>01</td>
                        <td></td>
                        <td class="body_left">That the First Party shall pay to the Second Party a monthly salary of 1000 SR. plus overtime accordingly to Saudi Labor Law.</td>
                        <td class="body_right">ان الطرف الأول يدفع الطرف الثاني راتب شهري ١٠٠٠ ريال سعودي بالإضافة حسب القانون العامل المملكة العربية السعودية.</td>
                        <td></td>
                        <td>١</td>
                    </tr>
                    <tr>
                        <td>02</td>
                        <td></td>
                        <td class="body_left">That the First Party should provide Second Party free medical, free single accommodation and free food facilities during the period of contract in the Kingdom of Saudi Arabia.</td>
                        <td class="body_right">يلتزم الطرف الأول الطلب السكن الطرف الثاني مجانا خلال مدة المملكـــــة العربية السعودية.</td>
                        <td></td>
                        <td>٢</td>
                    </tr>
                    <tr>
                        <td>03</td>
                        <td></td>
                        <td class="body_left">That the First Party shall provide free transportation from resident to the work site.</td>
                        <td class="body_right">يلتزم بالطرف الأول النقل للطرف الثاني من السكن إلى محل العمل مجانا</td>
                        <td></td>
                        <td>٣</td>
                    </tr>
                    <tr>
                        <td>04</td>
                        <td></td>
                        <td class="body_left">The period of contract is 2 (two) years.</td>
                        <td class="body_right">ان مدة العقد سنتان.</td>
                        <td></td>
                        <td>٤</td>
                    </tr>
                    <tr>
                        <td>05</td>
                        <td></td>
                        <td class="body_left">That the First Party shall bear the passage cost from Dhaka to K.S.A. and back to Dhaka for joining the service and return ticket would provide after completion this agreement.</td>
                        <td class="body_right">حيث الطرف الأول يدفع قيمة التذكرة خطوط الجوية للطرف الثاني من كمندوب والى المملكة المباشرة العمل وتذكرية العودة إلى كمندوب وبعد انتهاء مدة.</td>
                        <td></td>
                        <td>٥</td>
                    </tr>
                    <tr>
                        <td>06</td>
                        <td></td>
                        <td class="body_left">Daily working hours shall be 8 hours.</td>
                        <td class="body_right">ساعات العمل يكون ثماني (٨) ساعات يوميا.</td>
                        <td></td>
                        <td>٦</td>
                    </tr>
                    <tr>
                        <td>07</td>
                        <td></td>
                        <td class="body_left">That this agreement shall come in effect from the date of arrival of the Second Party in the Kingdom of Saudi Arabia.</td>
                        <td class="body_right">حيث أن هذا العقد يعتبر بعد وصول الطرف الثاني في المملكة العربية السعودية.</td>
                        <td></td>
                        <td>٧</td>
                    </tr>
                    <tr>
                        <td>08</td>
                        <td></td>
                        <td class="body_left">That the Second Party should undertake to abide by the instruction and rules enforced in the Kingdom of Saudi Arabia.</td>
                        <td class="body_right">حيث أن الطرف الثاني ليجمع التعليمات والقرارات الساري المفعول في المملكة العربية السعودية.</td>
                        <td></td>
                        <td>٨</td>
                    </tr>
                    <tr>
                        <td>09</td>
                        <td></td>
                        <td class="body_left">That the any other terms and conditions not mentioned in the demand letter shall be following as per Saudi labor Laws.</td>
                        <td class="body_right">حيث أن أي شرط لم يذكر في ورقة الطلب يعمل حسب القانون العامل المملة العربية السعودية.</td>
                        <td></td>
                        <td>٩</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="left_footer">Signature of the First Party :..................................</td>
                        <td class="right_footer">................................:توقيع الطرف الأول</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="left_footer">Signature of the Second Party :.............................</td>
                        <td class="right_footer">................................:توقيع الطرف الثاني</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

<pagebreak></pagebreak>
{{-- Consular Letter Area --}}
    <div class="consular_area">
        <div class="cosular_header">
            <div class="application_to">To</div>
            <div class="application_consular">His Excellency The Chief Of Consulate Section</div>
            <div class="application_embassy">Royal Embassy Of Saudi Arabia</div>
            <div class="application_address">Dhaka, Bangladesh</div>
        </div>

        <div class="cosular_body">
            <div class="body_top">With due respect we are submitting one passport for work visa with all necessary documents and particulars mentioned as bellow knowing all instructions and regulations of consulate section.</div>
            <div class="body_center">
                <table id="consular_table">
                    <tbody>
                    @foreach ($embassy_single_data as $embassy)
                        <tr>
                            <td>01.</td>
                            <td>Name Of The Employer In Saudi Arabia</td>
                            <td>:</td>
                            <td>{{ $embassy->sponsorname_en }}, {{ $embassy->visa_address }}, Saudi Arabia</td>
                        </tr>
                        <tr>
                            <td>02.</td>
                            <td>Visa No. And Date</td>
                            <td>:</td>
                            <td>{{ $embassy->visano_en }}, Date : {{ $embassy->visa_date }} H</td>
                        </tr>
                    @endforeach 
                        <tr>
                            <td>03.</td>
                            <td>Full Name Of The Employee</td>
                            <td>:</td>
                            <td>{{ $customer_single_data[0]->cusFname .' '. $customer_single_data[0]->cusLname }}</td>
                        </tr>
                    @foreach ($passport_single_data as $passport_data)
                        <tr>
                            <td>04.</td>
                            <td>Passport No. And Date</td>
                            <td>:</td>
                            <td>{{ $customer_single_data[0]->passportNo }}, Date : {{ date('d/m/Y', strtotime($passport_data->passportIssue)) }}</td>
                        </tr>
                    @endforeach
                    @foreach ($embassy_single_data as $embassy)
                        <tr>
                            <td>05.</td>
                            <td>Profession</td>
                            <td>:</td>
                            <td>{{ $embassy->occupation_en }}</td>
                        </tr>
                        <tr>
                            <td>06.</td>
                            <td>Religion</td>
                            <td>:</td>
                            <td>{{ $embassy->religion }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
@foreach ($embassy_single_data as $embassy)
            <div class="body_bottom">We do hereby confirm and declare that religion stated in the visa form and forwarding letter is fully correct we also undertake the responsibility to cancel the visa and to stop functioning with our office if the statement is found incorrect.</div>
            <div class="body_footer">We therefore request your Excellency to kindly issue work visa out of <b>{{ $embassy->delegated_visa }} ({{ $data->convertNumberEmbassy($embassy->delegated_visa) }})</b> visa and oblige thereby.</div>
@endforeach
        </div>
        <div class="cosular_footer">
            <div class="footer_application">Yours Faithfully</div>
            <div class="proprietor_name">({{ Auth::user()->proprietor }})</div>
            <div class="proprietor_title">{{ Auth::user()->proprietortitle }}</div>
            <div class="office_name">{{ Auth::user()->title }}</div>
            <div class="license_no">Lic. No. {{ Auth::user()->license }}</div>
        </div>
    </div>

<pagebreak></pagebreak>
{{-- Chart Form --}}
    <div class="form_chart">
        <div class="arabic_heading">إرفاق الجدول التالي في كل معاملة</div>
        <div class="bangla_heading">প্রতিটি পাসপোর্টের সাথে নিম্নলিখিত ফরমটি সংযুক্ত করুন</div>

        <div class="chart_table">
            <table id="table_chart">

                <thead>
                    <tr>
                        <th>ব্যবস্থা</th>
                        <th>
                            <div class="th_ar" style="font-family: arial; font-weight: bold;">الملاحظات</div>
                            <div class="th_bn">মতামত</div>
                        </th>
                        <th>
                            <div class="th_ar" style="font-family: arial; font-weight: bold;">المنفذ</div>
                            <div class="th_bn">বন্দর</div>
                        </th>
                        <th>
                            <div class="th_ar" style="font-family: arial; font-weight: bold;">المكتب</div>
                            <div class="th_bn">অফিস</div>
                        </th>
                        <th>
                            <div class="th_ar" style="font-family: arial; font-weight: bold;">الإجراء</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($embassy_single_data as $embassy)
                    <tr>
                        <td class="td_bn">ইঞ্জাজ নম্বর</td>
                        <td></td>
                        <td></td>
                        <td class="td_data">{{ $embassy->mofa }}</td>
                        <td class="td_ar">رقم إنجاز</td>
                    </tr>
                    <tr>
                        <td class="td_bn">ভিসা নম্বর</td>
                        <td></td>
                        <td></td>
                        <td class="td_data">{{ $embassy->visano_en }}</td>
                        <td class="td_ar">رقم المستند</td>
                    </tr>
                @endforeach
                    <tr>
                        <td class="td_bn">নাম পাসপোর্টে যেমন আছে</td>
                        <td></td>
                        <td></td>
                        <td class="td_data" style="font-size: 15px;">{{ $customer_single_data[0]->cusFname .' '. $customer_single_data[0]->cusLname }}</td>
                        <td class="td_ar">الإسم في الجواز</td>
                    </tr>
                    <tr>
                        <td class="td_bn">পাসপোর্ট নম্বর</td>
                        <td></td>
                        <td></td>
                        <td class="td_data">{{ $customer_single_data[0]->passportNo }}</td>
                        <td class="td_ar">رقم الجواز</td>
                    </tr>
                @foreach ($passport_single_data as $passport_data)
                    <tr>
                        <td class="td_bn">পাসপোর্টের বৈধতার তারিখ</td>
                        <td></td>
                        <td></td>
                        <td class="td_data">{{ date('d/m/Y', strtotime($passport_data->passportExpiry)) }}</td>
                        <td class="td_ar">صلاحية الجواز</td>
                    </tr>
                @endforeach
                @foreach ($embassy_single_data as $embassy)
                    <tr>
                        <td class="td_bn">বয়স</td>
                        <td></td>
                        <td></td>
                        <td class="td_data" style="font-size: 14px;">{{ $embassy->age }}</td>
                        <td class="td_ar">العمر</td>
                    </tr>
                @endforeach
                    <tr>

                        <td class="td_bn">লিঙ্গ</td>
                        <td></td>
                        <td></td>
@if($customer_single_data[0]->gender == 1)
                        <td class="td_data">Male</td>
@elseif($customer_single_data[0]->gender == 2)
                        <td class="td_data">Female</td>
@endif
                        <td class="td_ar">الجنس</td>
                    </tr>
@foreach ($customer_single_docs as $documents)
                    <tr>
                        <td class="td_bn">মুসানেদ</td>
                        <td></td>
                        <td></td>
                        <td class="td_data">{{ $documents->musaned }}</td>
                        <td class="td_ar">مساند</td>
                    </tr>
@endforeach

@foreach ($embassy_single_data as $embassy)
                    <tr>
                        <td class="td_bn">ওকালা</td>
                        <td></td>
                        <td></td>
                        <td class="td_data">{{ $embassy->delegation_no }}</td>
                        <td class="td_ar">الوكالة</td>
                    </tr>
@endforeach
                    <tr>

                        <td class="td_bn">মেডিকেল রিপোর্ট</td>
                        <td></td>
                        <td></td>
@if($customer_single_data[0]->medical == 1)
                        <td class="td_data">Done</td>
@elseif($customer_single_data[0]->medical == 2)
                        <td class="td_data">Fit</td>
@elseif($customer_single_data[0]->medical == 3)
                        <td class="td_data">Unfit</td>
@elseif($customer_single_data[0]->medical == 4)
                        <td class="td_data">N/A</td>
@elseif($customer_single_data[0]->medical == 5)
                        <td class="td_data">Problem</td>
@endif
                        <td class="td_ar">فحص طبي</td>

                    </tr>
@foreach ($customer_single_docs as $documents)
                    <tr>
                        <td class="td_bn">পুলিশ ক্লিয়ারেন্স</td>
                        <td></td>
                        <td></td>
                        <td class="td_data">{{ $documents->pc }}</td>
                        <td class="td_ar">ورقة الشرطة</td>
                    </tr>
                    <tr>
                        <td class="td_bn">লাইসেন্স</td>
                        <td></td>
                        <td></td>
                        <td class="td_data">{{ $documents->license }}</td>
                        <td class="td_ar">الرخصة</td>
                    </tr>
@endforeach
@foreach ($embassy_single_data as $embassy)
                    <tr>
                        <td class="td_bn">পেশা</td>
                        <td></td>
                        <td></td>
                        <td class="td_data" style="font-size: 15px;">{{ $embassy->occupation_ar }}</td>
                        <td class="td_ar">المهنة</td>
                    </tr>
@endforeach
@foreach ($customer_single_docs as $documents)
                    <tr>
                        <td class="td_bn">যোগ্যতা এবং অভিজ্ঞতা সার্টিফিকেট</td>
                        <td></td>
                        <td></td>
                        <td class="td_data">{{ $documents->certificate }}</td>
                        <td class="td_ar">المؤهل وشهادة الخبرة</td>
                    </tr>
                    <tr>
                        <td class="td_bn">ফিঙ্গারপ্রিন্ট</td>
                        <td></td>
                        <td></td>
                        <td class="td_data">{{ $documents->finger }}</td>
                        <td class="td_ar">البصمة</td>
                    </tr>
@endforeach
                </tbody>
            </table>
        </div>
        <div class="office_info">
            <div class="name_info">
                <div class="office_full">অফিসের নাম:</div>
                <div class="office_name">{{ Auth::user()->title }}</div>
                <div class="office_namearabic">{{ Auth::user()->title_ar }}</div>
                <div class="office_arabic">:اسم المكتب</div>
            </div>
            <div class="license_info">
                <div class="rl_full">লাইসেন্স নম্বর:</div>
                <div class="rl_no">{{ Auth::user()->license }}</div>
                <div class="rl_noarabic">{{ Auth::user()->license_ar }}</div>
                <div class="rl_arabic">:رقم الرخصة</div>
            </div>
            <div class="sign">
                <div class="sign_bangla">স্বাক্ষর: ......................................................</div>
                <div class="sign_arabic">............................................:التوقيع</div>
            </div>
            <div class="seal">
                <div class="seal_bangla">সিল: .........................................................</div>
                <div class="seal_arabic">..............................................:الختم</div>
            </div>
        </div>
    </div>
</body>
</html>