@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Manpower Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Manpower</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Add Manpower Info for <strong>{{ date('d-M-Y', strtotime($manpower_data->manpowerDate)) }}</strong></h4>
            </div>
            <div class="card-body">
                @include('admin.includes.alert')
                <form action="{{ route('admin.manpower.storePayment', ['id' => $manpower_data->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="profile-personal-info">
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Total Customer<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="customerNumber" class="form-control d-inline-block inline_setup" placeholder="Enter Total Customer" value="{{ old('customerNumber') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Income Tax Payment Bank<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="taxPayBank" class="form-control d-inline-block inline_setup" placeholder="Enter Income Tax Payment Bank" value="{{ old('taxPayBank') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Income Tax Amount<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="incomeTax" class="form-control d-inline-block inline_setup" placeholder="Enter Income Tax Amount" value="{{ old('incomeTax') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Income Tax Pay Order Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="incomeTaxNo" class="form-control d-inline-block inline_setup" placeholder="Enter Income Tax Pay Order Number" value="{{ old('incomeTaxNo') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Income Tax Pay Order Date<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="date" name="incomeTaxDate" class="form-control d-inline-block inline_setup" value="{{ old('incomeTaxDate') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Welfare Insurance Payment Bank<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="insurancePayBank" class="form-control d-inline-block inline_setup" placeholder="Enter Welfare Insurance Payment Bank" value="{{ old('insurancePayBank') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Welfare Insurance Amount<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="welfareInsurance" class="form-control d-inline-block inline_setup" placeholder="Enter Welfare Insurance Amount" value="{{ old('welfareInsurance') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Welfare Insurance Pay Order Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="welfareInsuranceNo" class="form-control d-inline-block inline_setup" placeholder="Enter Welfare Insurance Pay Order Number" value="{{ old('welfareInsuranceNo') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Welfare Insurance Pay Order Date<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="date" name="welfareInsuranceDate" class="form-control d-inline-block inline_setup" value="{{ old('welfareInsuranceDate') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Smart Card Payment Bank<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="smartPayBank" class="form-control d-inline-block inline_setup" placeholder="Enter Smart Card Payment Bank" value="{{ old('smartPayBank') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Smart Card Amount<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="smartCard" class="form-control d-inline-block inline_setup" placeholder="Enter Smart Card Amount" value="{{ old('smartCard') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Smart Card Pay Order Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="smartCardNo" class="form-control d-inline-block inline_setup" placeholder="Enter Smart Card Pay Order Number" value="{{ old('smartCardNo') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Smart Card Pay Order Date<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="date" name="smartCardDate" class="form-control d-inline-block inline_setup" value="{{ old('smartCardDate') }}">
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