@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Licenses</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update License</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Update License Info in Arabic</h4>
            </div>
            <div class="card-body">
@include('super.includes.alert')
                <form action="{{ route('super.operator.updateAr', ['id'=>$data_ar->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <!--Tab slider End-->
                    <div class="col">
                        <div class="product-detail-content">
                            <div class="profile-personal-info">
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <h4 class="f-w-500 text-center">معلومات المكتب باللغة العربية</h4>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Description in Arabic<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="description_ar" class="form-control d-inline-block inline_setup" value="{{ $data_ar->description_ar }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Office Full Address in Arabic<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="address_ar" class="form-control d-inline-block inline_setup" value="{{ $data_ar->address_ar }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Proprietor Name in Arabic<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="proprietor_ar" class="form-control d-inline-block inline_setup" value="{{ $data_ar->proprietor_ar }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Proprietor Title in Arabic<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="proprietortitle_ar" class="form-control d-inline-block inline_setup" value="{{ $data_ar->proprietortitle_ar }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Contact Number in Arabic<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="telephone_ar" class="form-control d-inline-block inline_setup" value="{{ $data_ar->telephone_ar }}"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-3"></div>
                                <div class="col-9 mybtn">
                                    <button type="submit" name="updateOperator" class="form-control inline_setup btn submitbtn text-uppercase">Update</button>
                                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('super.operator.show', ['id'=>$data_ar->id]) }}">Back</a>
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
@endsection