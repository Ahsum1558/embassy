@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Location</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">District</a></li>
        </ol>
    </div>
</div>
@include('admin.includes.alert')
@if(Auth::check() && Auth::user()->role == 'admin' && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar))
<div class="mybtn">
    <a href="{{ route('admin.district.create') }}" class="btn submitbtn mb-2 form-control inline_setup text-uppercase">Add New District</a>
</div>
@endif
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">All District</h4>
            </div>
            <div class="card-body">
              <h4 class="mb-4 basic_headline">District Info</h4>
              <div class="table-responsive">
                  <table id="example" class="display" style="min-width: 700px">
                      <thead>
                          <tr>
                              <th>SL</th>
                              <th>District Name</th>
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
                      @foreach($all_district as $district)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $district->districtname }}</td>
                            <td>{{ $district->divisionname }}</td>
                            <td>{{ $district->countryname }}</td>
                            <td>
                              @if($district->status == 1)
                                {{ __('Active') }}
                                @elseif($district->status == 0)
                                {{ __('Inactive') }}
                              @endif
                            </td>
                            <td>
                              <a class="view_option" href="{{ route('admin.district.show', ['id'=>$district->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
                          @if(Auth::check() && Auth::user()->role == 'admin' && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar))
                            @if($district->status == 1)
                              <a class="edit_option bg-warning" href="#inActiveId{{ $district->id }}" data-toggle="modal"><i class="fas fa-caret-square-down"></i><span>Set Inactive</span></a>
                            @elseif($district->status == 0)
                              <a class="edit_option" href="#activeId{{ $district->id }}" data-toggle="modal"><i class="fas fa-caret-square-up"></i><span>Set Active</span></a>
                            @endif
                              <a class="delete_option" href="#delDistrict{{ $district->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Delete District</span></a>
                          @endif
                            </td>
                @include('admin.location.district.district_modal')
                @include('admin.location.district.district_active')
                @include('admin.location.district.district_inactive')
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