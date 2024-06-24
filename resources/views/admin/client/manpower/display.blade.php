@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Manpower Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">View Details</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">Manpower Info Details of <strong>{{ $manpower_display[0]->cusFname }} {{ $manpower_display[0]->cusLname }}</strong></h4>
            </div>
            <div class="card-body">
                <h4 class="mb-4 basic_headline">Manpower Info</h4>
                <div class="profile-uoloaded-post border-bottom-1 pb-5">
                    <div class="row">
                        <div class="col-xl-3 ">
                        <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="first">
                                    <img class="img-fluid img_user rounded-circle" src="{{ (!empty($manpower_display[0]->photo)) ? url('public/admin/uploads/customer/'.$manpower_display[0]->photo) : url('public/admin/assets/images/avatar.png') }}" alt="">  
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-9 col-sm-12">
                            <div class="profile-personal-info">
                                
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Serial Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $manpower_display[0]->customersl }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Book Ref. Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $manpower_display[0]->bookRef }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $manpower_display[0]->cusFname }} {{ $manpower_display[0]->cusLname }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Passport Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $manpower_display[0]->passportNo }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Visa Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $manpower_display[0]->visano_en }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Delegate<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $manpower_display[0]->agentname }} {{ $manpower_display[0]->agentsl }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Medical<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>
                                    @if($manpower_display[0]->medical == 1)
                                    {{ __('Done') }}
                                    @elseif($manpower_display[0]->medical == 2)
                                    {{ __('Fit') }}
                                    @elseif($manpower_display[0]->medical == 3)
                                    {{ __('Unfit') }}
                                    @elseif($manpower_display[0]->medical == 4)
                                    {{ __('N/A') }}
                                    @elseif($manpower_display[0]->medical == 5)
                                    {{ __('Problem') }}
                                    @endif
                                    </span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Manpower Date<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>
                                @if($manpower_display[0]->manpowerDate != NULL)
                                    {{ date('d-M-Y', strtotime($manpower_display[0]->manpowerDate)) }}
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
                                @if($manpower_display[0]->ordinal != NULL)
                                    {{ $manpower_display[0]->ordinal }}
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
                                    <div class="col-9"><span>{{ $manpower_display[0]->phone }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Gender <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>
                                        @if($manpower_display[0]->gender == 1)
                                        {{ __('Male') }}
                                        @elseif($manpower_display[0]->gender == 2)
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
                                        @if($manpower_display[0]->status == 1)
                                            {{ __('Active') }}
                                            @elseif($manpower_display[0]->status == 0)
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
                @if($manpower_display[0]->manpowerlist == 1)
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.manpower.editStatement', ['id'=>$manpower_display[0]->id]) }}">Update Customer Manpower Info</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.manpower.editFinger', ['id'=>$manpower_display[0]->id]) }}">Update Customer Finger</a>
                @endif
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.manpower') }}">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection