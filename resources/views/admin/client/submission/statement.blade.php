@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Submission Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Statement</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Add Statement Info for <strong>{{ $customer_emb->cusFname }} {{ $customer_emb->cusLname }}</strong></h4>
            </div>
            <div class="card-body">
                @include('admin.includes.alert')
                <form action="{{ route('admin.submission.storeStatement', ['id' => $customer_emb->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="profile-personal-info">
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Serial Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><span>{{ $customer_emb->customersl }}</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Book Ref. Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><span>{{ $customer_emb->bookRef }}</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><span>{{ $customer_emb->cusFname }} {{ $customer_emb->cusLname }}</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Passport Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><span>{{ $customer_emb->passportNo }}</span>
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
                                  <option value="{{ $submission->id }}" {{ old('submissionId') == $submission->id ? 'selected' : '' }}>{{ date('d-M-Y', strtotime($submission->submissionDate)) }}</option>
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
                                  <option selected="selected">Select Submission Type</option>
                                  <option value="1" {{ old('submission') == 1 ? 'selected' : '' }}>New Submission</option>
                                  <option value="2" {{ old('submission') == 2 ? 'selected' : '' }}>Visa Extension</option>
                                  <option value="3" {{ old('submission') == 3 ? 'selected' : '' }}>Visa Renew</option>
                                  <option value="4" {{ old('submission') == 4 ? 'selected' : '' }}>Visa Reissue</option>
                                  <option value="5" {{ old('submission') == 5 ? 'selected' : '' }}>Replacement</option>
                                  <option value="6" {{ old('submission') == 6 ? 'selected' : '' }}>Cancel</option>
                                  <option value="7" {{ old('submission') == 7 ? 'selected' : '' }}>N/A</option>
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
                                <h5 class="f-w-500">Hijri Year in Visa<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="visaYear" class="form-control d-inline-block inline_setup" placeholder="Enter Hijri Year in Visa" value="{{ old('visaYear') }}">
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
                            <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.submission') }}">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection