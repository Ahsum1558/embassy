@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Location</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Division</a></li>
        </ol>
    </div>
</div>
@include('super.includes.alert')
<div class="mybtn">
    <a href="{{ route('super.division.create') }}" class="btn submitbtn mb-2 form-control inline_setup text-uppercase">Add New Division</a>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">All Division</h4>
            </div>
            <div class="card-body">
              <h4 class="mb-4 basic_headline">Division Info</h4>
              <div class="table-responsive">
                  <table id="example" class="display" style="min-width: 700px">
                      <thead>
                          <tr>
                              <th>SL</th>
                              <th>Division Name</th>
                              <th>Country Name</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php
                          $i=1;
                        @endphp
                      @foreach($all_division as $division)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $division->divisionname }}</td>
                            <td>{{ $division->countryname }}</td>
                            <td>
                              @if($division->status == 1)
                                {{ __('Active') }}
                                @elseif($division->status == 0)
                                {{ __('Inactive') }}
                              @endif
                            </td>
                            <td>
                              <a class="view_option" href="{{ route('super.division.show', ['id'=>$division->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
                            @if($division->status == 1)
                              <a class="edit_option bg-warning" href="#inActiveId{{ $division->id }}" data-toggle="modal"><i class="fas fa-caret-square-down"></i><span>Set Inactive</span></a>
                            @elseif($division->status == 0)
                              <a class="edit_option" href="#activeId{{ $division->id }}" data-toggle="modal"><i class="fas fa-caret-square-up"></i><span>Set Active</span></a>
                            @endif
                              <a class="delete_option" href="#delDivision{{ $division->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Delete Division</span></a>
                            </td>
                @include('super.location.division.division_modal')
                @include('super.location.division.division_active')
                @include('super.location.division.division_inactive')
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