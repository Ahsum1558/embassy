@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Setting</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Header and Footer</a></li>
        </ol>
    </div>
</div>
@include('super.includes.alert')
<div class="mybtn">
  <a href="{{ route('super.setting.create') }}" class="btn submitbtn mb-2 form-control inline_setup text-uppercase">Add New Header and Footer</a>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">Header and Footer Option</h4>
            </div>
            <div class="card-body">
              <h4 class="mb-4 basic_headline">Header and Footer Info</h4>
              <div class="table-responsive">
                  <table id="example" class="display" style="min-width: 700px">
                      <thead>
                          <tr>
                              <th>SL</th>
                              <th>Title</th>
                              <th>License</th>
                              <th>Address</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php
                          $i=1;
                        @endphp
                      @foreach($header_footer_data as $header_footer)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $header_footer->title }}</td>
                            <td>{{ $header_footer->license }}</td>
                            <td>{{ $header_footer->address }}</td>
                            <td>
                              @if($header_footer->status == 1)
                                {{ __('Active') }}
                                @elseif($header_footer->status == 0)
                                {{ __('Inactive') }}
                              @endif
                            </td>
                            <td>
                              <a class="view_option" href="{{ route('super.setting.show', ['id'=>$header_footer->id]) }}"><i class="fas fa-eye"></i><span>View Header and Footer</span></a>
                            @if($header_footer->status == 1)
                              <a class="edit_option bg-warning" href="#inActiveId{{ $header_footer->id }}" data-toggle="modal"><i class="fas fa-caret-square-down"></i><span>Set Inactive</span></a>
                            @elseif($header_footer->status == 0)
                              <a class="edit_option bg-success" href="#activeId{{ $header_footer->id }}" data-toggle="modal"><i class="fas fa-caret-square-up"></i><span>Set Active</span></a>
                            @endif
                              <a class="delete_option" href="#delSetting{{ $header_footer->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Delete Header and Footer</span></a>
                            </td>
                @include('super.setting.setting_modal')
                @include('super.setting.setting_inactive')
                @include('super.setting.setting_active')
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