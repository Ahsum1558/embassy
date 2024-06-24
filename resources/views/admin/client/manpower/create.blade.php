@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Manpower Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Create New Manpower</h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
                <form action="{{ route('admin.manpower.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                     @csrf
                    <div class="profile-personal-info">
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Manpower Date<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="date" name="manpowerDate" class="form-control d-inline-block inline_setup" value="{{ old('manpowerDate') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Note Sheet No.<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="putupSl" class="form-control d-inline-block inline_setup" placeholder="Enter Note Sheet No." value="{{ old('putupSl') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Destination Country in Bengali<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="countrynamebn" class="form-control d-inline-block inline_setup" placeholder="Enter Destination Country Name in Bengali" value="{{ old('countrynamebn') }}">
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
                            <button type="submit" name="add" class="form-control inline_setup btn submitbtn text-uppercase">Add</button>
                            <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.manpower') }}">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection