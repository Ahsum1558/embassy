@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Manpower Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Payment Info</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Update Manpower Payment Information</h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
                <form action="{{ route('admin.manpower.updatePayment', ['id'=>$payment_bmet->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <!--Tab slider End-->
                    <div class="col">
                        <div class="product-detail-content">
                            <!--Product details-->
                            <div class="new-arrival-content pr">
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Manpower Date<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                        <select id="id_label_single" name="manpowerSubId" class="form-control d-inline-block inline_setup select2-with-label-single js-states">
                                          <option selected="selected">Select Manpower Date</option>
                                        @foreach($all_manpower as $manpower)
                                            <option value="{{ $manpower->id }}" {{ $payment_bmet->manpowerSubId == $manpower->id ? 'selected' : '' }}>{{ date('d-M-Y', strtotime($manpower->manpowerDate)) }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Total Customer<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="customerNumber" class="form-control d-inline-block inline_setup" value="{{ $payment_bmet->customerNumber }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Income Tax Payment Bank<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="taxPayBank" class="form-control d-inline-block inline_setup" value="{{ $payment_bmet->taxPayBank }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Income Tax Amount<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="incomeTax" class="form-control d-inline-block inline_setup" value="{{ $payment_bmet->incomeTax }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Income Tax Payment Date<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="date" name="incomeTaxDate" class="form-control d-inline-block inline_setup" value="{{ $payment_bmet->incomeTaxDate }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Welfare Insurance Payment Bank<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="insurancePayBank" class="form-control d-inline-block inline_setup" value="{{ $payment_bmet->insurancePayBank }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Welfare Insurance Amount<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="welfareInsurance" class="form-control d-inline-block inline_setup" value="{{ $payment_bmet->welfareInsurance }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Welfare Insurance Payment Date<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="date" name="welfareInsuranceDate" class="form-control d-inline-block inline_setup" value="{{ $payment_bmet->welfareInsuranceDate }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Smart Card Payment Bank<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="smartPayBank" class="form-control d-inline-block inline_setup" value="{{ $payment_bmet->smartPayBank }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Smart Card Amount<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="smartCard" class="form-control d-inline-block inline_setup" value="{{ $payment_bmet->smartCard }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Smart Card Payment Date<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="date" name="smartCardDate" class="form-control d-inline-block inline_setup" value="{{ $payment_bmet->smartCardDate }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Status <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                    <select id="select" name="status" class="form-control d-inline-block inline_setup">
                                      <option>Select Type</option>
                            @if($payment_bmet->status == 1)
                                      <option selected="selected" value="1">Active</option>
                                      <option value="0">Inactive</option>
                              @elseif($payment_bmet->status == 0)
                                      <option selected="selected" value="0">Inactive</option>
                                      <option value="1">Active</option>
                              @endif
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-3"></div>
                                    <div class="col-9 mybtn">
                                        <button type="submit" name="updateDistrict" class="form-control inline_setup btn submitbtn text-uppercase">Update</button>
                                        <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.manpower.show', ['id'=>$payment_bmet->manpowerSubId]) }}">Back</a>
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