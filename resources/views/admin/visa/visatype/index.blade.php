@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Visa</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Visa Type</a></li>
        </ol>
    </div>
</div>
@include('admin.includes.alert')
@if(Auth::check() && Auth::user()->role == 'admin' && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar))
<div class="mybtn">
    <button type="button" class="btn submitbtn mb-2 form-control inline_setup text-uppercase" data-toggle="modal" data-target="#addNewVisaType">Add New Visa Type</button>
</div>
@endif
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">All Visa Type</h4>
            </div>
            <div class="card-body">
              <h4 class="mb-4 basic_headline">Visa Type</h4>
              <div class="table-responsive">
                  <table id="example" class="display" style="min-width: 700px">
                      <thead>
                          <tr>
                              <th>SL</th>
                              <th>Visa Type</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php
                          $i=1;
                        @endphp
                      @foreach($all_visa_type as $visa_type)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $visa_type->visatype_name }}</td>
                            <td>
                              @if($visa_type->status == 1)
                                {{ __('Active') }}
                                @elseif($visa_type->status == 0)
                                {{ __('Inactive') }}
                              @endif
                            </td>
                            <td>
                              <a class="view_option" href="{{ route('admin.visaType.show', ['id'=>$visa_type->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
                          @if(Auth::check() && Auth::user()->role == 'admin' && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar))
                            @if($visa_type->status == 1)
                              <a class="edit_option bg-warning" href="#inActiveId{{ $visa_type->id }}" data-toggle="modal"><i class="fas fa-caret-square-down"></i><span>Set Inactive</span></a>
                            @elseif($visa_type->status == 0)
                              <a class="edit_option" href="#activeId{{ $visa_type->id }}" data-toggle="modal"><i class="fas fa-caret-square-up"></i><span>Set Active</span></a>
                            @endif
                              <a class="delete_option" href="#delVisaType{{ $visa_type->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Delete</span></a>
                          @endif
                            </td>
                @include('admin.visa.visatype.visa_type_modal')
                @include('admin.visa.visatype.visa_type_active')
                @include('admin.visa.visatype.visa_type_inactive')
                        </tr>
               @endforeach
                      </tbody>
                  </table>
              </div>

            </div>
        </div>
    </div>
</div>
@include('admin.visa.visatype.visa_type_add')
@endsection