@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Stamped Visa Info</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Update Stamped Visa Info of <strong>{{ $customer_stamping_info->cusFname }} {{ $customer_stamping_info->cusLname }}</strong></h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
@foreach ($stamping_edit as $stamping_info)
                <form action="{{ route('admin.customer.updateStamping', ['id'=>$stamping_info->customerId]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="product-detail-content">
                                <!--Product details-->
                                <div class="new-arrival-content pr">

                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Visa Issue Date<span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="date" name="visa_issue" class="form-control d-inline-block inline_setup" value="{{ $stamping_info->visa_issue }}">
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Visa Expiry Date<span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="date" name="visa_expiry" class="form-control d-inline-block inline_setup" value="{{ $stamping_info->visa_expiry }}">
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Duration of Stay<span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><span><input type="text" name="stay_duration" class="form-control d-inline-block inline_setup" value="{{ $stamping_info->stay_duration }}"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Issuing Country Name<span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9">
                                            <select id="select" name="countryId" class="form-control d-inline-block inline_setup disabling-options">
                                              <option selected="selected">Select Issuing Country</option>
                                            @foreach($all_country as $country)
                                                <option value="{{ $country->id }}" {{ $stamping_info->countryId == $country->id ? 'selected' : '' }}>{{ $country->countryname }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3"></div>
                                        <div class="col-9 mybtn">
                                            <button type="submit" name="update" class="form-control inline_setup btn submitbtn text-uppercase">Update</button>
                                            <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.customer.show', ['id'=>$customer_stamping_info->id]) }}">Back</a>
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