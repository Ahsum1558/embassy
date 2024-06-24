<h4 class="mb-4 basic_headline">Medical Done</h4>
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
              <th>Status</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
        @php
          $i=1;
        @endphp
      @foreach($all_medical_done as $medical_done)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $medical_done->customersl }}</td>
            <td>{{ $medical_done->bookRef }}</td>
            <td>{{ $medical_done->cusFname .' '. $medical_done->cusLname }}</td>
            <td>{{ $medical_done->passportNo }}</td>
            <td>{{ $medical_done->agentname .' '. $medical_done->agentsl }}</td>
            <td>{{ $medical_done->visatrade_name }}</td>
            <td>
              @if($medical_done->medical == 1)
                {{ __('Done') }}
                @elseif($medical_done->medical == 2)
                {{ __('Fit') }}
                @elseif($medical_done->medical == 3)
                {{ __('Unfit') }}
                @elseif($medical_done->medical == 4)
                {{ __('N/A') }}
                @elseif($medical_done->medical == 5)
                {{ __('Problem') }}
              @endif
            </td>
            <td>
              @if($medical_done->status == 1)
                {{ __('Active') }}
                @elseif($medical_done->status == 0)
                {{ __('Inactive') }}
              @endif
            </td>
            <td>
              <a class="view_option" href="{{ route('admin.customer.show', ['id'=>$medical_done->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
              <a class="edit_option" href="{{ route('admin.customer.editMedical', ['id'=>$medical_done->id]) }}"><i class="fas fa-edit"></i><span>Update Medical</span></a>
            
            </td>
        </tr>
@endforeach
      </tbody>
  </table>
</div>