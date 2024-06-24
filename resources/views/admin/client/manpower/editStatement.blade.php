@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customers</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Manpower Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Customer Manpower</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Update Manpower Info of <strong>{{ $manpower_customers->cusFname }} {{ $manpower_customers->cusLname }}</strong></h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
            @foreach ($edit_manpower as $manpower_cust)
                <form action="{{ route('admin.manpower.updateStatement', ['id'=>$manpower_cust->customerId]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <!--Tab slider End-->
                    <div class="col">
                        <div class="product-detail-content">
                            <!--Product details-->
                            <div class="new-arrival-content pr">
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Serial Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $manpower_customers->customersl }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Book Ref. Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $manpower_customers->bookRef }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $manpower_customers->cusFname }} {{ $manpower_customers->cusLname }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Passport Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $manpower_customers->passportNo }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Manpower Date<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                        <select id="id_label_single" name="manpowerSubId" class="form-control d-inline-block inline_setup select2-with-label-single js-states">
                                          <option selected="selected">Select Manpower Date</option>
                                        @foreach($all_manpower as $manpower)
                                            <option value="{{ $manpower->id }}" {{ $manpower_cust->manpowerSubId == $manpower->id ? 'selected' : '' }}>{{ date('d-M-Y', strtotime($manpower->manpowerDate)) }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Ordinal Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="ordinal" class="form-control d-inline-block inline_setup" value="{{ $manpower_cust->ordinal }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Customer Phone Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="customerPhone" class="form-control d-inline-block inline_setup" value="{{ $manpower_cust->customerPhone }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Father Phone Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="fatherPhone" class="form-control d-inline-block inline_setup" value="{{ $manpower_cust->fatherPhone }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Mother Phone Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="motherPhone" class="form-control d-inline-block inline_setup" value="{{ $manpower_cust->motherPhone }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Training Center Name/বিদেশ ফেরত<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="ttcname" class="form-control d-inline-block inline_setup" value="{{ $manpower_cust->ttcname }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Training Certificate Number/বিদেশ ফেরত<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="certificateNo" class="form-control d-inline-block inline_setup" value="{{ $manpower_cust->certificateNo }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Batch Number/বিদেশ ফেরত<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="batchNo" class="form-control d-inline-block inline_setup" value="{{ $manpower_cust->batchNo }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Roll Number/বিদেশ ফেরত<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="rollNo" class="form-control d-inline-block inline_setup" value="{{ $manpower_cust->rollNo }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Bank Account Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="accountNo" class="form-control d-inline-block inline_setup" value="{{ $manpower_cust->accountNo }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Bank Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="bankname" class="form-control d-inline-block inline_setup" value="{{ $manpower_cust->bankname }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Branch Location<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="bankbranch" class="form-control d-inline-block inline_setup" value="{{ $manpower_cust->bankbranch }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Medical Center Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="medicalCenter" class="form-control d-inline-block inline_setup" value="{{ $manpower_cust->medicalCenter }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Salary<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="salary" class="form-control d-inline-block inline_setup" value="{{ $manpower_cust->salary }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Immigration Costs<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="immigrationCosts" class="form-control d-inline-block inline_setup" value="{{ $manpower_cust->immigrationCosts }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Status <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                    <select id="status" name="status" class="form-control d-inline-block inline_setup">
                                      <option>Select Type</option>
                            @if($manpower_cust->status == 1)
                                      <option selected="selected" value="1">Active</option>
                                      <option value="0">Inactive</option>
                              @elseif($manpower_cust->status == 0)
                                      <option selected="selected" value="0">Inactive</option>
                                      <option value="1">Active</option>
                              @endif
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-3"></div>
                                    <div class="col-9 mybtn">
                                        <button type="submit" name="update" class="form-control inline_setup btn submitbtn text-uppercase">Update</button>
                                        <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.manpower.show', ['id'=>$manpower_cust->manpowerSubId]) }}">Back</a>
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