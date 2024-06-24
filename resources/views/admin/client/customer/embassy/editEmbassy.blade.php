@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Embassy Info</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Update Embassy Info of <strong>{{ $data_customer_edit->cusFname }} {{ $data_customer_edit->cusLname }}</strong></h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
@foreach ($embassy_edit as $embassy)
                <form action="{{ route('admin.customer.updateEmbassy', ['id'=>$embassy->customerId]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="product-detail-content">
                                <!--Product details-->
                                <div class="new-arrival-content pr">
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Religion<span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><span><input type="text" name="religion" class="form-control d-inline-block inline_setup" value="{{ $embassy->religion }}"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Age<span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><span><input type="text" name="age" class="form-control d-inline-block inline_setup" value="{{ $embassy->age }}"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Visa Type<span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9">
                                            <select id="visatype" class="form-control d-inline-block inline_setup select2-width-50" name="visaTypeId">
                                                <option>Select Visa Type</option>
                                            @foreach($all_visa_type as $visa_type)
                                                <option value="{{ $visa_type->id }}" {{ $embassy->visaTypeId == $visa_type->id ? 'selected' : '' }}>{{ $visa_type->visatype_name }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Embassy Submission Date<span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="date" name="submissionDate" class="form-control d-inline-block inline_setup" value="{{ $embassy->submissionDate }}" min="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-2">
                                        <div class="col-3"></div>
                                        <div class="col-9 mybtn">
                                            <button type="submit" name="update" class="form-control inline_setup btn submitbtn text-uppercase">Update</button>
                                            <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.customer.show', ['id'=>$data_customer_edit->id]) }}">Back</a>
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