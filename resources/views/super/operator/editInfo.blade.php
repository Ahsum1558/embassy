@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Licenses Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update License Info</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Update User License Info</h4>
            </div>
            <div class="card-body">
@include('super.includes.alert')
                <form action="{{ route('super.operator.updateInfo', ['id'=>$data_info->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <!--Tab slider End-->
                    <div class="col">
                        <div class="product-detail-content">
                            <!--Product details-->
                            <div class="profile-personal-info">
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <h4 class="f-w-500 text-center">User Information</h4>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Full Name of User<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><input type="text" name="name" class="form-control d-inline-block inline_setup" value="{{ $data_info->name }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Designation of User<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><input type="text" name="designation" class="form-control d-inline-block inline_setup" value="{{ $data_info->designation }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Date Of Birth <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><input type="date" name="dateOfBirth" class="form-control d-inline-block inline_setup" value="{{ $data_info->dateOfBirth }}" max="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Gender<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                    <select id="gender" name="gender" class="form-control d-inline-block inline_setup">
                                      <option>Select Gender</option>
                            @if($data_info->gender == 1)
                                      <option selected="selected" value="1">Male</option>
                                      <option value="2">Female</option>
                                      <option value="3">Other</option>
                              @elseif($data_info->gender == 2)
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
                                        <h4 class="f-w-500 text-center">Office Location Information</h4>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Office Location<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="address" class="form-control d-inline-block inline_setup" value="{{ $data_info->address }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Zipcode <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><input type="text" name="zipcode" class="form-control d-inline-block inline_setup" value="{{ $data_info->zipcode }}">
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
                                      <option value="{{ $country->id }}" {{ $data_info->countryId == $country->id ? 'selected' : '' }}>{{ $country->countryname }}</option>
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
                                      <option value="{{ $division->id }}" {{ $data_info->divisionId == $division->id ? 'selected' : '' }}>{{ $division->divisionname }}</option>
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
                                      <option value="{{ $district->id }}" {{ $data_info->districtId == $district->id ? 'selected' : '' }}>{{ $district->districtname }}</option>
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
                                        <option value="{{ $city->id }}" {{ $data_info->cityId == $city->id ? 'selected' : '' }}>{{ $city->cityname }}</option>
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
                                        <option value="{{ $upzila->id }}" {{ $data_info->policestationId == $upzila->id ? 'selected' : '' }}>{{ $upzila->policestationname }}</option>
                                    @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3"></div>
                                <div class="col-9 mybtn">
                                    <button type="submit" name="updateOperator" class="form-control inline_setup btn submitbtn text-uppercase">Update</button>
                                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('super.operator.show', ['id'=>$data_info->id]) }}">Back</a>
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