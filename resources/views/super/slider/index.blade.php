@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Site Option</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Home Slider</a></li>
        </ol>
    </div>
</div>
@include('super.includes.alert')
<div class="mybtn">
  <a href="{{ route('super.slider.create') }}" class="btn submitbtn mb-2 form-control inline_setup text-uppercase">Add New Slider</a>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">Home Slider Area</h4>
            </div>
            <div class="card-body">
              <h4 class="mb-4 basic_headline">All Slider</h4>
              <div class="table-responsive">
                  <table id="example" class="display" style="min-width: 700px">
                      <thead>
                          <tr>
                              <th>SL</th>
                              <th>Heading</th>
                              <th>Description</th>
                              <th>Image</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php
                          $i=1;
                        @endphp
                      @foreach($all_slider as $slider)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td><a href="{{ route('super.slider.show', ['id'=>$slider->id]) }}">{{ Str::limit($slider->slide_head, 50) }}</a></td>
                            <td>{{ Str::limit($slider->slide_des, 50) }}</td>
                            <td><img class="img-fluid" src="{{ (!empty($slider->slide_img)) ? url('public/admin/uploads/slider/'.$slider->slide_img) : url('public/admin/assets/images/avatar.png') }}" width="100" alt=""></td>
                            <td>
                              @if($slider->status == 1)
                                {{ __('Active') }}
                                @elseif($slider->status == 0)
                                {{ __('Inactive') }}
                              @endif
                            </td>
                            <td>
                              <a class="view_option" href="{{ route('super.slider.show', ['id'=>$slider->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
                            @if($slider->status == 1)
                              <a class="edit_option bg-warning" href="#inActiveId{{ $slider->id }}" data-toggle="modal"><i class="fas fa-caret-square-down"></i><span>Set Inactive</span></a>
                            @elseif($slider->status == 0)
                              <a class="edit_option" href="#activeId{{ $slider->id }}" data-toggle="modal"><i class="fas fa-caret-square-up"></i><span>Set Active</span></a>
                            @endif
                              <a class="delete_option" href="#delSlider{{ $slider->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Delete Option</span></a>
                            </td>
                @include('super.slider.slider_modal')
                @include('super.slider.slider_inactive')
                @include('super.slider.slider_active')
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