@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Visa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Visa Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Create New Visa</h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
                <form action="{{ route('admin.visa.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                     @csrf
                    <div class="profile-personal-info">

                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Visa No. in English<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="visano_en" class="form-control d-inline-block inline_setup" placeholder="Enter Visa No. in English" value="{{ old('visano_en') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Visa No. in Arabic<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="visano_ar" class="form-control d-inline-block inline_setup" placeholder="Enter Visa No. in Arabic" value="{{ old('visano_ar') }}">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Sponsor Id No. in English<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="sponsorid_en" class="form-control d-inline-block inline_setup" placeholder="Enter Sponsor Id No. in English" value="{{ old('sponsorid_en') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Sponsor Id No. in Arabic<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="sponsorid_ar" class="form-control d-inline-block inline_setup" placeholder="Enter Sponsor Id No. in Arabic" value="{{ old('sponsorid_ar') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Sponsor Name in English<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="sponsorname_en" class="form-control d-inline-block inline_setup" placeholder="Enter Sponsor Name in English" value="{{ old('sponsorname_en') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Sponsor Name in Arabic<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="sponsorname_ar" class="form-control d-inline-block inline_setup" placeholder="Enter Sponsor Name in Arabic" value="{{ old('sponsorname_ar') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Visa Date in Hijri<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="visa_date" class="form-control d-inline-block inline_setup" placeholder="Enter Visa Date in Hijri" value="{{ old('visa_date') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Visa Address<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="visa_address" class="form-control d-inline-block inline_setup" placeholder="Enter Visa Address" value="{{ old('visa_address') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Visa Occupation in English<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="occupation_en" class="form-control d-inline-block inline_setup" placeholder="Enter Visa Occupation in English" value="{{ old('occupation_en') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Visa Occupation in Arabic<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="occupation_ar" class="form-control d-inline-block inline_setup" placeholder="Enter Visa Occupation in Arabic" value="{{ old('occupation_ar') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Visa Delegation/ Wakaalah No.<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="delegation_no" class="form-control d-inline-block inline_setup" placeholder="Enter Visa Delegation/ Wakaalah No." value="{{ old('delegation_no') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Visa Delegation/ Wakaalah Date<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="date" name="delegation_date" class="form-control d-inline-block inline_setup" value="{{ old('delegation_date') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Total Delegated Visa<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="delegated_visa" class="form-control d-inline-block inline_setup" placeholder="Enter Total Delegated Visa" value="{{ old('delegated_visa') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Contract Duration<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="visa_duration" class="form-control d-inline-block inline_setup" placeholder="Enter Contract Duration" value="{{ old('visa_duration') }}">
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
                            <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.visa') }}">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection