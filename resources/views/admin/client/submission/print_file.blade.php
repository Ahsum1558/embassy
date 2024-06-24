<h4 class="mb-4 basic_headline">Print Customers</h4>
<div class="table-responsive">
  <table id="example4" class="display" style="min-width: 700px">
      <thead>
          <tr>
              <th>SL</th>
              <th>Serial</th>
              <th>Name</th>
              <th>Passport No.</th>
              <th>Visa No.</th>
              <th>Type</th>
              <th>Submission Date</th>
              <th>Ordinal</th>
              <th>Delegate</th>
              <th>Status</th>
              <th>Action</th>
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
              @if($customer->submissionType == 1)
                {{ __('New Submission') }}
                @elseif($customer->submissionType == 2)
                {{ __('Visa Extension') }}
                @elseif($customer->submissionType == 3)
                {{ __('Visa Renew') }}
                @elseif($customer->submissionType == 4)
                {{ __('Visa Reissue') }}
                @elseif($customer->submissionType == 5)
                {{ __('Replacement') }}
                @elseif($customer->submissionType == 6)
                {{ __('Cancel') }}
                @else
                {{ __('N/A') }}
              @endif
            </td>
            <td>
              @if($customer->submissionDate != NULL)
                {{ date('d-M-Y', strtotime($customer->submissionDate)) }}
                @else
                {{ __('N/A') }}
              @endif
            </td>
            <td>
              @if($customer->ordinal != NULL)
                {{ $customer->ordinal }}
                @else
                {{ __('N/A') }}
              @endif
            </td>
            <td>{{ $customer->agentname .' '. $customer->agentsl }}</td>
            <td>
              @if($customer->status == 1)
                {{ __('Active') }}
                @elseif($customer->status == 0)
                {{ __('Inactive') }}
              @endif
            </td>
            <td>
              <a class="view_option" href="{{ route('admin.customer.show', ['id'=>$customer->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
              <a class="edit_option" target="_blank" href="{{ route('admin.customer.print', ['id'=>$customer->id]) }}"><i class="fa fa-print"></i><span>Print</span></a>
            </td>
        </tr>
@endforeach
      </tbody>
  </table>
</div>