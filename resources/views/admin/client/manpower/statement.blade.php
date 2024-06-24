@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Manpower Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Statement</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Add Statement Info for <strong>{{ $customer_manpower->cusFname }} {{ $customer_manpower->cusLname }}</strong></h4>
            </div>
            <div class="card-body">
                @include('admin.includes.alert')
                <form action="{{ route('admin.manpower.storeStatement', ['id' => $customer_manpower->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="profile-personal-info">
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Serial Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><span>{{ $customer_manpower->customersl }}</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Book Ref. Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><span>{{ $customer_manpower->bookRef }}</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><span>{{ $customer_manpower->cusFname }} {{ $customer_manpower->cusLname }}</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Passport Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><span>{{ $customer_manpower->passportNo }}</span>
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
                                  <option value="{{ $manpower->id }}" {{ old('manpowerSubId') == $manpower->id ? 'selected' : '' }}>{{ date('d-M-Y', strtotime($manpower->manpowerDate)) }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Ordinal<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="ordinal" class="form-control d-inline-block inline_setup" placeholder="Enter Statment Serial Number" value="{{ old('ordinal') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Customer Phone Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="customerPhone" class="form-control d-inline-block inline_setup" placeholder="Enter Customer Phone Number" value="{{ old('customerPhone') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Father Phone Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="fatherPhone" class="form-control d-inline-block inline_setup" placeholder="Enter Father Phone Number" value="{{ old('fatherPhone') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Mother Phone Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="motherPhone" class="form-control d-inline-block inline_setup" placeholder="Enter Mother Phone Number" value="{{ old('motherPhone') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Training Center Name/বিদেশ ফেরত<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="ttcname" class="form-control d-inline-block inline_setup" placeholder="Enter Training Center Name/বিদেশ ফেরত" value="{{ old('ttcname') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Training Certificate Number/বিদেশ ফেরত<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="certificateNo" class="form-control d-inline-block inline_setup" placeholder="Enter Training Certificate Number/বিদেশ ফেরত" value="{{ old('certificateNo') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Batch Number/বিদেশ ফেরত<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="batchNo" class="form-control d-inline-block inline_setup" placeholder="Enter Batch Number/বিদেশ ফেরত" value="{{ old('batchNo') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Roll Number/বিদেশ ফেরত<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="rollNo" class="form-control d-inline-block inline_setup" placeholder="Enter Roll Number/বিদেশ ফেরত" value="{{ old('rollNo') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Bank Account Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="accountNo" class="form-control d-inline-block inline_setup" placeholder="Enter Bank Account Number" value="{{ old('accountNo') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Bank Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="bankname" class="form-control d-inline-block inline_setup" placeholder="Enter Bank Name" value="{{ old('bankname') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Bank Branch<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="bankbranch" class="form-control d-inline-block inline_setup" placeholder="Enter Bank Branch" value="{{ old('bankbranch') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Medical Center Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="medicalCenter" class="form-control d-inline-block inline_setup" placeholder="Enter Medical Center Name" value="{{ old('medicalCenter') }}">
                            </div>
                        </div>                        
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Immigration Costs<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="immigrationCosts" class="form-control d-inline-block inline_setup" placeholder="Enter Immigration Costs" value="{{ old('immigrationCosts') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Salary<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="salary" class="form-control d-inline-block inline_setup" placeholder="Enter Salary" value="{{ old('salary') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Finger Registration Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="finger_regno" class="form-control d-inline-block inline_setup" placeholder="Enter Finger Registration Number" value="{{ old('finger_regno') }}">
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