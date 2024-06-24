@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Site Option</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Option in English</a></li>
        </ol>
    </div>
</div>
@include('super.includes.alert')
<div class="mybtn">
    <button type="button" class="btn submitbtn mb-2 form-control inline_setup text-uppercase" data-toggle="modal" data-target="#addNewOption">Add New Site Option</button>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">English Site Option Area</h4>
            </div>
            <div class="card-body">
              <h4 class="mb-4 basic_headline">All Option</h4>
              <div class="table-responsive">
                  <table id="example" class="display" style="min-width: 700px">
                      <thead>
                          <tr>
                              <th>SL</th>
                              <th>Title</th>
                              <th>License</th>
                              <th>License Expiry</th>
                              <th>Proprietor</th>
                              <th>Address</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php
                          $i=1;
                        @endphp
                      @foreach($all_field as $field)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $field->title }}</td>
                            <td>{{ $field->license }}</td>
                            <td>{{ date('d-M-Y', strtotime($field->licenseExpiry)) }}</td>
                            <td>{{ $field->proprietor }}</td>
                            <td>{{ $field->address }}</td>
                            <td>
                              @if($field->status == 1)
                                {{ __('Active') }}
                                @elseif($field->status == 0)
                                {{ __('Inactive') }}
                              @endif
                            </td>
                            <td>
                              <a class="view_option" href="{{ route('super.field.show', ['id'=>$field->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
                            @if($field->status == 1)
                              <a class="edit_option bg-warning" href="#inActiveId{{ $field->id }}" data-toggle="modal"><i class="fas fa-caret-square-down"></i><span>Set Inactive</span></a>
                            @elseif($field->status == 0)
                              <a class="edit_option" href="#activeId{{ $field->id }}" data-toggle="modal"><i class="fas fa-caret-square-up"></i><span>Set Active</span></a>
                            @endif
                              <a class="delete_option" href="#delOption{{ $field->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Delete Option</span></a>
                            </td>
                @include('super.field.option_modal')
                @include('super.field.option_inactive')
                @include('super.field.option_active')
                        </tr>
               @endforeach
                      </tbody>
                  </table>
              </div>

            </div>
        </div>
    </div>
</div>
@include('super.field.option_add')

@endsection