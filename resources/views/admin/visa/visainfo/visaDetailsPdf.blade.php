<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="{{ asset('public/admin/assets/css/pdf/visaDetails.css') }}" rel="stylesheet">
</head>
<body>
    <div class="app_wrapper clear">
        <div class="header_area clear">
            <div class="top_header clear">
                <div class="headline">
                    <h3 class="visa_heading">Details Of Visa Number : {{ $single_visa->visano_en }}</h3>
                    <h3 class="visa_barcode" style="text-align: center;"><img class="barcode_img" src="{{ (!empty($single_visa->visano_img)) ? url('public/admin/uploads/barcode/'.$single_visa->visano_img) : url('public/admin/assets/images/avatar.png') }}" width="200"></h3>

                    
                </div>
            </div>
        </div>
        <div class="content_area clear">
            <div class="content_info clear">
                <div class="content_details clear">
                    <div class="left_content">Visa Number: <span>{{ $single_visa->visano_en }}</span> </div>
                    <div class="right_content">Sponsor Id: <span>{{ $single_visa->sponsorid_en }}</span> </div>
                </div>
                <div class="content_details clear">
                    <div class="left_content">Sponsor English: <span>{{ $single_visa->sponsorname_en }}</span> </div>
                    <div class="right_content">Sponsor Arabic: <span>{{ $single_visa->sponsorname_ar }}</span> </div>
                </div>
                <div class="content_details clear">
                    <div class="left_content">Occupation English: <span>{{ $single_visa->occupation_en }}</span> </div>
                    <div class="right_content">Occupation Arabic: <span>{{ $single_visa->occupation_ar }}</span> </div>
                </div>
                <div class="content_details clear">
                    <div class="left_content">Visa Date: <span>{{ $single_visa->visa_date }} Hijri</span> </div>
                    <div class="right_content">Visa Address: <span>{{ $single_visa->visa_address }}</span> </div>
                </div>
                <div class="content_details clear">
                    <div class="left_content">Visa Delegation/ Wakaalah No.: <span>{{ $single_visa->delegation_no }}</span> </div>
                    <div class="right_content">Visa Delegation/ Wakaalah Date: <span>{{ date('d-M-Y', strtotime($single_visa->delegation_date)) }}</span> </div>
                </div>
                <div class="content_details clear">
                    <div class="left_content">Total Delegated Visa: <span>{{ $single_visa->delegated_visa }}</span> </div>
                    <div class="right_content">Total Used: <span>{{ $visaCounts[$single_visa->id] ?? 0 }}</span> </div>
                </div>
                <div class="content_details clear">
                    <div class="left_content">Total Remaining Visa: 
                        <span>
                        @if(isset($visaCounts[$single_visa->id]) && $single_visa->delegated_visa - $visaCounts[$single_visa->id] >= 0)
                                    {{ $single_visa->delegated_visa - $visaCounts[$single_visa->id] }}
                                @else
                                    {{ 0 }}
                                @endif
                        </span> 
                    </div>
                    <div class="right_content">Contract Duration: <span>{{ $single_visa->visa_duration }}</span> </div>
                </div>
            </div>
            <div class="content_table clear">
                <h3 class="customers_heading">Customers Information</h3>
                <table id="visalist_table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Serial</th>
                            <th>Book</th>
                            <th>Name</th>
                            <th>Passport No.</th>
                            <th>Delegate</th>
                            <th>Trade</th>
                            <th>Destination</th>
                        </tr>
                    </thead>
                    <tbody>

                    @php
                        $i=1;
                    @endphp
                    @foreach ($customer_data as $customer)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $customer->customersl }}</td>
                            <td>{{ $customer->bookRef }}</td>
                            <td>{{ $customer->cusFname .' '. $customer->cusLname }}</td>
                            <td>{{ $customer->passportNo }}</td>
                            <td>{{ $customer->agentname .' '. $customer->agentsl }}</td>
                            <td>{{ $customer->visatrade_name }}</td>
                            <td>{{ $customer->destination_country }}</td>
                        </tr>
                   @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>