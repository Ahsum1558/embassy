@extends('admin.master')

@section('main-content')

<script src="{{ asset('public/admin/assets/js/jqueryUpdate.min.js') }}"></script>
<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Image</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Update Image of <strong>{{ $customer_image_data->cusFname .' '. $customer_image_data->cusLname }}</strong></h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
                <h4 class="mb-4 basic_headline">Update Customer Image</h4>
                <div class="settings-form">
                    <form action="{{ route('admin.customer.updateImage', ['id'=>$customer_image_data->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="profile-photo"> 
                                <img id="showImage" class="img-fluid img_user rounded-circle" src="{{ (!empty($customer_image_data->photo)) ? url('public/admin/uploads/customer/'.$customer_image_data->photo) : url('public/admin/assets/images/avatar.png') }}" alt="">  
                                <input id="imageUploading" type="file" name="new_photo" class="form-control">
                                <input id="imageUploading" type="hidden" name="old_photo" class="form-control" value="{{ $customer_image_data->photo }}">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-3"></div>
                            <div class="col-9 mybtn">
                                <button type="submit" name="updateImage" class="form-control inline_setup btn submitbtn text-uppercase">Update</button>
                                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.customer.show', ['id'=>$customer_image_data->id]) }}">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
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