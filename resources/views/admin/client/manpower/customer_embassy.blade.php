<h4 class="mb-4 basic_headline">Customers in Embassy</h4>
<div class="table-responsive">
  <table id="example4" class="display" style="min-width: 700px">
      <thead>
          <tr>
              <th>SL</th>
              <th>Serial</th>
              <th>Name</th>
              <th>Passport No.</th>
              <th>Visa No.</th>
              <th>Delegate</th>
              <th>Status</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
        @php
          $i=1;
        @endphp
      @foreach($stamped_customer as $customer)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $customer->customersl }}</td>
            <td>{{ $customer->cusFname .' '. $customer->cusLname }}</td>
            <td>{{ $customer->passportNo }}</td>
            <td>{{ $customer->visano_en }}</td>
            <td>{{ $customer->agentname .' '. $customer->agentsl }}</td>
            <td>
              @if($customer->status == 1)
                {{ __('Active') }}
                @elseif($customer->status == 0)
                {{ __('Inactive') }}
              @endif
            </td>
            <td>
              <a class="view_option" href="{{ route('admin.manpower.display', ['id'=>$customer->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
            @if($customer->value == 3)
              <a class="edit_option" href="{{ route('admin.manpower.stampingVisa', ['id'=>$customer->id]) }}"><i class="fas fa-pencil"></i><span>Add Visa Stamping Info</span></a>
            @endif
            </td>
        </tr>
@endforeach
      </tbody>
  </table>
</div>