@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">User Licenses</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Create New User License</h4>
            </div>
            <div class="card-body">
@include('super.includes.alert')
                <form action="{{ route('super.operator.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="profile-personal-info">
                        <div class="row mb-2">
                            <div class="col-12">
                                <h4 class="f-w-500 text-center">User Information</h4>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Username<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="username" class="form-control d-inline-block inline_setup" placeholder="Enter Username" value="{{ old('username') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Full Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="name" class="form-control d-inline-block inline_setup" placeholder="Enter Full Name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Date Of Birth<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="date" name="dateOfBirth" class="form-control d-inline-block inline_setup" value="{{ old('dateOfBirth') }}" max="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Designation<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="designation" class="form-control d-inline-block inline_setup" placeholder="Enter Designation" value="{{ old('designation') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Gender<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="gender" name="gender" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Gender</option>
                                  <option selected="selected">Select Gender</option>
                                  <option value="1" {{ old('gender') == 1 ? 'selected' : '' }}>Male</option>
                                  <option value="2" {{ old('gender') == 2 ? 'selected' : '' }}>Female</option>
                                  <option value="3" {{ old('gender') == 3 ? 'selected' : '' }}>Other</option>
                            </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Password<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="password" class="form-control d-inline-block inline_setup" placeholder="Enter Password" value="{{ old('password') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Confirm Password<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="password_confirmation" class="form-control d-inline-block inline_setup" placeholder="Enter Confirm Password" value="{{ old('password_confirmation') }}">
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
                                <h5 class="f-w-500">Office Name in English<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="title" class="form-control d-inline-block inline_setup" placeholder="Enter Office Name in English" value="{{ old('title') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Short Name of Office<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="smalltitle" class="form-control d-inline-block inline_setup" placeholder="Enter Short of Office" value="{{ old('smalltitle') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">License Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="license" class="form-control d-inline-block inline_setup" placeholder="Enter License Number" value="{{ old('license') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">License Expiry Date<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="date" name="licenseExpiry" class="form-control d-inline-block inline_setup" value="{{ old('licenseExpiry') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Description in English<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="description" class="form-control d-inline-block inline_setup" placeholder="Enter Description in English" value="{{ old('description') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Proprietor Name in English<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="proprietor" class="form-control d-inline-block inline_setup" placeholder="Enter Proprietor Name in English" value="{{ old('proprietor') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Proprietor Title in English<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="proprietortitle" class="form-control d-inline-block inline_setup" placeholder="Enter Proprietor Title in English" value="{{ old('proprietortitle') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">E-Mail Address<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="email" class="form-control d-inline-block inline_setup" placeholder="Enter E-Mail Address" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Contact Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="phone" class="form-control d-inline-block inline_setup" placeholder="Enter Contact Number" value="{{ old('phone') }}">
                            </div>
                        </div>
                    </div>
                    <div class="profile-personal-info">
                        <div class="row mb-2">
                            <div class="col-12">
                                <h4 class="f-w-500 text-center">বাংলায় নতুন অফিসের তথ্য যুক্ত করুন</h4>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">office Name in Bengali<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="title_bn" class="form-control d-inline-block inline_setup" placeholder="Enter office Name in Bengali" value="{{ old('title_bn') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">License Number in Bengali<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="license_bn" class="form-control d-inline-block inline_setup" placeholder="Enter License Number in Bengali" value="{{ old('license_bn') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Description in Bengali<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="description_bn" class="form-control d-inline-block inline_setup" placeholder="Enter Description in Bengali" value="{{ old('description_bn') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Office Full Address in Bengali<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="address_bn" class="form-control d-inline-block inline_setup" placeholder="Enter Office Full Address in Bengali" value="{{ old('address_bn') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Proprietor Name in Bengali<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="proprietor_bn" class="form-control d-inline-block inline_setup" placeholder="Enter Proprietor Name in Bengali" value="{{ old('proprietor_bn') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Proprietor Title in Bengali<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="proprietortitle_bn" class="form-control d-inline-block inline_setup" placeholder="Enter Proprietor Title in Bengali" value="{{ old('proprietortitle_bn') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Contact Number in Bengali<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="telephone_bn" class="form-control d-inline-block inline_setup" placeholder="Enter Contact Number in Bengali" value="{{ old('telephone_bn') }}">
                            </div>
                        </div>
                    </div>
                    <div class="profile-personal-info">
                        <div class="row mb-2">
                            <div class="col-12">
                                <h4 class="f-w-500 text-center">إضافة مكتب جديد باللغة العربية</h4>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Office Name in Arabic<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="title_ar" class="form-control d-inline-block inline_setup" placeholder="Enter Office Name in Arabic" value="{{ old('title_ar') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">License Number in Arabic<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="license_ar" class="form-control d-inline-block inline_setup" placeholder="Enter License Number in Arabic" value="{{ old('license_ar') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Description in Arabic<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="description_ar" class="form-control d-inline-block inline_setup" placeholder="Enter Description in Arabic" value="{{ old('description_ar') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Office Full Address in Arabic<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="address_ar" class="form-control d-inline-block inline_setup" placeholder="Enter Office Full Address in Arabic" value="{{ old('address_ar') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Proprietor Name in Arabic<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="proprietor_ar" class="form-control d-inline-block inline_setup" placeholder="Enter Proprietor Name in Arabic" value="{{ old('proprietor_ar') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Proprietor Title in Arabic<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="proprietortitle_ar" class="form-control d-inline-block inline_setup" placeholder="Enter Proprietor Title in Arabic" value="{{ old('proprietortitle_ar') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Contact Number in Arabic<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="telephone_ar" class="form-control d-inline-block inline_setup" placeholder="Enter Contact Number in Arabic" value="{{ old('telephone_ar') }}">
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
                                <h5 class="f-w-500">Office Address<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="address" class="form-control d-inline-block inline_setup" placeholder="Enter Office Address" value="{{ old('address') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Country Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="select" name="countryId" class="form-control d-inline-block inline_setup disabling-options">
                                  <option selected="selected">Select Country</option>
                                @foreach($all_country as $country)
                                  <option value="{{ $country->id }}" {{ old('countryId') == $country->id ? 'selected' : '' }}>{{ $country->countryname }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Division<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="single-select" name="divisionId" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Division</option>
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
                                </select>                        
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Zipcode<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="zipcode" class="form-control d-inline-block inline_setup" placeholder="Enter Zipcode" value="{{ old('zipcode') }}">
                            </div>
                        </div>
                    </div>
                    <div class="profile-personal-info">
                        <div class="row mb-2">
                            <div class="col-12">
                                <h4 class="f-w-500 text-center">Office Approval Information</h4>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Payment Reference Info<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="payment_data" class="form-control d-inline-block inline_setup" placeholder="Enter Payment Reference Info" value="{{ old('payment_data') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">User Expiry Date<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="date" name="userExpiry" class="form-control d-inline-block inline_setup" value="{{ old('userExpiry') }}" min="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">User Type<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="types" name="type" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Type</option>
                                  <option value="approve" {{ old('type') == 'approve' ? 'selected' : '' }}>Approve</option>
                                  <option value="pending" {{ old('type') == 'pending' ? 'selected' : '' }}>Pending</option>
                                  <option value="disable" {{ old('type') == 'disable' ? 'selected' : '' }}>Disable</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Status <span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="status" name="status" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Type</option>
                                  <option value="active">Active</option>
                                  <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>  
                    </div>
                    <div class="row mb-2">
                        <div class="col-3"></div>
                        <div class="col-9 mybtn">
                            <button type="submit" name="addUser" class="form-control inline_setup btn submitbtn text-uppercase">Add</button>
                            <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('super.operator') }}">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('super.includes.loader')
<style>#overlay .loader{display: none;} </style>
<script>
    $(document).ready(function(){
        $('#select').change(function() {
            var countryId = $(this).val();
            if(countryId){
                $('#overlay .loader').show();
                $.get("{{ route('super.operator.get') }}", {country_id:countryId}, function(data){
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
                $.get("{{ route('super.operator.getDistrict') }}", {division_id:divisionId, country_id:countryId}, function(data){
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
                $.get("{{ route('super.operator.getCity') }}", {district_id:districtId, division_id:divisionId, country_id:countryId}, function(data){
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
                $.get("{{ route('super.operator.getUpzila') }}", {district_id:districtId, division_id:divisionId, country_id:countryId}, function(data){
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