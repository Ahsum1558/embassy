@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Important Links</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Links</a></li>
        </ol>
    </div>
</div>
@include('admin.includes.alert')
{{-- <div class="mybtn">
    <button type="button" class="btn submitbtn mb-2 form-control inline_setup text-uppercase" data-toggle="modal" data-target="#addNewLink">Add New Link</button>
</div> --}}
@if(Auth::check() && Auth::user()->role == 'admin' && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar))
<div class="mybtn">
    <a href="{{ route('admin.link.create') }}" class="btn submitbtn mb-2 form-control inline_setup text-uppercase">Add New Link</a>
</div>
@endif
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">All link</h4>
            </div>
            <div class="card-body">
              <h4 class="mb-4 basic_headline">Links Info</h4>
              <div class="table-responsive">
                  <table id="example" class="display" style="min-width: 700px">
                      <thead>
                          <tr>
                              <th>SL</th>
                              <th>Link Name</th>
                              <th>Type</th>
                              <th width="30%">Link Url</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php
                          $i=1;
                        @endphp
                      @foreach($all_link as $link)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $link->linkname }}</td>
                            <td>{{ $link->linktype }}</td>
                            <td><a target="_blank" href="{{ $link->linkurl }}">{{ $link->linkurl }}</a></td>
                            <td>
                              @if($link->status == 1)
                                {{ __('Active') }}
                                @elseif($link->status == 0)
                                {{ __('Inactive') }}
                              @endif
                            </td>
                            <td>
                              <a class="view_option" href="{{ route('admin.link.show', ['id'=>$link->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
                          @if(Auth::check() && Auth::user()->role == 'admin' && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar))
                            @if($link->status == 1)
                              <a class="edit_option bg-warning" href="#inActiveId{{ $link->id }}" data-toggle="modal"><i class="fas fa-caret-square-down"></i><span>Set Inactive</span></a>
                            @elseif($link->status == 0)
                              <a class="edit_option" href="#activeId{{ $link->id }}" data-toggle="modal"><i class="fas fa-caret-square-up"></i><span>Set Active</span></a>
                            @endif
                              <a class="delete_option" href="#delLink{{ $link->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Delete</span></a>
                          @endif
                            </td>
                @include('admin.visa.link.link_modal')
                @include('admin.visa.link.link_active')
                @include('admin.visa.link.link_inactive')
                        </tr>
               @endforeach
                      </tbody>
                  </table>
              </div>

            </div>
        </div>
    </div>
</div>
{{-- @include('admin.visa.link.link_add') --}}
@endsection