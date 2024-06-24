@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Location</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">City</a></li>
        </ol>
    </div>
</div>
@include('super.includes.alert')
<div class="mybtn">
    <a href="{{ route('super.city.create') }}" class="btn submitbtn mb-2 form-control inline_setup text-uppercase">Add New City</a>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">All City</h4>
            </div>
            <div class="card-body">
              <h4 class="mb-4 basic_headline">City Info</h4>
              <div class="table-responsive">
                  <table id="example" class="display" style="min-width: 700px">
                      <thead>
                          <tr>
                              <th>SL</th>
                              <th>City Name</th>
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
                      @foreach($all_city as $city)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $city->cityname }}</td>
                            <td>{{ $city->districtname }}</td>
                            <td>{{ $city->divisionname }}</td>
                            <td>{{ $city->countryname }}</td>
                            <td>
                              @if($city->status == 1)
                                {{ __('Active') }}
                                @elseif($city->status == 0)
                                {{ __('Inactive') }}
                              @endif
                            </td>
                            <td>
                              <a class="view_option" href="{{ route('super.city.show', ['id'=>$city->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
                            @if($city->status == 1)
                              <a class="edit_option bg-warning" href="#inActiveId{{ $city->id }}" data-toggle="modal"><i class="fas fa-caret-square-down"></i><span>Set Inactive</span></a>
                            @elseif($city->status == 0)
                              <a class="edit_option" href="#activeId{{ $city->id }}" data-toggle="modal"><i class="fas fa-caret-square-up"></i><span>Set Active</span></a>
                            @endif
                              <a class="delete_option" href="#delCity{{ $city->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Delete City</span></a>
                            </td>
                @include('super.location.city.city_modal')
                @include('super.location.city.city_active')
                @include('super.location.city.city_inactive')
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