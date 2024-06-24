@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4><strong>{{ Auth::user()->name }}</strong> welcome back!</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Profile</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">Company Information Create</h4>
            </div>
            <div class="card-body">
                @include('admin.includes.alert')
                <h4 class="mb-4 basic_headline">Create Info</h4>
                <div class="profile-uoloaded-post border-bottom-1 pb-5">
                    <form action="{{ route('admin.profile.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-personal-info">
                            <div class="row mb-2">
                                <div class="col-12">
                                    <h4 class="f-w-500 text-center">User Information</h4>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Date Of Birth <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><input type="date" name="dateOfBirth" class="form-control d-inline-block inline_setup" value="{{ $user_info->dateOfBirth }}" max="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Gender<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9">
                                <select id="gender" name="gender" class="form-control d-inline-block inline_setup">
                                  <option>Select Gender</option>
                        @if($user_info->gender == 1)
                                  <option selected="selected" value="1">Male</option>
                                  <option value="2">Female</option>
                                  <option value="3">Other</option>
                          @elseif($user_info->gender == 2)
                                  <option selected="selected" value="2">Female</option>
                                  <option value="1">Male</option>
                                  <option value="3">Other</option>
                           @else
                                  <option selected="selected" value="3">Other</option>
                                  <option value="1">Male</option>
                                  <option value="2">Female</option>
                          @endif
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="profile-personal-info">
                            <div class="row mb-2">
                                <div class="col-12">
                                    <h4 class="f-w-500 text-center">License Information in English</h4>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Company Name in English<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span><input type="text" name="title" class="form-control d-inline-block inline_setup" value="{{ $user_info->title }}"></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Short Name Company in English<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span><input type="text" name="smalltitle" class="form-control d-inline-block inline_setup" value="{{ $user_info->smalltitle }}"></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">License Number in English<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span><input type="text" name="license" class="form-control d-inline-block inline_setup" value="{{ $user_info->license }}"></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Description in English<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span><input type="text" name="description" class="form-control d-inline-block inline_setup" value="{{ $user_info->description }}"></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">License Expiry Date<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><input type="date" name="licenseExpiry" class="form-control d-inline-block inline_setup" value="{{ $user_info->licenseExpiry }}">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Owner Name in English<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span><input type="text" name="proprietor" class="form-control d-inline-block inline_setup" value="{{ $user_info->proprietor }}"></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Owner Title in English<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span><input type="text" name="proprietortitle" class="form-control d-inline-block inline_setup" value="{{ $user_info->proprietortitle }}"></span>
                                </div>
                            </div>
                        </div>
                        <div class="profile-personal-info">
                            <div class="row mb-2">
                                <div class="col-12">
                                    <h4 class="f-w-500 text-center">বাংলায় অফিসের তথ্য</h4>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Company Name in Bengali<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span><input type="text" name="title_bn" class="form-control d-inline-block inline_setup" value="{{ $user_info->title_bn }}"></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">License Number in Bengali<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span><input type="text" name="license_bn" class="form-control d-inline-block inline_setup" value="{{ $user_info->license_bn }}"></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Description in Bengali<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span><input type="text" name="description_bn" class="form-control d-inline-block inline_setup" value="{{ $user_info->description_bn }}"></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Office Full Address in Bengali<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span><input type="text" name="address_bn" class="form-control d-inline-block inline_setup" value="{{ $user_info->address_bn }}"></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Owner Name in Bengali<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span><input type="text" name="proprietor_bn" class="form-control d-inline-block inline_setup" value="{{ $user_info->proprietor_bn }}"></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Owner Title in Bengali<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span><input type="text" name="proprietortitle_bn" class="form-control d-inline-block inline_setup" value="{{ $user_info->proprietortitle_bn }}"></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Contact Number in Bengali<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span><input type="text" name="telephone_bn" class="form-control d-inline-block inline_setup" value="{{ $user_info->telephone_bn }}"></span>
                                </div>
                            </div>
                        </div>
                        <div class="profile-personal-info">
                            <div class="row mb-2">
                                <div class="col-12">
                                    <h4 class="f-w-500 text-center">معلومات المكتب باللغة العربية</h4>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Company Name in Arabic<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span><input type="text" name="title_ar" class="form-control d-inline-block inline_setup" value="{{ $user_info->title_ar }}"></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">License Number in Arabic<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span><input type="text" name="license_ar" class="form-control d-inline-block inline_setup" value="{{ $user_info->license_ar }}"></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Description in Arabic<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span><input type="text" name="description_ar" class="form-control d-inline-block inline_setup" value="{{ $user_info->description_ar }}"></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Office Full Address in Arabic<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span><input type="text" name="address_ar" class="form-control d-inline-block inline_setup" value="{{ $user_info->address_ar }}"></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Owner Name in Arabic<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span><input type="text" name="proprietor_ar" class="form-control d-inline-block inline_setup" value="{{ $user_info->proprietor_ar }}"></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Owner Title in Arabic<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span><input type="text" name="proprietortitle_ar" class="form-control d-inline-block inline_setup" value="{{ $user_info->proprietortitle_ar }}"></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Contact Number in Arabic<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span><input type="text" name="telephone_ar" class="form-control d-inline-block inline_setup" value="{{ $user_info->telephone_ar }}"></span>
                                </div>
                            </div>
                        </div>
                        <div class="profile-personal-info">
                            <div class="row mb-2">
                                <div class="col-12">
                                    <h4 class="f-w-500 text-center">Office Location Information</h4>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Office Location<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span><input type="text" name="address" class="form-control d-inline-block inline_setup" value="{{ $user_info->address }}"></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Zipcode <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><input type="text" name="zipcode" class="form-control d-inline-block inline_setup" value="{{ $user_info->zipcode }}">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Country Name<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9">
                                <select id="select" name="countryId" class="form-control d-inline-block inline_setup disabling-options">
                                  <option>Select Country</option>
                                @foreach($all_country as $country)
                                  <option value="{{ $country->id }}" {{ $user_info->countryId == $country->id ? 'selected' : '' }}>{{ $country->countryname }}</option>
                                @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Division Name<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9">
                                    <select id="single-select" name="divisionId" class="form-control d-inline-block inline_setup">
                                      <option selected="selected">Select Division</option>

                                @foreach($all_division as $division)
                                  <option value="{{ $division->id }}" {{ $user_info->divisionId == $division->id ? 'selected' : '' }}>{{ $division->divisionname }}</option>
                                @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">District<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9">
                                    <select id="id_label_single" name="districtId" class="form-control d-inline-block inline_setup select2-with-label-single js-states">
                                      <option selected="selected">Select District</option>
                                @foreach($all_district as $district)
                                  <option value="{{ $district->id }}" {{ $user_info->districtId == $district->id ? 'selected' : '' }}>{{ $district->districtname }}</option>
                                @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">City<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9">
                                    <select id="cityselect" class="form-control d-inline-block inline_setup select2-width-50" name="cityId">
                                        <option>Select City</option>
                                @foreach($all_city as $city)
                                    <option value="{{ $city->id }}" {{ $user_info->cityId == $city->id ? 'selected' : '' }}>{{ $city->cityname }}</option>
                                @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Police Station<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9">
                                    <select id="upzilaselect" class="form-control d-inline-block inline_setup default-placeholder" name="policestationId">
                                        <option>Select Police Station</option>
                                @foreach($all_upzila as $upzila)
                                    <option value="{{ $upzila->id }}" {{ $user_info->policestationId == $upzila->id ? 'selected' : '' }}>{{ $upzila->policestationname }}</option>
                                @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-3"></div>
                            <div class="col-9 mybtn">
                                <button type="submit" name="updateInfo" class="form-control inline_setup btn submitbtn text-uppercase">Create</button>
                                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.profile') }}">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.includes.loader')
<style>#overlay .loader{display: none;} </style>
<script>
    $(document).ready(function(){
        $('#select').change(function() {
            var countryId = $(this).val();
            if(countryId){
                $('#overlay .loader').show();
                $.get("{{ route('admin.profile.get') }}", {country_id:countryId}, function(data){
                    $('#overlay .loader').hide();
                    console.log(data);
                    $('#single-select').empty().html(data);
                });
            }else{
                $('#single-select').empty().html('<option value="">Select Division</option>');
            }
        });

        $('#single-select').change(function() {
            var divisionId = $(this).val();
            var countryId = $('#select').val();
            if(divisionId && countryId){
                $('#overlay .loader').show();
                $.get("{{ route('admin.profile.getDistrict') }}", {division_id:divisionId, country_id:countryId}, function(data){
                    $('#overlay .loader').hide();
                    console.log(data);
                    $('#id_label_single').empty().html(data);
                });
            }else{
                $('#id_label_single').empty().html('<option value="">Select District</option>');
            }
        });

        $('#id_label_single').change(function() {
            var districtId = $(this).val();
            var divisionId = $('#single-select').val();
            var countryId = $('#select').val();
            if(districtId && divisionId && countryId){
                $('#overlay .loader').show();
                $.get("{{ route('admin.profile.getCity') }}", {district_id:districtId, division_id:divisionId, country_id:countryId}, function(data){
                    $('#overlay .loader').hide();
                    console.log(data);
                    $('#cityselect').empty().html(data);
                });
            }else{
                $('#cityselect').empty().html('<option value="">Select City</option>');
            }
        });

        $('#id_label_single').change(function() {
            var districtId = $(this).val();
            var divisionId = $('#single-select').val();
            var countryId = $('#select').val();
            if(districtId && divisionId && countryId){
                $('#overlay .loader').show();
                $.get("{{ route('admin.profile.getUpzila') }}", {district_id:districtId, division_id:divisionId, country_id:countryId}, function(data){
                    $('#overlay .loader').hide();
                    console.log(data);
                    $('#upzilaselect').empty().html(data);
                });
            }else{
                $('#upzilaselect').empty().html('<option value="">Select Police Station</option>');
            }
        });

    });
</script>
@endsection