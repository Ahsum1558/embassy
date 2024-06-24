@extends('admin.master')

@section('main-content')
<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Theme Option</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Theme Option</h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
                <form action="{{ route('admin.themeUpdate') }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <!--Tab slider End-->
                    <div class="col">
                        <div class="product-detail-content">
                            <!--Product details-->
                            <div class="new-arrival-content pr">
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Default<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input {{ $userData->theme === 'default' ? 'checked' : '' }} type="radio" name="theme" value="default"> Default</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Blue<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input {{ $userData->theme === 'blue' ? 'checked' : '' }} type="radio" name="theme" value="blue"> Blue</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Light Blue<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input {{ $userData->theme === 'blue_light' ? 'checked' : '' }} type="radio" name="theme" value="blue_light"> Light Blue</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Brown<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input {{ $userData->theme === 'brown' ? 'checked' : '' }} type="radio" name="theme" value="brown"> Brown</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Green<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input {{ $userData->theme === 'green' ? 'checked' : '' }} type="radio" name="theme" value="green"> Green</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Mint<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input {{ $userData->theme === 'mint' ? 'checked' : '' }} type="radio" name="theme" value="mint"> Mint</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Purple<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input {{ $userData->theme === 'purple' ? 'checked' : '' }} type="radio" name="theme" value="purple"> Purple</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Violet<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input {{ $userData->theme === 'violet' ? 'checked' : '' }} type="radio" name="theme" value="violet"> Violet</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Dark<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input {{ $userData->theme === 'dark' ? 'checked' : '' }} type="radio" name="theme" value="dark"> Dark</span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                <div class="col-3"></div>
                                <div class="col-9 mybtn">
                                    <button type="submit" name="updateTheme" class="form-control inline_setup btn submitbtn text-uppercase">Update Theme</button>
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
@endsection