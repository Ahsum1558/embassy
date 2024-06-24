@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Working Rate</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Add Working Rate Info for <strong>{{ $customer_rate_info->cusFname .' '. $customer_rate_info->cusLname }}</strong></h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
                <form action="{{ route('admin.customer.storeRate', ['id'=>$customer_rate_info->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                     @csrf
                    <div class="profile-personal-info">
                
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Working Rate<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="workingRate" class="form-control d-inline-block inline_setup" placeholder="Enter Working Rate Info" value="{{ old('workingRate') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Extra Charge<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="extraCharge" class="form-control d-inline-block inline_setup" placeholder="Enter Extra Charge" value="{{ old('extraCharge') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Rate Description<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="rateDescription" class="form-control d-inline-block inline_setup" placeholder="Enter Rate Description" value="{{ old('rateDescription') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Discount<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="discount" class="form-control d-inline-block inline_setup" placeholder="Enter Discount" value="{{ old('discount') }}">
                            </div>
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-3"></div>
                        <div class="col-9 mybtn">
                            <button type="submit" name="add" class="form-control inline_setup btn submitbtn text-uppercase">Add</button>
                            <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.customer.show', ['id'=>$customer_rate_info->id]) }}">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection