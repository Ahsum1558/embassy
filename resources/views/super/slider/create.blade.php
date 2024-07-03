@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Site Option</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home Slider</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Create New Slider</h4>
            </div>
            <div class="card-body">
@include('super.includes.alert')
                <form action="{{ route('super.slider.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                     @csrf
                    <div class="profile-personal-info">
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Slider Image<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="file" name="slide_img" class="form-control d-inline-block inline_setup">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Slider Head Line<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="slide_head" class="form-control d-inline-block inline_setup" placeholder="Enter Slider Head Line" value="{{ old('slide_head') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Slider Description<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="slide_des" class="form-control d-inline-block inline_setup" placeholder="Enter Slider Description" value="{{ old('slide_des') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Image URL<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="img_url" class="form-control d-inline-block inline_setup" placeholder="Enter Slider Image URL Link" value="{{ old('img_url') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Description URL<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="des_url" class="form-control d-inline-block inline_setup" placeholder="Enter Slider Description URL Link" value="{{ old('des_url') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Status <span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="status" name="status" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Type</option>
                                  <option value="1">Active</option>
                                  <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3"></div>
                        <div class="col-9 mybtn">
                            <button type="submit" name="addOption" class="form-control inline_setup btn submitbtn text-uppercase">Add</button>
                            <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('super.slider') }}">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection