@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Location</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Country</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Create New Country</h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
                <form action="{{ route('admin.country.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                     @csrf
                    <div class="profile-personal-info">

                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Country Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="countryname" class="form-control d-inline-block inline_setup" placeholder="Enter Country Name" value="{{ old('countryname') }}">
                            </div>
                        </div>
                        
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Nationality<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="nationality" class="form-control d-inline-block inline_setup" placeholder="Enter Nationality" value="{{ old('nationality') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Currency Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="currency" class="form-control d-inline-block inline_setup" placeholder="Enter Currency Name" value="{{ old('currency') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Phone Code<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="phone_code" class="form-control d-inline-block inline_setup" placeholder="Enter Phone Code" value="{{ old('phone_code') }}">
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
                            <button type="submit" name="addcity" class="form-control inline_setup btn submitbtn text-uppercase">Add</button>
                            <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.country') }}">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection