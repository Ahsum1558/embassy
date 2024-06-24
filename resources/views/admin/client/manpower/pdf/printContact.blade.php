<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contract Page</title>
    <link href="{{ asset('public/admin/assets/css/pdf/embassyprint.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/assets/css/fonts.css') }}" rel="stylesheet">

</head>
<body>


{{-- Contract Area --}}
    <div class="contract_area clear">

        <div class="contract_headline clear">
            <div class="contract_headlineleft">Employment Contract</div>
            <div class="contract_headlineright">عـــــقـد عــمـــــــــل</div>
        </div>

        <div class="contract_header clear">
            <table id="contract_thead">
                <thead>
                    <tr>
                        <th class="left_side">First Party</th>
                        <th class="middle_side">: {{ $manpower_customers[0]->sponsorname_en }}</th>
                        <th class="right_side">:الطـــــــــرف الأول</th>
                    </tr>
                    <tr>
                        <th class="left_side">Second Party</th>
                        <th class="middle_side">: {{ $manpower_customers[0]->cusFname .' '. $manpower_customers[0]->cusLname }}</th>
                        <th class="right_side">:الطـــــــرف الثاني</th>
                    </tr>

                    <tr>
                        <th class="left_side">Nationality</th>
                        <th class="middle_side">: {{ $manpower_customers[0]->nationality }}</th>
                        <th class="right_side">:الجنســـــــــــــــيـــة</th>
                    </tr>
                    <tr>
                        <th class="left_side">Passport No.</th>
                        <th class="middle_side">: {{ $manpower_customers[0]->passportNo }}</th>
                        <th class="right_side">:جواز ســـــفر رقم</th>
                    </tr>
                    <tr>
                        <th class="left_side">Profession</th>
                        <th class="middle_side">: {{ $manpower_customers[0]->occupation_en }}</th>
                        <th class="right_side">:المــهــــــــــــــــنـــة</th>
                    </tr>
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

</body>
</html>