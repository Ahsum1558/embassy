@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Location</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Police Station</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Police Station Details</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">Police Station Details of {{ $upzila_single_data[0]->policestationname }}</h4>
            </div>
            <div class="card-body">
                <h4 class="mb-4 basic_headline">Police Station Info</h4>
                <div class="profile-uoloaded-post border-bottom-1 pb-5">
                    <div class="row">
                        
                        <div class="col-xl-12 col-sm-12">
                            <div class="profile-personal-info">
                            
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Police Station Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $upzila_single_data[0]->policestationname }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">District Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $upzila_single_data[0]->districtname }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Division Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $upzila_single_data[0]->divisionname }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Country Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $upzila_single_data[0]->countryname }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Status<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>
                                        @if($upzila_single_data[0]->status == 1)
                                            {{ __('Active') }}
                                            @elseif($upzila_single_data[0]->status == 0)
                                            {{ __('Inactive') }}
                                        @endif
                                    </span>
                                    </div>
                                </div>
                               
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Created At<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ date('d-M-Y', strtotime($upzila_single_data[0]->created_at)) }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="mybtn">
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.policestation.edit', ['id'=>$upzila_single_data[0]->id]) }}">Update Name</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.policestation.editInfo', ['id'=>$upzila_single_data[0]->id]) }}">Update Info</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.policestation') }}">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection