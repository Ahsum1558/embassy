<h4 class="mb-4 basic_headline">All Submission Date</h4>
<div class="table-responsive">
  <table id="example" class="display" style="min-width: 700px">
      <thead>
          <tr>
              <th>SL</th>
              <th>Company Name</th>
              <th>Submission Date</th>
              <th>Status</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
        @php
          $i=1;
        @endphp
      @foreach($all_submission as $submission)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ Auth::user()->title }}</td>
            <td>{{ date('d-M-Y', strtotime($submission->submissionDate)) }}</td>
            <td>
              @if($submission->status == 1)
                {{ __('Active') }}
                @elseif($submission->status == 0)
                {{ __('Inactive') }}
              @endif
            </td>
            <td>
              <a class="view_option" href="{{ route('admin.submission.show', ['id'=>$submission->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
            @if($submission->status == 1)
              <a class="edit_option bg-warning" href="#inActiveId{{ $submission->id }}" data-toggle="modal"><i class="fas fa-caret-square-down"></i><span>Set Inactive</span></a>
            @elseif($submission->status == 0)
              <a class="edit_option" href="#activeId{{ $submission->id }}" data-toggle="modal"><i class="fas fa-caret-square-up"></i><span>Set Active</span></a>
            @endif
              <a class="view_option" target="_blank" href="{{ route('admin.submission.print', ['id'=>$submission->id]) }}"><i class="fa fa-print"></i><span>Print</span></a>
              <a class="delete_option" href="#delSubmission{{ $submission->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Delete</span></a>
            </td>
            @include('admin.client.submission.submission_modal')
            @include('admin.client.submission.submission_active')
            @include('admin.client.submission.submission_inactive')
        </tr>
@endforeach
      </tbody>
  </table>
</div>