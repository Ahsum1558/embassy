@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Setting</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Meta</a></li>
        </ol>
    </div>
</div>
@include('super.includes.alert')
<div class="mybtn">
    <button type="button" class="btn submitbtn mb-2 form-control inline_setup text-uppercase" data-toggle="modal" data-target="#addNewMeta">Add New Meta</button>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">Meta List</h4>
            </div>
            <div class="card-body">
              <h4 class="mb-4 basic_headline">All Meta</h4>
              <div class="table-responsive">
                  <table id="example" class="display" style="min-width: 700px">
                      <thead>
                          <tr>
                              <th>SL</th>
                              <th>Title</th>
                              <th>Description</th>
                              <th>URL</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php
                          $i=1;
                        @endphp
                      @foreach($all_meta as $meta_data)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $meta_data->title }}</td>
                            <td>{{ $meta_data->description }}</td>
                            <td>{{ $meta_data->url }}</td>
                            <td>
                              @if($meta_data->status == 1)
                                {{ __('Active') }}
                                @elseif($meta_data->status == 0)
                                {{ __('Inactive') }}
                              @endif
                            </td>
                            <td>
                              <a class="view_option" href="#viewMeta{{ $meta_data->id }}" data-toggle="modal"><i class="fas fa-eye"></i><span>View Details</span></a>
                              <a class="edit_option" href="{{ route('super.meta.edit', ['id'=>$meta_data->id]) }}"><i class="fas fa-edit"></i><span>Update Meta</span></a>
                            @if($meta_data->status == 1)
                              <a class="edit_option bg-warning" href="#inActiveId{{ $meta_data->id }}" data-toggle="modal"><i class="fas fa-caret-square-down"></i><span>Set Inactive</span></a>
                            @elseif($meta_data->status == 0)
                              <a class="edit_option bg-success" href="#activeId{{ $meta_data->id }}" data-toggle="modal"><i class="fas fa-caret-square-up"></i><span>Set Active</span></a>
                            @endif
                              <a class="delete_option" href="#delMeta{{ $meta_data->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Delete Meta</span></a>
                            </td>
                @include('super.meta.meta_modal')
                @include('super.meta.meta_modal_del')
                @include('super.meta.meta_inactive')
                @include('super.meta.meta_active')
                        </tr>
               @endforeach
                      </tbody>
                  </table>
              </div>

            </div>
        </div>
    </div>
</div>
@include('super.meta.meta_add')

@endsection