@extends('super.home')

@section('super-content')

<script src="{{ asset('public/admin/assets/js/jqueryUpdate.min.js') }}"></script>

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Site Option</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home Slider</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Slider Image</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Update Slider Image Info</h4>
            </div>
            <div class="card-body">
@include('super.includes.alert')
                <form action="{{ route('super.slider.updateSlider', ['id'=>$image_slider->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <!--Tab slider End-->
                    <div class="col">
                        <div class="product-detail-content">
                            <!--Product details-->
                            <div class="new-arrival-content pr">

                                <div class="form-group">
                                    <div class="profile-photo"> 
                                        <img id="showImage" class="img-fluid img_user rounded-circle" src="{{ (!empty($image_slider->slide_img)) ? url('public/admin/uploads/slider/'.$image_slider->slide_img) : url('public/admin/assets/images/avatar.png') }}" alt="">  
                                        <input id="imageUploading" type="file" name="new_photo" class="form-control">
                                        <input id="imageUploading" type="hidden" name="old_photo" class="form-control" value="{{ $image_slider->slide_img }}">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3"></div>
                                    <div class="col-9 mybtn">
                                        <button type="submit" name="updateLogo" class="form-control inline_setup btn submitbtn text-uppercase">Update</button>
                                        <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('super.slider.show', ['id'=>$image_slider->id]) }}">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#imageUploading").change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection