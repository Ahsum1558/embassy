@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Embassy Info</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Add Embassy Info for <strong>{{ $data_customer->cusFname .' '. $data_customer->cusLname }}</strong></h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
                <form action="{{ route('admin.customer.storeEmbassy', ['id'=>$data_customer->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                     @csrf
                    <div class="profile-personal-info">
                
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Mofa Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="mofa" class="form-control d-inline-block inline_setup" placeholder="Enter Mofa Number" value="{{ old('mofa') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Customer Religion<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="religion" class="form-control d-inline-block inline_setup" placeholder="Enter Customer Religion" value="{{ old('religion') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Customer Age<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="age" class="form-control d-inline-block inline_setup" placeholder="Enter Customer Age" value="{{ old('age') }}">
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
                                  <option value="{{ $visa_type->id }}" {{ old('visaTypeId') == $visa_type->id ? 'selected' : '' }}>{{ $visa_type->visatype_name }}</option>
                                @endforeach
                                </select>                        
                            </div>
                        </div>
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
                                    <option value="{{ $visa->id }}" {{ old('visaId') == $visa->id ? 'selected' : '' }} {{ $isDisabled }}>
                                        {{ $visa->visano_en .' - ('. $remainingVisaText .')' .' - '. $visa->occupation_ar .' - '. $visa->occupation_en }}
                                    </option>
                                @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Embassy Submission Date<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="date" name="submissionDate" class="form-control d-inline-block inline_setup" value="{{ old('submissionDate') }}" min="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3"></div>
                        <div class="col-9 mybtn">
                            <button type="submit" name="add" class="form-control inline_setup btn submitbtn text-uppercase">Add</button>
                            <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.customer.show', ['id'=>$data_customer->id]) }}">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection