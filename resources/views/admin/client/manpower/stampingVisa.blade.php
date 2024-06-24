@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Manpower Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Stamping Info</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Add Stamping Info for <strong>{{ $data_stamped_customer->cusFname .' '. $data_stamped_customer->cusLname }}</strong></h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
                <form action="{{ route('admin.manpower.storeStampingVisa', ['id'=>$data_stamped_customer->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                     @csrf
                    <div class="profile-personal-info">
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Serial Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><span>{{ $data_stamped_customer->customersl }}</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Book Ref. Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><span>{{ $data_stamped_customer->bookRef }}</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><span>{{ $data_stamped_customer->cusFname }} {{ $data_stamped_customer->cusLname }}</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Passport Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><span>{{ $data_stamped_customer->passportNo }}</span>
                            </div>
                        </div>
                
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Stamped Visa Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="stamped_visano" class="form-control d-inline-block inline_setup" placeholder="Enter Stamped Visa Number" value="{{ old('stamped_visano') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Visa Issue Date<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="date" name="visa_issue" class="form-control d-inline-block inline_setup" value="{{ old('visa_issue') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Visa Expiry Date<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="date" name="visa_expiry" class="form-control d-inline-block inline_setup" value="{{ old('visa_expiry') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Stay Duration<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="stay_duration" class="form-control d-inline-block inline_setup" placeholder="Enter Stay Duration" value="{{ old('stay_duration') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Visa Issuing Country<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="select" name="countryId" class="form-control d-inline-block inline_setup disabling-options">
                                  <option selected="selected">Select Country</option>
                                @foreach($all_country as $country)
                                  <option value="{{ $country->id }}" {{ old('countryId') == $country->id ? 'selected' : '' }}>{{ $country->countryname }}</option>
                                @endforeach
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