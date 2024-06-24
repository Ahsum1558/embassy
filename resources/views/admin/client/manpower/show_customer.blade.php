<div class="col-12">
    <div class="card card_line">
        <div class="card-header card_headline">
            <h4 class="card-title headline">Customer Information Details</h4>
        </div>
        <div class="card-body">
            <a class="tranprint back_button" href="{{ route('admin.manpower') }}">Back</a>
            <h4 class="mb-4 basic_headline">All Customer</h4>
            <div class="table-responsive">
                <table id="example3" class="display" style="min-width: 700px">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Office SL</th>
                            <th>Name</th>
                            <th>Passport No.</th>
                            <th>Visa No.</th>
                            <th>Ordinal No.</th>
                            <th>Agent</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
            @php
              $i=1;
            @endphp
            @foreach ($manpower_customers as $customer)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $customer->customersl }}</td>
                            <td>{{ $customer->cusFname .' '. $customer->cusLname }}</td>
                            <td>{{ $customer->passportNo }}</td>
                            <td>{{ $customer->visano_en }}</td>
                            <td>{{ $customer->ordinal }}</td>
                            <td>{{ $customer->agentname .' '. $customer->agentsl }}</td>
                            <td>
                              @if($customer->status == 1)
                                {{ __('Active') }}
                                @elseif($customer->status == 0)
                                {{ __('Inactive') }}
                              @endif
                            </td>
                            <td>
                                <a class="view_option" href="#customerView{{ $customer->id }}" data-toggle="modal"><i class="fas fa-eye"></i><span>View Details</span></a>
                                <a class="edit_option" href="{{ route('admin.manpower.editStatement', ['id'=>$customer->id]) }}"><i class="fas fa-edit"></i><span>Update Customer Manpower Info</span></a>
                                <a class="edit_option bg-info" href="{{ route('admin.manpower.editFinger', ['id'=>$customer->id]) }}"><i class="fas fa-edit"></i><span>Update Customer Finger</span></a>
                                <a class="view_option" target="_blank" href="{{ route('admin.manpower.printContact', ['id'=>$customer->id]) }}"><i class="fa fa-print"></i><span>Print Contract</span></a>
                        @if($customer->manpowerlist == 1)
                              <a class="delete_option" href="#removeManpower{{ $customer->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Remove From List</span></a>
                        @endif
                            </td>
                    @include('admin.client.manpower.manpower_view')
                    @include('admin.client.manpower.manpower_remove')
                        </tr>
            @endforeach
                    </tbody>
                </table>
            </div> 
        </div>
    </div>
</div>