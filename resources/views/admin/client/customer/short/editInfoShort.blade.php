@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Passport Info Short</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Update Passport Info Short of <strong>{{ $customer_info_edit->cusFname }} {{ $customer_info_edit->cusLname }}</strong></h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
@foreach ($passport_edit as $passport)
                <form action="{{ route('admin.customer.updateInfoShort', ['id'=>$passport->customerId]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <!--Tab slider End-->
                    <div class="col">
                        <div class="product-detail-content">
                            <!--Product details-->
                            <div class="new-arrival-content pr">
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Father Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="father" class="form-control d-inline-block inline_setup" value="{{ $passport->father }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Mother Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="mother" class="form-control d-inline-block inline_setup" value="{{ $passport->mother }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Spouse<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="spouse" class="form-control d-inline-block inline_setup" value="{{ $passport->spouse }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Date Of Birth<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><input type="date" name="dateOfBirth" class="form-control d-inline-block inline_setup" value="{{ $passport->dateOfBirth }}" max="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Passport Issue Date<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><input type="date" name="passportIssue" class="form-control d-inline-block inline_setup" value="{{ $passport->passportIssue }}" max="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Passport Expiry Date<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><input type="date" name="passportExpiry" class="form-control d-inline-block inline_setup" value="{{ $passport->passportExpiry }}" min="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Marital Status<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                        <span class="form-check d-inline-block mr-2">
                                            <input type="radio" name="maritalStatus" value="1" {{ $passport->maritalStatus == 1 ? 'checked' : '' }} class="form-check-input">Single
                                        </span>
                                        <span class="form-check d-inline-block mr-2">
                                            <input type="radio" name="maritalStatus" value="2" {{ $passport->maritalStatus == 2 ? 'checked' : '' }} class="form-check-input">Married
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Passport Type<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                        <span class="form-check d-inline-block mr-2">
                                            <input type="radio" name="passportType" value="5" {{ $passport->passportType == 5 ? 'checked' : '' }} class="form-check-input">5 Years
                                        </span>
                                        <span class="form-check d-inline-block mr-2">
                                            <input type="radio" name="passportType" value="10" {{ $passport->passportType == 10 ? 'checked' : '' }} class="form-check-input">10 Years
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3"></div>
                                    <div class="col-9 mybtn">
                                        <button type="submit" name="update" class="form-control inline_setup btn submitbtn text-uppercase">Update</button>
                                        <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.customer.show', ['id'=>$customer_info_edit->id]) }}">Back</a>
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
@endforeach
            </div>
        </div>
    </div>
</div>
@endsection