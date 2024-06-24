@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Visa Info</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Update Visa Info of <strong>{{ $data_customer_visa->cusFname }} {{ $data_customer_visa->cusLname }}</strong></h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
@foreach ($visa_edit as $visa_info)
                <form action="{{ route('admin.customer.updateVisa', ['id'=>$visa_info->customerId]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="product-detail-content">
                                <!--Product details-->
                                <div class="new-arrival-content pr">
                                    
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Visa No<span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9">
                                            <select id="select" name="visaId" class="form-control d-inline-block inline_setup disabling-options">
                                              <option selected="selected">Select Visa No</option>
                                            @foreach($all_visa as $visa)
                                    @php
                                        $remainingVisa = isset($visaCounts[$visa->id]) ? $visa->delegated_visa - $visaCounts[$visa->id] : 0;
                                        $remainingVisaText = $remainingVisa >= 0 ? $remainingVisa : 0;
                                        $isDisabled = $remainingVisa <= 0 ? 'disabled' : '';
                                    @endphp
                                    <option value="{{ $visa->id }}" {{ $isDisabled }} {{ $visa_info->visaId == $visa->id ? 'selected' : '' }}>
                                        {{ $visa->visano_en .' - ('. $remainingVisaText .')' .' - '. $visa->occupation_ar .' - '. $visa->occupation_en }}
                                    </option>
                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-2">
                                        <div class="col-3"></div>
                                        <div class="col-9 mybtn">
                                            <button type="submit" name="update" class="form-control inline_setup btn submitbtn text-uppercase">Update</button>
                                            <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.customer.show', ['id'=>$data_customer_visa->id]) }}">Back</a>
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