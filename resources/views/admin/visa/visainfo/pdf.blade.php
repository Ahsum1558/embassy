<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="{{ asset('public/admin/assets/css/pdf/visaList.css') }}" rel="stylesheet">

</head>
<body>
    <div class="app_wrapper clear">
        <div class="header_area clear">
            <div class="top_header clear">
                <div class="headline">
                    <h3 class="visa_heading">Visa List</h3>
                </div>
            </div>
        </div>
        <div class="content_area clear">
            <div class="content_table">
                <table id="visalist_table">

                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Visa No.</th>
                            <th>Sponsor Id</th>
                            <th>Sponsor Name</th>
                            <th>Visa</th>
                            <th>Used</th>
                            <th>Rem.</th>
                            <th>Delegated</th>
                        </tr>
                    </thead>
                    <tbody>

                    @php
                        $i=1;
                        $totalVisa = 0;
                        $usedVisa = 0;
                        $remainingVisa = 0;
                    @endphp
                        @foreach($all_visa as $visa)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $visa->visano_en }}</td>
                            <td>{{ $visa->sponsorid_en }}</td>
                            <td>{{ $visa->sponsorname_en }}</td>
                            <td>{{ $visa->delegated_visa }}</td>
                            <td>{{ isset($visaCounts[$visa->id]) ? $visaCounts[$visa->id] : 0 }}</td>
                        @if(isset($visaCounts[$visa->id]) && $visa->delegated_visa - $visaCounts[$visa->id] >= 0)
                            <td>{{ $visa->delegated_visa - $visaCounts[$visa->id] }}</td>
                        @else
                            <td>0</td>
                        @endif
                            <td>{{ date('d-M-Y', strtotime($visa->delegation_date)) }}</td>
                        </tr>
                    @php
                        $primaryVisa = $visa->delegated_visa;
                        $totalVisa = $totalVisa + $primaryVisa;

                        $primaryUsed = isset($visaCounts[$visa->id]) ? $visaCounts[$visa->id] : 0;
                        $usedVisa = $usedVisa + $primaryUsed;
                        $remainingVisa = $totalVisa - $usedVisa;
                    @endphp
                   @endforeach
                    <tr>
                        <th colspan="4" class="my_table" style="text-align: left;">Total Visa</th>
                        <th class="right_table">{{ number_format($totalVisa) }}</th>
                        <th class="right_table">{{ number_format($usedVisa) }}</th>
                        <th class="right_table">{{ number_format($remainingVisa) }}</th>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>