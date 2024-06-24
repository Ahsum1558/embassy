<div class="col-xl-12 col-lg-12">
    <div class="card card_line">
        <div class="card-header card_headline">
           <h4 class="card-title headline">Customer Info Details of {{ $delegate_single_data[0]->agentname }}</h4>
        </div>
        <div class="card-body">
            <h4 class="mb-4 basic_headline">Customer Info</h4>
            <div class="profile-uoloaded-post border-bottom-1 pb-5">
                <div class="row">
                    <div class="col-xl-12 col-sm-12">
                        <div class="profile-personal-info">
                            <a class="tranprint back_button" href="{{ route('admin.delegate') }}">Back</a>
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 700px">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Office SL</th>
                                            <th>Name</th>
                                            <th>Passport No.</th>
                                            <th>Visa No.</th>
                                            <th>Trade</th>
                                            <th>Type</th>
                                            <th>Visa Issue</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            @php
                              $i=1;
                            @endphp
                            @foreach ($delegate_customers as $customer)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $customer->customersl }}</td>
                                            <td>{{ $customer->cusFname .' '. $customer->cusLname }}</td>
                                            <td>{{ $customer->passportNo }}</td>
                                            <td>{{ $customer->visano_en }}</td>
                                            <td>{{ $customer->visatrade_name }}</td>
                                            <td>{{ $customer->visatype_name }}</td>
                                            <td>
                                              @if($customer->visa_issue != NULL)
                                                {{ date('d-M-Y', strtotime($customer->visa_issue)) }}
                                                @else
                                                {{ __('N/A') }}
                                              @endif
                                            </td>
                                            <td>
                                              @if($customer->status == 1)
                                                {{ __('Active') }}
                                                @elseif($customer->status == 0)
                                                {{ __('Inactive') }}
                                              @endif
                                            </td>
                                            <td>
                                                <a class="view_option" href="#delegateCustomer{{ $customer->id }}" data-toggle="modal"><i class="fas fa-eye"></i><span>View Details</span></a>
                                            </td>
                                    @include('admin.client.delegate.customer_view')
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