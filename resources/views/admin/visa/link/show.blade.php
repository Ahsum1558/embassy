@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Important Links</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Links</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Details</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">Link Details of {{ $single_link->linkname }}</h4>
            </div>
            <div class="card-body">
                <h4 class="mb-4 basic_headline">Link Info</h4>
                <div class="profile-uoloaded-post border-bottom-1 pb-5">
                    <div class="row">
                        
                        <div class="col-xl-12 col-sm-12">
                            <div class="profile-personal-info">
                            
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Link Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_link->linkname }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Link Type<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_link->linktype }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Link Url<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><a target="_blank" href="{{ $single_link->linkurl }}">{{ $single_link->linkurl }}</a></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Status<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>
                                        @if($single_link->status == 1)
                                            {{ __('Active') }}
                                            @elseif($single_link->status == 0)
                                            {{ __('Inactive') }}
                                        @endif
                                    </span>
                                    </div>
                                </div>
                               
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Created At<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ date('d-M-Y', strtotime($single_link->created_at)) }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="mybtn">
                @if(Auth::check() && Auth::user()->role == 'admin' && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar))
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.link.edit', ['id'=>$single_link->id]) }}">Update Info</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.link.editUrl', ['id'=>$single_link->id]) }}">Update Url</a>
                @endif
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.link') }}">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection