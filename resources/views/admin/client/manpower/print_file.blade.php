<h4 class="mb-4 basic_headline">Print Customers</h4>
<div class="table-responsive">
  <table id="example5" class="display" style="min-width: 700px">
      <thead>
          <tr>
              <th>SL</th>
              <th>Serial</th>
              <th>Name</th>
              <th>Passport No.</th>
              <th>Visa No.</th>
              <th>Manpower Date</th>
              <th width="25%">Action</th>
          </tr>
      </thead>
      <tbody>
        @php
          $i=1;
        @endphp
      @foreach($all_customer as $customer)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $customer->customersl }}</td>
            <td>{{ $customer->cusFname .' '. $customer->cusLname }}</td>
            <td>{{ $customer->passportNo }}</td>
            <td>{{ $customer->visano_en }}</td>
            <td>
              @if($customer->manpowerDate != NULL)
                {{ date('d-M-Y', strtotime($customer->manpowerDate)) }}
                @else
                {{ __('N/A') }}
              @endif
            </td>
            <td width="25%">
              <a class="view_option" href="{{ route('admin.manpower.display', ['id'=>$customer->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
            @if($customer->manpowerlist == 0)
              <a class="edit_option" href="{{ route('admin.manpower.statement', ['id'=>$customer->id]) }}"><i class="fas fa-pencil"></i><span>Add To Manpower</span></a>
            @else
              <a class="edit_option" href="{{ route('admin.manpower.editStatement', ['id'=>$customer->id]) }}"><i class="fas fa-edit"></i><span>Update Customer Manpower Info</span></a>
              <a class="edit_option bg-primary" href="{{ route('admin.manpower.editFinger', ['id'=>$customer->id]) }}"><i class="fas fa-edit"></i><span>Update Customer Finger</span></a>
            @endif
            <a class="view_option" target="_blank" href="{{ route('admin.manpower.printContact', ['id'=>$customer->id]) }}"><i class="fa fa-print"></i><span>Print Contract</span></a>
          @if($customer->manpowerlist == 1)
            <a class="view_option bg-danger" target="_blank" href="{{ route('admin.manpower.printData', ['id'=>$customer->id]) }}"><i class="fa fa-print"></i><span>Print Data Sheet</span></a>
              <a class="delete_option" onclick="return confirm('Are you sure to delete !')" href="{{ route('admin.manpower.remove', ['id'=>$customer->id]) }}"><i class="fas fa-trash"></i><span>Remove From Manpower</span></a>
          @endif
            </td>
        </tr>
@endforeach
      </tbody>
  </table>
</div>