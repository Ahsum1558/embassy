@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customers</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Submission Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Submission Info</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Update Submission Info of <strong>{{ $customer_statement->cusFname }} {{ $customer_statement->cusLname }}</strong></h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
            @foreach ($edit_statments as $statment)
                <form action="{{ route('admin.submission.updateStatement', ['id'=>$statment->customerId]) }}" class="form-group" method="POST" enctype="multipart/form-data">
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
                                    <div class="col-9"><span>{{ $customer_statement->customersl }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Book Ref. Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $customer_statement->bookRef }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $customer_statement->cusFname }} {{ $customer_statement->cusLname }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Passport Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $customer_statement->passportNo }}</span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Submission Date<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                        <select id="id_label_single" name="submissionId" class="form-control d-inline-block inline_setup select2-with-label-single js-states">
                                          <option selected="selected">Select Submission Date</option>
                                        @foreach($all_submission as $submission)
                                            <option value="{{ $submission->id }}" {{ $statment->submissionId == $submission->id ? 'selected' : '' }}>{{ date('d-M-Y', strtotime($submission->submissionDate)) }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Submission Type<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                    <select id="submission" name="submissionType" class="form-control d-inline-block inline_setup">
                                      <option>Select Type</option>
                            @if($statment->submissionType == 1)
                                      <option selected="selected" value="1">New Submission</option>
                                      <option value="2">Visa Extension</option>
                                      <option value="3">Visa Renew</option>
                                      <option value="4">Visa Reissue</option>
                                      <option value="5">Replacement</option>
                                      <option value="6">Cancel</option>
                                      <option value="7">N/A</option>
                            @elseif($statment->submissionType == 2)
                                      <option selected="selected" value="2">Visa Extension</option>
                                      <option value="1">New Submission</option>
                                      <option value="3">Visa Renew</option>
                                      <option value="4">Visa Reissue</option>
                                      <option value="5">Replacement</option>
                                      <option value="6">Cancel</option>
                                      <option value="7">N/A</option>
                            @elseif($statment->submissionType == 3)
                                      <option selected="selected" value="3">Visa Renew</option>
                                      <option value="1">New Submission</option>
                                      <option value="2">Visa Extension</option>
                                      <option value="4">Visa Reissue</option>
                                      <option value="5">Replacement</option>
                                      <option value="6">Cancel</option>
                                      <option value="7">N/A</option>
                            @elseif($statment->submissionType == 4)
                                      <option selected="selected" value="4">Visa Reissue</option>
                                      <option value="1">New Submission</option>
                                      <option value="2">Visa Extension</option>
                                      <option value="3">Visa Renew</option>
                                      <option value="5">Replacement</option>
                                      <option value="6">Cancel</option>
                                      <option value="7">N/A</option>
                            @elseif($statment->submissionType == 5)
                                      <option selected="selected" value="5">Replacement</option>
                                      <option value="1">New Submission</option>
                                      <option value="2">Visa Extension</option>
                                      <option value="3">Visa Renew</option>
                                      <option value="4">Visa Reissue</option>
                                      <option value="6">Cancel</option>
                                      <option value="7">N/A</option>
                            @elseif($statment->submissionType == 6)
                                      <option selected="selected" value="6">Cancel</option>
                                      <option value="1">New Submission</option>
                                      <option value="2">Visa Extension</option>
                                      <option value="3">Visa Renew</option>
                                      <option value="4">Visa Reissue</option>
                                      <option value="5">Replacement</option>
                                      <option value="7">N/A</option>
                            @else
                                      <option selected="selected" value="7">N/A</option>
                                      <option value="1">New Submission</option>
                                      <option value="2">Visa Extension</option>
                                      <option value="3">Visa Renew</option>
                                      <option value="4">Visa Reissue</option>
                                      <option value="5">Replacement</option>
                                      <option value="6">Cancel</option>
                              @endif
                                    </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Ordinal Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="ordinal" class="form-control d-inline-block inline_setup" value="{{ $statment->ordinal }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Hijri Year in Visa<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="visaYear" class="form-control d-inline-block inline_setup" value="{{ $statment->visaYear }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Status <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                    <select id="status" name="status" class="form-control d-inline-block inline_setup">
                                      <option>Select Type</option>
                            @if($statment->status == 1)
                                      <option selected="selected" value="1">Active</option>
                                      <option value="0">Inactive</option>
                              @elseif($statment->status == 0)
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
                                        <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.submission.show', ['id'=>$statment->submissionId]) }}">Back</a>
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