@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">User Licenses</a></li>
        </ol>
    </div>
</div>
@include('super.includes.alert')
<div class="mybtn">
  <a href="{{ route('super.operator.create') }}" class="btn submitbtn mb-2 form-control inline_setup text-uppercase">Add New User License</a>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">All User License</h4>
            </div>
            <div class="card-body">
              <h4 class="mb-4 basic_headline">All License</h4>
              <div class="table-responsive">
                  <table id="example" class="display" style="min-width: 700px">
                      <thead>
                          <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Office</th>
                            <th>License</th>
                            <th>Phone</th>
                            <th>Payment</th>
                            <th>Expiry</th>
                            <th>Level</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php
                          $i=1;
                        @endphp
                      @foreach($all_superuser as $super_user)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td><a href="{{ route('super.operator.show', ['id'=>$super_user->id]) }}">{{ $super_user->name }}</a></td>
                            <td>{{ $super_user->username }}</td>
                            <td>{{ $super_user->title }}</td>
                            <td>{{ $super_user->license }}</td>
                            <td>{{ $super_user->phone }}</td>
                            <td>{{ $super_user->payment_data }}</td>

                            @php
                                $expiryDate = strtotime($super_user->userExpiry);
                                $currentDate = strtotime(date('Y-m-d'));
                            @endphp

                            @if ($expiryDate < $currentDate)
                            <td><strong class="bg-danger text-white delete_option">{{ __('Expired') }}</strong></td>
                            @else
                            <td>{{ date('d-M-Y', strtotime($super_user->userExpiry)) }}</td>
                            @endif
                            <td>
                              @if($super_user->role == 'admin')
                                {{ __('Admin') }}
                                @elseif($super_user->role == 'author')
                                {{ __('Author') }}
                                @elseif($super_user->role == 'editor')
                                {{ __('Editor') }}
                                @elseif($super_user->role == 'contributor')
                                {{ __('Contributor') }}
                                @elseif($super_user->role == 'user')
                                {{ __('User') }}
                              @endif
                            </td>
                            <td>
                              @if($super_user->type == 'approve')
                              <strong class="bg-success text-white view_option">{{ __('Approved') }}</strong>
                                @elseif($super_user->type == 'pending')
                              <strong class="bg-warning text-white edit_option">{{ __('Pending') }}</strong>
                                @elseif($super_user->type == 'disable')
                              <strong class="bg-danger text-white delete_option">{{ __('Disabled') }}</strong>
                              @endif
                            </td>
                            <td>
                              @if($super_user->status == 'active')
                                {{ __('Active') }}
                                @elseif($super_user->status == 'inactive')
                                {{ __('Inactive') }}
                              @endif
                            </td>
                            <td>
                              <a class="view_option" href="{{ route('super.operator.show', ['id'=>$super_user->id]) }}"><i class="fas fa-eye"></i><span>View Operator</span></a>
                            @if($super_user->status == 'active')
                              <a class="edit_option bg-warning" href="#inActiveId{{ $super_user->id }}" data-toggle="modal"><i class="fas fa-caret-square-down"></i><span>Set Inactive</span></a>
                            @elseif($super_user->status == 'inactive')
                              <a class="edit_option bg-success" href="#activeId{{ $super_user->id }}" data-toggle="modal"><i class="fas fa-caret-square-up"></i><span>Set Active</span></a>
                            @endif
                              <a class="delete_option" href="#delOperator{{ $super_user->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Delete Operator</span></a>
                            </td>
                @include('super.operator.users_modal')
                @include('super.operator.users_inactive')
                @include('super.operator.users_active')
                        </tr>
                @endforeach
                      </tbody>
                  </table>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection