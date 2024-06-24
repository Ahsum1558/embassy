@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Passport Info</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Update Passport Info of <strong>{{ $customer_info_edit->cusFname }} {{ $customer_info_edit->cusLname }}</strong></h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
@foreach ($passport_edit as $passport)
                <form action="{{ route('admin.customer.updatePassport', ['id'=>$passport->customerId]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <!--Tab slider End-->
                    <div class="col">
                        <div class="product-detail-content">
                            <!--Product details-->
                            <div class="new-arrival-content pr">
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Father Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="father" class="form-control d-inline-block inline_setup" value="{{ $passport->father }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Mother Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="mother" class="form-control d-inline-block inline_setup" value="{{ $passport->mother }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Spouse<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="spouse" class="form-control d-inline-block inline_setup" value="{{ $passport->spouse }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">NID<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="nid" class="form-control d-inline-block inline_setup" value="{{ $passport->nid }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Date Of Birth<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><input type="date" name="dateOfBirth" class="form-control d-inline-block inline_setup" value="{{ $passport->dateOfBirth }}" max="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Passport Issue Date<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><input type="date" name="passportIssue" class="form-control d-inline-block inline_setup" value="{{ $passport->passportIssue }}" max="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Passport Expiry Date<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><input type="date" name="passportExpiry" class="form-control d-inline-block inline_setup" value="{{ $passport->passportExpiry }}" min="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Passport Type<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                        <span class="form-check d-inline-block mr-2">
                                            <input type="radio" name="passportType" value="5" {{ $passport->passportType == 5 ? 'checked' : '' }} class="form-check-input">5 Years
                                        </span>
                                        <span class="form-check d-inline-block mr-2">
                                            <input type="radio" name="passportType" value="10" {{ $passport->passportType == 10 ? 'checked' : '' }} class="form-check-input">10 Years
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Marital Status<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                        <span class="form-check d-inline-block mr-2">
                                            <input type="radio" name="maritalStatus" value="1" {{ $passport->maritalStatus == 1 ? 'checked' : '' }} class="form-check-input">Single
                                        </span>
                                        <span class="form-check d-inline-block mr-2">
                                            <input type="radio" name="maritalStatus" value="2" {{ $passport->maritalStatus == 2 ? 'checked' : '' }} class="form-check-input">Married
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Place of Issue<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                        <select id="issueselect" class="form-control d-inline-block inline_setup select2-width-50" name="issuePlaceId">
                                            <option>Select Place of Issue</option>
                                        @foreach($all_issue as $issue)
                                            <option value="{{ $issue->id }}" {{ $passport->issuePlaceId == $issue->id ? 'selected' : '' }}>{{ $issue->issuePlace }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Address<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="address" class="form-control d-inline-block inline_setup" value="{{ $passport->address }}"></span>
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
                                            <option value="{{ $country->id }}" {{ $passport->countryId == $country->id ? 'selected' : '' }}>{{ $country->countryname }}</option>
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
                                            <option value="{{ $division->id }}" {{ $passport->divisionId == $division->id ? 'selected' : '' }}>{{ $division->divisionname }}</option>
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
                                            <option value="{{ $district->id }}" {{ $passport->districtId == $district->id ? 'selected' : '' }}>{{ $district->districtname }}</option>
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
                                            <option value="{{ $upzila->id }}" {{ $passport->policestationId == $upzila->id ? 'selected' : '' }}>{{ $upzila->policestationname }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3"></div>
                                    <div class="col-9 mybtn">
                                        <button type="submit" name="update" class="form-control inline_setup btn submitbtn text-uppercase">Update</button>
                                        <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.customer.show', ['id'=>$customer_info_edit->id]) }}">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
@endforeach
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
                $.get("{{ route('admin.customer.getDivision') }}", {country_id:countryId}, function(data){
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
                $.get("{{ route('admin.customer.getDistrict') }}", {division_id:divisionId, country_id:countryId}, function(data){
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
                $.get("{{ route('admin.customer.getUpzila') }}", {district_id:districtId, division_id:divisionId, country_id:countryId}, function(data){
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