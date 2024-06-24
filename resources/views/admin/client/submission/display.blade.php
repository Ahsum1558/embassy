@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Submission Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">View Details</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">Submission Info Details of <strong>{{ $customer_display[0]->cusFname }} {{ $customer_display[0]->cusLname }}</strong></h4>
            </div>
            <div class="card-body">
                <h4 class="mb-4 basic_headline">Submission Info</h4>
                <div class="profile-uoloaded-post border-bottom-1 pb-5">
                    <div class="row">
                        <div class="col-xl-3 ">
                        <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="first">
                                    <img class="img-fluid img_user rounded-circle" src="{{ (!empty($customer_display[0]->photo)) ? url('public/admin/uploads/customer/'.$customer_display[0]->photo) : url('public/admin/assets/images/avatar.png') }}" alt="">  
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-9 col-sm-12">
                            <div class="profile-personal-info">
                                
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Serial Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $customer_display[0]->customersl }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Book Ref. Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $customer_display[0]->bookRef }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $customer_display[0]->cusFname }} {{ $customer_display[0]->cusLname }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Passport Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $customer_display[0]->passportNo }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Visa Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $customer_display[0]->visano_en }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Delegate<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $customer_display[0]->agentname }} {{ $customer_display[0]->agentsl }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Medical<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>
                                    @if($customer_display[0]->medical == 1)
                                    {{ __('Done') }}
                                    @elseif($customer_display[0]->medical == 2)
                                    {{ __('Fit') }}
                                    @elseif($customer_display[0]->medical == 3)
                                    {{ __('Unfit') }}
                                    @elseif($customer_display[0]->medical == 4)
                                    {{ __('N/A') }}
                                    @elseif($customer_display[0]->medical == 5)
                                    {{ __('Problem') }}
                                    @endif
                                    </span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Submission Type<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>
                                @if($customer_display[0]->submissionType == 1)
                                    {{ __('New Submission') }}
                                    @elseif($customer_display[0]->submissionType == 2)
                                    {{ __('Visa Extension') }}
                                    @elseif($customer_display[0]->submissionType == 3)
                                    {{ __('Visa Renew') }}
                                    @elseif($customer_display[0]->submissionType == 4)
                                    {{ __('Visa Reissue') }}
                                    @elseif($customer_display[0]->submissionType == 5)
                                    {{ __('Replacement') }}
                                    @elseif($customer_display[0]->submissionType == 6)
                                    {{ __('Cancel') }}
                                    @else
                                    {{ __('N/A') }}
                                @endif
                                    </span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Submission Date<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>
                                @if($customer_display[0]->submissionDate != NULL)
                                    {{ date('d-M-Y', strtotime($customer_display[0]->submissionDate)) }}
                                    @else
                                    {{ __('N/A') }}
                                @endif
                                    </span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Ordinal/ List Serial Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>
                                @if($customer_display[0]->ordinal != NULL)
                                    {{ $customer_display[0]->ordinal }}
                                    @else
                                    {{ __('N/A') }}
                                @endif
                                    </span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Phone Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $customer_display[0]->phone }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Gender <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>
                                        @if($customer_display[0]->gender == 1)
                                        {{ __('Male') }}
                                        @elseif($customer_display[0]->gender == 2)
                                        {{ __('Female') }}
                                        @else
                                        {{ __('Other') }}
                                        @endif
                                    </span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Status<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>
                                        @if($customer_display[0]->status == 1)
                                            {{ __('Active') }}
                                            @elseif($customer_display[0]->status == 0)
                                            {{ __('Inactive') }}
                                        @endif
                                    </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="mybtn">
                @if($customer_display[0]->emblist == 1)
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.submission.editStatement', ['id'=>$customer_display[0]->id]) }}">Update Submission Info</a>
                @endif
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.submission') }}">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection