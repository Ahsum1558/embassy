@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Site Option</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home Slider</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Details</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">Home Slider Details</h4>
            </div>
            <div class="card-body">
                <h4 class="mb-4 basic_headline">Home Slider Info</h4>
                <div class="profile-uoloaded-post border-bottom-1 pb-5">
                    <div class="row">
                        <div class="col-xl-12 col-sm-12 text-center m-auto">
                        <!-- Tab panes -->
                            <div class="tab-content m-3 shadow shadow-lg">
                                <div role="tabpanel" class="tab-pane p-3 fade show active" id="first">
                                    <img class="img-fluid img_slider" src="{{ (!empty($single_slider_data->slide_img)) ? url('public/admin/uploads/slider/'.$single_slider_data->slide_img) : url('public/admin/assets/images/avatar.png') }}" alt="">  
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="profile-personal-info">
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Slider Head Line<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_slider_data->slide_head }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Slider Description<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_slider_data->slide_des }}</span>
                                    </div>
                                </div>                                
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Image URL<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_slider_data->img_url }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Description URL<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_slider_data->des_url }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Status<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>
                                        @if($single_slider_data->status == 1)
                                            {{ __('Active') }}
                                            @elseif($single_slider_data->status == 0)
                                            {{ __('Inactive') }}
                                        @endif
                                    </span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Created At<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ date('d-M-Y', strtotime($single_slider_data->created_at)) }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="mybtn">
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('super.slider.edit', ['id'=>$single_slider_data->id]) }}">Update Info</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('super.slider.editSlider', ['id'=>$single_slider_data->id]) }}">Update Slider Image</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('super.slider') }}">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection