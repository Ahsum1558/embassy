@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Setting</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Header and Footer</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Create New Header and Footer Option Information</h4>
            </div>
            <div class="card-body">
@include('super.includes.alert')
                <form action="{{ route('super.setting.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                     @csrf
                    <div class="profile-personal-info">
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Office Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="select" name="field_id" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Office Option</option>
                                @foreach($field_data as $field)
                                  <option value="{{ $field->id }}" {{ old('field_id') == $field->id ? 'selected' : '' }}>{{ $field->title }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Footer Title<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="footer_title" class="form-control d-inline-block inline_setup" placeholder="Enter Footer Title" value="{{ old('footer_title') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Content<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="content" class="form-control d-inline-block inline_setup" placeholder="Enter Content" value="{{ old('content') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Type<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="type" class="form-control d-inline-block inline_setup" placeholder="Enter Type" value="{{ old('type') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Menu<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="menu" class="form-control d-inline-block inline_setup" placeholder="Enter Menu" value="{{ old('menu') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Contact Info<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="contact_info" class="form-control d-inline-block inline_setup" placeholder="Enter Contact Info" value="{{ old('contact_info') }}">
                            </div>
                        </div>
                        
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Web Links<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="links" class="form-control d-inline-block inline_setup" placeholder="Enter Web Links" value="{{ old('links') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Status <span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="select" name="status" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Type</option>
                                  <option value="1">Active</option>
                                  <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3"></div>
                        <div class="col-9 mybtn">
                            <button type="submit" name="addOption" class="form-control inline_setup btn submitbtn text-uppercase">Add</button>
                            <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('super.setting') }}">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection