@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Site Option</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home Slider</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Info</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Update Home Slider Info</h4>
            </div>
            <div class="card-body">
@include('super.includes.alert')
                <form action="{{ route('super.slider.update', ['id'=>$data_slider->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <!--Tab slider End-->
                    <div class="col">
                        <div class="product-detail-content">
                            <!--Product details-->
                            <div class="new-arrival-content pr">
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Slider Head Line<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="slide_head" class="form-control d-inline-block inline_setup" value="{{ $data_slider->slide_head }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Slider Description<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="slide_des" class="form-control d-inline-block inline_setup" value="{{ $data_slider->slide_des }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Image URL<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="img_url" class="form-control d-inline-block inline_setup" value="{{ $data_slider->img_url }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Description URL<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="des_url" class="form-control d-inline-block inline_setup" value="{{ $data_slider->des_url }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Status<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                    <select id="status" name="status" class="form-control d-inline-block inline_setup">
                                      <option>Select Type</option>
                            @if($data_slider->status == 1)
                                      <option selected="selected" value="1">Active</option>
                                      <option value="0">Inactive</option>
                              @elseif($data_slider->status == 0)
                                      <option selected="selected" value="0">Inactive</option>
                                      <option value="1">Active</option>
                              @endif
                                    </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3"></div>
                                    <div class="col-9 mybtn">
                                        <button type="submit" name="updateOption" class="form-control inline_setup btn submitbtn text-uppercase">Update</button>
                                        <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('super.slider.show', ['id'=>$data_slider->id]) }}">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection