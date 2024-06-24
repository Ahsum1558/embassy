@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Delegate</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Delegate Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Create New Delegate</h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
                <form action="{{ route('admin.delegate.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                     @csrf
                    <div class="profile-personal-info">
                @php
                    $get_numbers = 1;
                @endphp

                @foreach($delegate_data as $delegate)
                    @php
                        $mreceipt = $delegate['agentsl'];
                        $agentSerial = $mreceipt ? "AG" . str_pad(++$get_numbers, 5, '0', STR_PAD_LEFT) : "AG00001";
                    @endphp

                    <input type="hidden" name="agentsl" value="{{ $agentSerial }}">
                @endforeach

                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Delegate Book Ref.<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="agentbook" class="form-control d-inline-block inline_setup" placeholder="Enter Delegate Book Ref." value="{{ old('agentbook') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Delegate Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="agentname" class="form-control d-inline-block inline_setup" placeholder="Enter Delegate Name" value="{{ old('agentname') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Delegate Referance Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="father" class="form-control d-inline-block inline_setup" placeholder="Enter Delegate Referance Name" value="{{ old('father') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Delegate NID No.<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="nid" class="form-control d-inline-block inline_setup" placeholder="Enter Delegate NID No." value="{{ old('nid') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Delegate Office Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="office" class="form-control d-inline-block inline_setup" placeholder="Enter Delegate Office Name" value="{{ old('office') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Delegate Office Address<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="officeLocation" class="form-control d-inline-block inline_setup" placeholder="Enter Delegate Office Address" value="{{ old('officeLocation') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Delegate Phone No.<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="phone" class="form-control d-inline-block inline_setup" placeholder="Enter Delegate Phone No." value="{{ old('phone') }}">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Delegate E-Mail Address<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="email" class="form-control d-inline-block inline_setup" placeholder="Enter Delegate E-Mail Address" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Delegate Date Of Birth<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="date" name="dateOfBirth" class="form-control d-inline-block inline_setup" value="{{ old('dateOfBirth') }}" max="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Gender <span class="pull-right">:</span></h5>
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
                                <h5 class="f-w-500">Account No. <span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="accountNo" class="form-control d-inline-block inline_setup" placeholder="Enter Account No." value="{{ old('accountNo') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Bank Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="bankname" class="form-control d-inline-block inline_setup" placeholder="Enter Bank Name" value="{{ old('bankname') }}">
                            </div>
                        </div>
                         <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Branch Location<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="bankbranch" class="form-control d-inline-block inline_setup" placeholder="Enter Bank Branch Location" value="{{ old('bankbranch') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Address<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="address" class="form-control d-inline-block inline_setup" placeholder="Enter Address" value="{{ old('address') }}">
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
                                <h5 class="f-w-500">Division <span class="pull-right">:</span></h5>
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
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Description<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="description" class="form-control d-inline-block inline_setup" placeholder="Enter Description" value="{{ old('description') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Status <span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="status" name="status" class="form-control d-inline-block inline_setup">
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
                            <button type="submit" name="add" class="form-control inline_setup btn submitbtn text-uppercase">Add</button>
                            <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.delegate') }}">Back</a>
                        </div>
                    </div>
                </form>
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
                $.get("{{ route('admin.delegate.get') }}", {country_id:countryId}, function(data){
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
                $.get("{{ route('admin.delegate.getDistrict') }}", {division_id:divisionId, country_id:countryId}, function(data){
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
                $.get("{{ route('admin.delegate.getCity') }}", {district_id:districtId, division_id:divisionId, country_id:countryId}, function(data){
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
                $.get("{{ route('admin.delegate.getUpzila') }}", {district_id:districtId, division_id:divisionId, country_id:countryId}, function(data){
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