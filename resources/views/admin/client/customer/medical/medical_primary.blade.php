<h4 class="mb-4 basic_headline">Primary Customers</h4>
<div class="table-responsive">
  <table id="example" class="display" style="min-width: 700px">
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
              <th>Status</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
        @php
          $i=1;
        @endphp
      @foreach($all_medical_none as $medical_none)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $medical_none->customersl }}</td>
            <td>{{ $medical_none->bookRef }}</td>
            <td>{{ $medical_none->cusFname .' '. $medical_none->cusLname }}</td>
            <td>{{ $medical_none->passportNo }}</td>
            <td>{{ $medical_none->agentname .' '. $medical_none->agentsl }}</td>
            <td>{{ $medical_none->visatrade_name }}</td>
            <td>
              @if($medical_none->medical == 1)
                {{ __('Done') }}
                @elseif($medical_none->medical == 2)
                {{ __('Fit') }}
                @elseif($medical_none->medical == 3)
                {{ __('Unfit') }}
                @elseif($medical_none->medical == 4)
                {{ __('N/A') }}
                @elseif($medical_none->medical == 5)
                {{ __('Problem') }}
              @endif
            </td>
            <td>
              @if($medical_none->status == 1)
                {{ __('Active') }}
                @elseif($medical_none->status == 0)
                {{ __('Inactive') }}
              @endif
            </td>
            <td>
              <a class="view_option" href="{{ route('admin.customer.show', ['id'=>$medical_none->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
              <a class="edit_option" href="{{ route('admin.customer.editMedical', ['id'=>$medical_none->id]) }}"><i class="fas fa-edit"></i><span>Update Medical</span></a>
            
            </td>
        </tr>
@endforeach
      </tbody>
  </table>
</div>