<div class="col-xl-12 col-lg-12">
    <div class="card card_line">
        <div class="card-header card_headline">
           <h4 class="card-title headline">Customer Info Details of {{ $single_visa->visano_en }}</h4>
        </div>
        <div class="card-body">
            <h4 class="mb-4 basic_headline">Customer Info</h4>
            <div class="profile-uoloaded-post border-bottom-1 pb-5">
                <div class="row">
                    <div class="col-xl-12 col-sm-12">
                        <div class="profile-personal-info">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 700px">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Serial</th>
                                            <th>Book Ref</th>
                                            <th>Name</th>
                                            <th>Passport No.</th>
                                            <th>Delegate</th>
                                            <th>Trade</th>
                                            <th>Medical</th>
                                            <th>Destination</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
                                            <td>
                                              @if($customer->medical == 1)
                                                {{ __('Done') }}
                                                @elseif($customer->medical == 2)
                                                {{ __('Fit') }}
                                                @elseif($customer->medical == 3)
                                                {{ __('Unfit') }}
                                                @elseif($customer->medical == 4)
                                                {{ __('N/A') }}
                                                @elseif($customer->medical == 5)
                                                {{ __('Problem') }}
                                              @endif
                                            </td>
                                            <td>{{ $customer->destination_country }}</td>
                                            <td>
                                              @if($customer->status == 1)
                                                {{ __('Active') }}
                                                @elseif($customer->status == 0)
                                                {{ __('Inactive') }}
                                              @endif
                                            </td>
                                            <td>
                                                <a class="view_option" href="#customerView{{ $customer->id }}" data-toggle="modal"><i class="fas fa-eye"></i><span>View Details</span></a>
                                            </td>
                                            @include('admin.visa.visainfo.customer_modal')
                                        </tr>
                            @endforeach
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>