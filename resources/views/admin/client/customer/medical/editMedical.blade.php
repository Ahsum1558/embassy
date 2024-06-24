@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Medical Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Medical</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Update Medical Info of <strong>{{ $customer_medical->cusFname .' '. $customer_medical->cusLname }}</strong></h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
                <form action="{{ route('admin.customer.updateMedical', ['id'=>$customer_medical->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <!--Tab slider End-->
                    <div class="col">
                        <div class="product-detail-content">
                            <!--Product details-->
                            <div class="new-arrival-content pr">

                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Medical<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                    <select id="medical" name="medical" class="form-control d-inline-block inline_setup">
                                      <option>Select Medical</option>
                            @if($customer_medical->medical == 1)
                                      <option selected="selected" value="1">Done</option>
                                      <option value="2">Fit</option>
                                      <option value="3">Unfit</option>
                                      <option value="4">N/A</option>
                                      <option value="5">Problem</option>
                            @elseif($customer_medical->medical == 2)
                                      <option selected="selected" value="2">Fit</option>
                                      <option value="1">Done</option>
                                      <option value="3">Unfit</option>
                                      <option value="4">N/A</option>
                                      <option value="5">Problem</option>
                            @elseif($customer_medical->medical == 3)
                                      <option selected="selected" value="3">Unfit</option>
                                      <option value="1">Done</option>
                                      <option value="2">Fit</option>
                                      <option value="4">N/A</option>
                                      <option value="5">Problem</option>
                            @elseif($customer_medical->medical == 4)
                                      <option selected="selected" value="4">N/A</option>
                                      <option value="1">Done</option>
                                      <option value="2">Fit</option>
                                      <option value="3">Unfit</option>
                                      <option value="5">Problem</option>
                            @else
                                      <option selected="selected" value="5">Problem</option>
                                      <option value="1">Done</option>
                                      <option value="2">Fit</option>
                                      <option value="3">Unfit</option>
                                      <option value="4">N/A</option>
                            @endif
                                    </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Medical Update<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                    <select id="medicalUpdate" name="medical_update" class="form-control d-inline-block inline_setup">
                                      <option>Select Medical Update</option>
                            @if($customer_medical->medical_update == 1)
                                      <option selected="selected" value="1">Medical Updated</option>
                                      <option value="0">Medical Not Updated</option>
                            @else
                                      <option selected="selected" value="0">Medical Not Updated</option>
                                      <option value="1">Medical Updated</option>
                            @endif
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-3"></div>
                                    <div class="col-9 mybtn">
                                        <button type="submit" name="update" class="form-control inline_setup btn submitbtn text-uppercase">Update</button>
                                        <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.customer.medical') }}">Back</a>
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