@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Visa</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Visa Info</a></li>
        </ol>
    </div>
</div>
@include('admin.includes.alert')
<div class="mybtn">
    <a href="{{ route('admin.visa.create') }}" class="btn submitbtn mb-2 form-control inline_setup text-uppercase">Add New Visa</a>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">All Visa Info</h4>
            </div>
            <div class="card-body">
              <h4 class="mb-4 basic_headline">Visa Info</h4>
              <a class="tranprint" target="_blank" href="{{ route('admin.visa.pdf') }}">Print</a>
              <div class="table-responsive">
                  <table id="example" class="display" style="min-width: 700px">
                      <thead>
                          <tr>
                              <th>SL</th>
                              <th>Visa No.</th>
                              <th>Sponsor Id</th>
                              <th width="30%">Sponsor Name</th>
                              <th>Occupation</th>
                              <th>Visa</th>
                              <th>Used</th>
                              <th>Remain</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php
                          $i=1;
                        @endphp
                      @foreach($all_visa as $visa)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $visa->visano_en }}</td>
                            <td>{{ $visa->sponsorid_en }}</td>
                            <td>{{ $visa->sponsorname_en }}</td>
                            <td>{{ $visa->occupation_ar }}</td>
                            <td>{{ $visa->delegated_visa }}</td>
                            <td>{{ isset($visaCounts[$visa->id]) ? $visaCounts[$visa->id] : 0 }}</td>
                        @if(isset($visaCounts[$visa->id]) && $visa->delegated_visa - $visaCounts[$visa->id] >= 0)
                            <td>{{ $visa->delegated_visa - $visaCounts[$visa->id] }}</td>
                        @else
                            <td>0</td>
                        @endif
                            <td>
                              @if($visa->status == 1)
                                {{ __('Active') }}
                                @elseif($visa->status == 0)
                                {{ __('Inactive') }}
                              @endif
                            </td>
                            <td>
                              <a class="view_option" href="{{ route('admin.visa.show', ['id'=>$visa->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
                            @if($visa->status == 1)
                              <a class="edit_option bg-warning" href="#inActiveId{{ $visa->id }}" data-toggle="modal"><i class="fas fa-caret-square-down"></i><span>Set Inactive</span></a>
                            @elseif($visa->status == 0)
                              <a class="edit_option" href="#activeId{{ $visa->id }}" data-toggle="modal"><i class="fas fa-caret-square-up"></i><span>Set Active</span></a>
                            @endif
                            <a class="view_option bg-primary" target="_blank" href="{{ route('admin.visa.Details', ['id'=>$visa->id]) }}"><i class="fa fa-print"></i><span>Print Visa Details</span></a>
                              <a class="delete_option" href="#delVisa{{ $visa->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Delete</span></a>
                            </td>
                @include('admin.visa.visainfo.visa_info_modal')
                @include('admin.visa.visainfo.visa_info_active')
                @include('admin.visa.visainfo.visa_info_inactive')
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