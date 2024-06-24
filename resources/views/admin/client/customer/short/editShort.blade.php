@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Primary Short</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Update Primary Short Info of <strong>{{ $customer_data_info->cusFname .' '. $customer_data_info->cusLname }}</strong></h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
                <form action="{{ route('admin.customer.updateShort', ['id'=>$customer_data_info->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <!--Tab slider End-->
                    <div class="col">
                        <div class="product-detail-content">
                            <!--Product details-->
                            <div class="new-arrival-content pr">

                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">First Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><input type="text" name="cusFname" class="form-control d-inline-block inline_setup" value="{{ $customer_data_info->cusFname }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Last Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><input type="text" name="cusLname" class="form-control d-inline-block inline_setup" value="{{ $customer_data_info->cusLname }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Birth of Place<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                        <select id="single-select" name="birthPlace" class="form-control d-inline-block inline_setup">
                                          <option selected="selected">Select Birth of Place</option>
                                    @foreach($all_district as $district)
                                      <option value="{{ $district->id }}" {{ $customer_data_info->birthPlace == $district->id ? 'selected' : '' }}>{{ $district->districtname }}</option>
                                    @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Gender<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                        <span class="form-check d-inline-block mr-2">
                                            <input type="radio" name="gender" value="1" {{ $customer_data_info->gender == 1 ? 'checked' : '' }} class="form-check-input">Male
                                        </span>
                                        <span class="form-check d-inline-block mr-2">
                                            <input type="radio" name="gender" value="2" {{ $customer_data_info->gender == 2 ? 'checked' : '' }} class="form-check-input">Female
                                        </span>
                                        <span class="form-check d-inline-block mr-2">
                                            <input type="radio" name="gender" value="3" {{ $customer_data_info->gender == 3 ? 'checked' : '' }} class="form-check-input">Other
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Medical<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                        <span class="form-check d-inline-block mr-2">
                                            <input type="radio" name="medical" value="2" {{ $customer_data_info->medical == 2 ? 'checked' : '' }} class="form-check-input">Fit
                                        </span>
                                        <span class="form-check d-inline-block mr-2">
                                            <input type="radio" name="medical" value="1" {{ $customer_data_info->medical == 1 ? 'checked' : '' }} class="form-check-input">Done
                                        </span>
                                        <span class="form-check d-inline-block mr-2">
                                            <input type="radio" name="medical" value="3" {{ $customer_data_info->medical == 3 ? 'checked' : '' }} class="form-check-input">Unfit
                                        </span>
                                        <span class="form-check d-inline-block mr-2">
                                            <input type="radio" name="medical" value="4" {{ $customer_data_info->medical == 4 ? 'checked' : '' }} class="form-check-input">N/A
                                        </span>
                                        <span class="form-check d-inline-block mr-2">
                                            <input type="radio" name="medical" value="5" {{ $customer_data_info->medical == 5 ? 'checked' : '' }} class="form-check-input">Problem
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Medical Update<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                        <span class="form-check d-inline-block mr-2">
                                            <input type="radio" name="medical_update" value="1" {{ $customer_data_info->medical_update == 1 ? 'checked' : '' }} class="form-check-input">Medical Updated
                                        </span>
                                        <span class="form-check d-inline-block mr-2">
                                            <input type="radio" name="medical_update" value="0" {{ $customer_data_info->medical_update == 0 ? 'checked' : '' }} class="form-check-input">Medical Not Updated
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Status<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                        <span class="form-check d-inline-block mr-2">
                                            <input type="radio" name="status" value="1" {{ $customer_data_info->status == 1 ? 'checked' : '' }} class="form-check-input">Active
                                        </span>
                                        <span class="form-check d-inline-block mr-2">
                                            <input type="radio" name="status" value="0" {{ $customer_data_info->status == 0 ? 'checked' : '' }} class="form-check-input">Inactive
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3"></div>
                                    <div class="col-9 mybtn">
                                        <button type="submit" name="update" class="form-control inline_setup btn submitbtn text-uppercase">Update</button>
                                        <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.customer.show', ['id'=>$customer_data_info->id]) }}">Back</a>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3"></div>
                                    <div class="col-9 mybtn">
                                        <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.customer.insertShort') }}">Back To Short Field</a>
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