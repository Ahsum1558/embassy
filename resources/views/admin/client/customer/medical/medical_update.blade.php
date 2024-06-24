<h4 class="mb-4 basic_headline">Medical Update</h4>
<div class="table-responsive">
  <table id="example4" class="display" style="min-width: 700px">
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
              <th>MC Update</th>
              <th>Status</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
        @php
          $i=1;
        @endphp
      @foreach($all_medical_update as $medical_updated)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $medical_updated->customersl }}</td>
            <td>{{ $medical_updated->bookRef }}</td>
            <td>{{ $medical_updated->cusFname .' '. $medical_updated->cusLname }}</td>
            <td>{{ $medical_updated->passportNo }}</td>
            <td>{{ $medical_updated->agentname .' '. $medical_updated->agentsl }}</td>
            <td>{{ $medical_updated->visatrade_name }}</td>
            <td>
              @if($medical_updated->medical == 1)
                {{ __('Done') }}
                @elseif($medical_updated->medical == 2)
                {{ __('Fit') }}
                @elseif($medical_updated->medical == 3)
                {{ __('Unfit') }}
                @elseif($medical_updated->medical == 4)
                {{ __('N/A') }}
                @elseif($medical_updated->medical == 5)
                {{ __('Problem') }}
              @endif
            </td>
            <td>
              @if($medical_updated->medical_update == 1)
                {{ __('Medical Updated') }}
                @elseif($medical_updated->medical_update == 0)
                {{ __('Medical Not Updated') }}
              @endif
            </td>
            <td>
              @if($medical_updated->status == 1)
                {{ __('Active') }}
                @elseif($medical_updated->status == 0)
                {{ __('Inactive') }}
              @endif
            </td>
            <td>
              <a class="view_option" href="{{ route('admin.customer.show', ['id'=>$medical_updated->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
              <a class="edit_option" href="{{ route('admin.customer.editMedical', ['id'=>$medical_updated->id]) }}"><i class="fas fa-edit"></i><span>Update Medical</span></a>
            
            </td>
        </tr>
@endforeach
      </tbody>
  </table>
</div>