<h4 class="mb-4 basic_headline">Medical Unfit</h4>
<div class="table-responsive">
  <table id="example5" class="display" style="min-width: 700px">
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
      @foreach($all_medical_unfit as $medical_unfit)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $medical_unfit->customersl }}</td>
            <td>{{ $medical_unfit->bookRef }}</td>
            <td>{{ $medical_unfit->cusFname .' '. $medical_unfit->cusLname }}</td>
            <td>{{ $medical_unfit->passportNo }}</td>
            <td>{{ $medical_unfit->agentname .' '. $medical_unfit->agentsl }}</td>
            <td>{{ $medical_unfit->visatrade_name }}</td>
            <td>
              @if($medical_unfit->medical == 1)
                {{ __('Done') }}
                @elseif($medical_unfit->medical == 2)
                {{ __('Fit') }}
                @elseif($medical_unfit->medical == 3)
                {{ __('Unfit') }}
                @elseif($medical_unfit->medical == 4)
                {{ __('N/A') }}
                @elseif($medical_unfit->medical == 5)
                {{ __('Problem') }}
              @endif
            </td>
            <td>
              @if($medical_unfit->status == 1)
                {{ __('Active') }}
                @elseif($medical_unfit->status == 0)
                {{ __('Inactive') }}
              @endif
            </td>
            <td>
              <a class="view_option" href="{{ route('admin.customer.show', ['id'=>$medical_unfit->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
              <a class="edit_option" href="{{ route('admin.customer.editMedical', ['id'=>$medical_unfit->id]) }}"><i class="fas fa-edit"></i><span>Update Medical</span></a>
            </td>
        </tr>
@endforeach
      </tbody>
  </table>
</div>