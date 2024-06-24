<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Embassy List</title>
    <link href="{{ asset('public/admin/assets/css/pdf/embassyList.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/assets/css/fonts.css') }}" rel="stylesheet">
</head>
<body>

<div class="app_wrapper clear">

    <div class="header_area clear">
        <div class="top_header clear">

            <div class="headline">
                <h2 class="visa_heading">بيـان بالجـوازات المقدمـة</h2>
            </div>

            <div class="office_heading">
                <div class="office_license">رقم الرخصة : {{ Auth::user()->license_ar }}</div>
                <div class="office_name">اسم مقدم الجوازات  : {{ Auth::user()->title_ar }}</div>
            </div>

            <div class="submission">
                <div class="submission_date">التاريخ : {{ date('j-m-Y', strtotime($submission_single_data[0]->submissionDate)) }}</div>
                <div class="signature">: الــتـــوقـيـــع </div>
            </div>
        </div>
    </div>

    <div class="content_area clear">
        <div class="content_table">
            <table id="visalist_table">
                <thead>
                    <tr>
                        <th>المهـنة<div class="relation_table">Profession</div></th>
                        <th>التـاريخ<div class="relation_table">Date</div></th>
                        <th>رقـم التـأشـيـرة<div class="relation_table">Visa Number</div></th>
                        <th>اسـم الكـفـيـل<div class="relation_table">Sponsor Name</div></th>
                        <th>رقـم الجـواز<div class="relation_table">Passport No.</div></th>
                        <th>الرقم<div class="relation_table">SL</div></th>
                    </tr>
                </thead>
                <tbody>

@foreach ($submission_count as $new_sub)
@if($new_sub->submissionType == 1)
                    <tr>
                        <td colspan="6"><h3>(جديد New)</h3></td>
                    </tr>
@endif
@endforeach

{{-- @if ($submission_count->isEmpty())
    <tr>
        <td colspan="6"><h3>(جديد New)</h3></td>
    </tr>
@else
    @foreach ($submission_count as $new_sub)
        @if($new_sub->submissionType == 1)
            <tr>
                <td colspan="6"><h3>(جديد New)</h3></td>
            </tr>
        @endif
    @endforeach
@endif --}}

@php
  $i=1;
@endphp
@foreach ($new_submission as $new_sub)
                    <tr>
                        <td>{{ $new_sub->occupation_ar }}</td>
@if($new_sub->visaYear != NULL)
                        <td>ھ {{ $new_sub->visaYear }}</td>
@else
                        <td>ھ {{ $new_sub->visa_date }}</td>
@endif
                        <td>{{ $new_sub->visano_ar }}</td>
                        <td>{{ $new_sub->sponsorname_ar }}</td>
                        <td>{{ $new_sub->passportNo }}</td>
                        <td>{{ $i++ }}</td>
                    </tr>
@endforeach

@foreach ($submission_count as $visa_ext)
@if($visa_ext->submissionType == 2)
                    <tr>
                        <td colspan="6"><h3>(تمديد Extension)</h3></td>
                    </tr>
@endif
@endforeach

@php
  $a=1;
@endphp
@foreach ($visa_extension as $visa_ext)
                    <tr>
                        <td>{{ $visa_ext->occupation_ar }}</td>
@if($visa_ext->visaYear != NULL)
                        <td>ھ {{ $visa_ext->visaYear }}</td>
@else
                        <td>ھ {{ $visa_ext->visa_date }}</td>
@endif
                        <td>{{ $visa_ext->visano_ar }}</td>
                        <td>{{ $visa_ext->sponsorname_ar }}</td>
                        <td>{{ $visa_ext->passportNo }}</td>
                        <td>{{ $a++ }}</td>
                    </tr>
@endforeach

@foreach ($submission_count as $renew)
@if($renew->submissionType == 3)
                    <tr>
                        <td colspan="6"><h3>(تجديد Renew)</h3></td>
                    </tr>
@endif
@endforeach

@php
  $b=1;
@endphp
@foreach ($visa_renew as $renew)
                    <tr>
                        <td>{{ $renew->occupation_ar }}</td>
@if($renew->visaYear != NULL)
                        <td>ھ {{ $renew->visaYear }}</td>
@else
                        <td>ھ {{ $renew->visa_date }}</td>
@endif
                        <td>{{ $renew->visano_ar }}</td>
                        <td>{{ $renew->sponsorname_ar }}</td>
                        <td>{{ $renew->passportNo }}</td>
                        <td>{{ $b++ }}</td>
                    </tr>
@endforeach

@foreach ($submission_count as $reissue)
@if($reissue->submissionType == 4)
                    <tr>
                        <td colspan="6"><h3>(اعادة Reissue)</h3></td>
                    </tr>
@endif
@endforeach

@php
  $c=1;
@endphp
@foreach ($visa_reissue as $reissue)
                    <tr>
                        <td>{{ $reissue->occupation_ar }}</td>
@if($reissue->visaYear != NULL)
                        <td>ھ {{ $reissue->visaYear }}</td>
@else
                        <td>ھ {{ $reissue->visa_date }}</td>
@endif
                        <td>{{ $reissue->visano_ar }}</td>
                        <td>{{ $reissue->sponsorname_ar }}</td>
                        <td>{{ $reissue->passportNo }}</td>
                        <td>{{ $c++ }}</td>
                    </tr>
@endforeach

@foreach ($submission_count as $replacement)
@if($replacement->submissionType == 5)
                    <tr>
                        <td colspan="6"><h3>(تبديل Replacement)</h3></td>
                    </tr>
@endif
@endforeach

@php
  $d=1;
@endphp
@foreach ($visa_replacement as $replacement)
                    <tr>
                        <td>{{ $replacement->occupation_ar }}</td>
@if($replacement->visaYear != NULL)
                        <td>ھ {{ $replacement->visaYear }}</td>
@else
                        <td>ھ {{ $replacement->visa_date }}</td>
@endif
                        <td>{{ $replacement->visano_ar }}</td>
                        <td>{{ $replacement->sponsorname_ar }}</td>
                        <td>{{ $replacement->passportNo }}</td>
                        <td>{{ $d++ }}</td>
                    </tr>
@endforeach

@foreach ($submission_count as $cancel)
@if($cancel->submissionType == 6)
                    <tr>
                        <td colspan="6"><h3>(إلغاء Cancel)</h3></td>
                    </tr>
@endif
@endforeach

@php
  $e=1;
@endphp
@foreach ($visa_cancel as $cancel)
                    <tr>
                        <td>{{ $cancel->occupation_ar }}</td>
@if($cancel->visaYear != NULL)
                        <td>ھ {{ $cancel->visaYear }}</td>
@else
                        <td>ھ {{ $cancel->visa_date }}</td>
@endif
                        <td>{{ $cancel->visano_ar }}</td>
                        <td>{{ $cancel->sponsorname_ar }}</td>
                        <td>{{ $cancel->passportNo }}</td>
                        <td>{{ $e++ }}</td>
                    </tr>
@endforeach
                    <tr>
                        <td style="border-right: 1px solid #fff;"></td>
                        <td style="border-right: 1px solid #fff;"></td>
                        <td style="border-right: 1px solid #fff;"></td>
                        <td></td>
                        <td colspan="2" style="font-weight: bold;">{{ $total_submission }} : المجموع</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>