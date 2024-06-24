<h4 class="mb-4 basic_headline">Medical Problem</h4>
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
      @foreach($all_medical_problem as $medical_problem)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $medical_problem->customersl }}</td>
            <td>{{ $medical_problem->bookRef }}</td>
            <td>{{ $medical_problem->cusFname .' '. $medical_problem->cusLname }}</td>
            <td>{{ $medical_problem->passportNo }}</td>
            <td>{{ $medical_problem->agentname .' '. $medical_problem->agentsl }}</td>
            <td>{{ $medical_problem->visatrade_name }}</td>
            <td>
              @if($medical_problem->medical == 1)
                {{ __('Done') }}
                @elseif($medical_problem->medical == 2)
                {{ __('Fit') }}
                @elseif($medical_problem->medical == 3)
                {{ __('Unfit') }}
                @elseif($medical_problem->medical == 4)
                {{ __('N/A') }}
                @elseif($medical_problem->medical == 5)
                {{ __('Problem') }}
              @endif
            </td>
            <td>
              @if($medical_problem->status == 1)
                {{ __('Active') }}
                @elseif($medical_problem->status == 0)
                {{ __('Inactive') }}
              @endif
            </td>
            <td>
              <a class="view_option" href="{{ route('admin.customer.show', ['id'=>$medical_problem->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
              <a class="edit_option" href="{{ route('admin.customer.editMedical', ['id'=>$medical_problem->id]) }}"><i class="fas fa-edit"></i><span>Update Medical</span></a>
            </td>
        </tr>
@endforeach
      </tbody>
  </table>
</div>