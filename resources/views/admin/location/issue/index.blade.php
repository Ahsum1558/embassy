@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Location</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Issue Place</a></li>
        </ol>
    </div>
</div>
@include('admin.includes.alert')
@if(Auth::check() && Auth::user()->role == 'admin' && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar))
<div class="mybtn">
    <a href="{{ route('admin.issue.create') }}" class="btn submitbtn mb-2 form-control inline_setup text-uppercase">Add New Issue Place</a>
</div>
@endif
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">All Issue Place</h4>
            </div>
            <div class="card-body">
              <h4 class="mb-4 basic_headline">Issue Place Info</h4>
              <div class="table-responsive">
                  <table id="example" class="display" style="min-width: 700px">
                      <thead>
                          <tr>
                              <th>SL</th>
                              <th>Issue Place Name</th>
                              <th>Country Name</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php
                          $i=1;
                        @endphp
                      @foreach($all_issue as $issue)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $issue->issuePlace }}</td>
                            <td>{{ $issue->countryname }}</td>
                            <td>
                              @if($issue->status == 1)
                                {{ __('Active') }}
                                @elseif($issue->status == 0)
                                {{ __('Inactive') }}
                              @endif
                            </td>
                            <td>
                              <a class="view_option" href="{{ route('admin.issue.show', ['id'=>$issue->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
                          @if(Auth::check() && Auth::user()->role == 'admin' && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar))
                            @if($issue->status == 1)
                              <a class="edit_option bg-warning" href="#inActiveId{{ $issue->id }}" data-toggle="modal"><i class="fas fa-caret-square-down"></i><span>Set Inactive</span></a>
                            @elseif($issue->status == 0)
                              <a class="edit_option" href="#activeId{{ $issue->id }}" data-toggle="modal"><i class="fas fa-caret-square-up"></i><span>Set Active</span></a>
                            @endif
                              <a class="delete_option" href="#delIssue{{ $issue->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Delete Issue Place</span></a>
                          @endif
                            </td>
                @include('admin.location.issue.issue_modal')
                @include('admin.location.issue.issue_active')
                @include('admin.location.issue.issue_inactive')
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