<h4 class="mb-4 basic_headline">All Manpower Date</h4>
<div class="table-responsive">
  <table id="example5" class="display" style="min-width: 700px">
      <thead>
          <tr>
              <th>SL</th>
              <th>Office Name</th>
              <th>Manpower Date</th>
              <th>Notesheet</th>
              <th>Status</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
        @php
          $i=1;
        @endphp
      @foreach($all_manpower as $manpower)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ Auth::user()->title }}</td>
            <td>{{ date('d-M-Y', strtotime($manpower->manpowerDate)) }}</td>
            <td>{{ $manpower->putupSl }}</td>
            <td>
              @if($manpower->status == 1)
                {{ __('Active') }}
                @elseif($manpower->status == 0)
                {{ __('Inactive') }}
              @endif
            </td>
            <td>
              {{-- <a class="view_option" href="{{ route('admin.manpower.show', ['id'=>$manpower->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
              <a class="edit_option" href="{{ route('admin.manpower.payment', ['id'=>$manpower->id]) }}"><i class="fas fa-pencil"></i><span>Add Payment Info</span></a>
            @if($manpower->status == 1)
              <a class="edit_option bg-warning" href="#inActiveId{{ $manpower->id }}" data-toggle="modal"><i class="fas fa-caret-square-down"></i><span>Set Inactive</span></a>
            @elseif($manpower->status == 0)
              <a class="edit_option" href="#activeId{{ $manpower->id }}" data-toggle="modal"><i class="fas fa-caret-square-up"></i><span>Set Active</span></a>
            @endif --}}
              <a class="view_option bg-success" target="_blank" href="{{ route('admin.manpower.printPutupWord', ['id'=>$manpower->id]) }}"><i class="fa fa-print"></i><span>Print Put Up List</span></a>

              {{-- <a class="view_option" target="_blank" href="{{ route('admin.manpower.printNotesheetUpdate', ['id'=>$manpower->id]) }}"><i class="fa fa-print"></i><span>Print Notesheet</span></a>
              <a class="view_option bg-primary" target="_blank" href="{{ route('admin.manpower.printLetterUpdate', ['id'=>$manpower->id]) }}"><i class="fa fa-print"></i><span>Print Application Letter</span></a>
              <a class="view_option bg-info" target="_blank" href="{{ route('admin.manpower.printUndertaking', ['id'=>$manpower->id]) }}"><i class="fa fa-print"></i><span>Print Undertaking</span></a>
              <a class="delete_option" href="#delManpower{{ $manpower->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Delete</span></a> --}}

            </td>
            @include('admin.client.manpower.manpower_modal')
            @include('admin.client.manpower.manpower_active')
            @include('admin.client.manpower.manpower_inactive')
        </tr>
@endforeach
      </tbody>
  </table>
</div>