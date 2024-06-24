@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Setting</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Header and Footer</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Show</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">Header and Footer Option Details</h4>
            </div>
            <div class="card-body">
                <h4 class="mb-4 basic_headline">Office Info Details</h4>
                <div class="profile-uoloaded-post border-bottom-1 pb-5">
                    <div class="row">
                        <div class="col-xl-3 ">
                        <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="first">
                                    <img class="img-fluid img_user rounded-circle" src="{{ (!empty($header_footer_single_data[0]->logo)) ? url('public/admin/uploads/field/'.$header_footer_single_data[0]->logo) : url('public/admin/assets/images/avatar.png') }}" alt="">  
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-sm-12">
                            <div class="profile-personal-info">
                            
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Office Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $header_footer_single_data[0]->title }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Small Title<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $header_footer_single_data[0]->smalltitle }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">License Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $header_footer_single_data[0]->license }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Office Location<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $header_footer_single_data[0]->address }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Proprietor Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $header_footer_single_data[0]->proprietor }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Proprietor Title<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $header_footer_single_data[0]->proprietortitle }}</span>
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Telephone Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $header_footer_single_data[0]->telephone }}</span>
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Cellphone Number <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $header_footer_single_data[0]->cellphone }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Helpline Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $header_footer_single_data[0]->helpline }}</span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">E-Mail Address<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $header_footer_single_data[0]->email }}</span>
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Web Address<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $header_footer_single_data[0]->web }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Footer Title<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $header_footer_single_data[0]->footer_title }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Footer Content<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $header_footer_single_data[0]->content }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Footer Type<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $header_footer_single_data[0]->type }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Footer Menu<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $header_footer_single_data[0]->menu }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Contact Info<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $header_footer_single_data[0]->contact_info }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Footer Web Links<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $header_footer_single_data[0]->links }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Status<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>
                                        @if($header_footer_single_data[0]->status == 1)
                                            {{ __('Active') }}
                                            @elseif($header_footer_single_data[0]->status == 0)
                                            {{ __('Inactive') }}
                                        @endif
                                    </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Created At<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ date('d-M-Y', strtotime($header_footer_single_data[0]->created_at)) }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="mybtn">
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('super.setting.edit', ['id'=>$header_footer_single_data[0]->id]) }}">Update Info</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('super.setting') }}">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection