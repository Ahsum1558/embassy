@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Delegate</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Delegate Info</a></li>
        </ol>
    </div>
</div>
@include('admin.includes.alert')
<div class="mybtn">
    <a href="{{ route('admin.delegate.create') }}" class="btn submitbtn mb-2 form-control inline_setup text-uppercase">Add New Delegate</a>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">All Delegate Info</h4>
            </div>
            <div class="card-body">
              <h4 class="mb-4 basic_headline">Delegate Info</h4>
              <div class="table-responsive">
                  <table id="example" class="display" style="min-width: 700px">
                      <thead>
                          <tr>
                              <th>SL</th>
                              <th>Book Ref</th>
                              <th>Name</th>
                              <th>Office</th>
                              <th>Office Loation</th>
                              <th>Phone</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php
                          $i=1;
                        @endphp
                      @foreach($all_delegate as $delegate)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $delegate->agentbook }}</td>
                            <td>{{ $delegate->agentname }}</td>
                            <td>{{ $delegate->office }}</td>
                            <td>{{ $delegate->officeLocation }}</td>
                            <td>{{ $delegate->phone }}</td>
                            <td>
                              @if($delegate->status == 1)
                                {{ __('Active') }}
                                @elseif($delegate->status == 0)
                                {{ __('Inactive') }}
                              @endif
                            </td>
                            <td>
                              <a class="view_option" href="{{ route('admin.delegate.show', ['id'=>$delegate->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
                            @if($delegate->status == 1)
                              <a class="edit_option bg-warning" href="#inActiveId{{ $delegate->id }}" data-toggle="modal"><i class="fas fa-caret-square-down"></i><span>Set Inactive</span></a>
                            @elseif($delegate->status == 0)
                              <a class="edit_option" href="#activeId{{ $delegate->id }}" data-toggle="modal"><i class="fas fa-caret-square-up"></i><span>Set Active</span></a>
                            @endif
                              <a class="delete_option" href="#delDelegate{{ $delegate->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Delete</span></a>
                            </td>
                @include('admin.client.delegate.delegate_modal')
                @include('admin.client.delegate.delegate_active')
                @include('admin.client.delegate.delegate_inactive')
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