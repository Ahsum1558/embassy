@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Site Option</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Option in English</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Option Details</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">English Site Option Details</h4>
            </div>
            <div class="card-body">
                <h4 class="mb-4 basic_headline">Site Option Info</h4>
                <div class="profile-uoloaded-post border-bottom-1 pb-5">
                    <div class="row">
                        <div class="col-xl-3 ">
                        <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="first">
                                    <img class="img-fluid img_user rounded-circle" src="{{ (!empty($single_field_data->logo)) ? url('public/admin/uploads/field/'.$single_field_data->logo) : url('public/admin/assets/images/avatar.png') }}" alt="">  
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-sm-12">
                            <div class="profile-personal-info">
                            
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Title<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_field_data->title }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Small Title<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_field_data->smalltitle }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">License Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_field_data->license }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">License Expiry Date<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ date('d-M-Y', strtotime($single_field_data->licenseExpiry)) }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Description<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_field_data->description }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Office Address <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_field_data->address }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Proprietor Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_field_data->proprietor }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Proprietor Title<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_field_data->proprietortitle }}</span>
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Telephone Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_field_data->telephone }}</span>
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Cellphone Number <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_field_data->cellphone }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Helpline Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_field_data->helpline }}</span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">E-Mail Address<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_field_data->email }}</span>
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Web Address<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_field_data->web }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Status<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>
                                        @if($single_field_data->status == 1)
                                            {{ __('Active') }}
                                            @elseif($single_field_data->status == 0)
                                            {{ __('Inactive') }}
                                        @endif
                                    </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Created At<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ date('d-M-Y', strtotime($single_field_data->created_at)) }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="mybtn">
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('super.field.edit', ['id'=>$single_field_data->id]) }}">Update Info</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('super.field.editTitle', ['id'=>$single_field_data->id]) }}">Update Title</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('super.field.editSmallTitle', ['id'=>$single_field_data->id]) }}">Update Small Title</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('super.field.editLicense', ['id'=>$single_field_data->id]) }}">Update License Number</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('super.field.editLogo', ['id'=>$single_field_data->id]) }}">Update Logo</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('super.field') }}">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection