@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer Once</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Create New Customer</h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
                <form action="{{ route('admin.customer.storeOnce') }}" class="form-group" method="POST" enctype="multipart/form-data">
                     @csrf
                    <div class="profile-personal-info">
                        <div class="row mb-2">
                            <div class="col-12">
                                <h4 class="f-w-500 text-center">Primary Information</h4>
                            </div>
                        </div>
                @php
                    $get_numbers = 1;
                @endphp

                @foreach($customer_data as $customer)
                    @php
                    $date = new DateTime();
                    $currentYear = $date->format('Y');
                    $customerSl = $customer['customersl'];
                    $customerSerial = $customerSl ? "RLCUS".$currentYear. str_pad(++$get_numbers, 5, '0', STR_PAD_LEFT) : "RLCUS".$currentYear."00001";
                    @endphp
                    <input type="hidden" name="customersl" value="{{ $customerSerial }}">
                @endforeach
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Customer Book Ref.<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="bookRef" class="form-control d-inline-block inline_setup" placeholder="Enter Customer Book Ref." value="{{ old('bookRef') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">First Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="cusFname" class="form-control d-inline-block inline_setup" placeholder="Enter First Name" value="{{ old('cusFname') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Last Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="cusLname" class="form-control d-inline-block inline_setup" placeholder="Enter Last Name" value="{{ old('cusLname') }}">
                            </div>
                        </div>
                        {{-- <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Gender<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <span class="form-check d-inline-block mr-2">
                                    <input type="radio" name="gender" value="1" {{ old('gender') == 1 ? 'checked' : '' }} class="form-check-input">Male
                                </span>
                                <span class="form-check d-inline-block mr-2">
                                    <input type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }} class="form-check-input">Female
                                </span>
                                <span class="form-check d-inline-block mr-2">
                                    <input type="radio" name="gender" value="3" {{ old('gender') == 3 ? 'checked' : '' }} class="form-check-input">Other
                                </span>
                            </div>
                        </div> --}}
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Gender<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                @foreach ($genders as $gender)
                                <span class="form-check d-inline-block mr-2">
                                    <input type="radio" name="gender" value="{{ $gender->value }}" {{ old('gender') == $gender->value ? 'checked' : '' }} class="form-check-input">{{ $gender->genderDes() }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Passport Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="passportNo" class="form-control d-inline-block inline_setup" placeholder="Enter Passport Number" value="{{ old('passportNo') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Customer Phone No.<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="phone" class="form-control d-inline-block inline_setup" placeholder="Enter Customer Phone No." value="{{ old('phone') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Delegate<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="remain-open" name="agentId" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Delegate</option>
                                @foreach($all_delegate as $delegate)
                                  <option value="{{ $delegate->id }}" {{ old('agentId') == $delegate->id ? 'selected' : '' }}>{{ $delegate->agentname .' - '. $delegate->agentsl }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Birth of Place<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="automatic-selection" name="birthPlace" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Birth of Place</option>
                                  @foreach($all_district as $district)
                                  <option value="{{ $district->id }}" {{ old('birthPlace') == $district->id ? 'selected' : '' }}>{{ $district->districtname }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Medical <span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="medical" name="medical" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Medical</option>
                                  <option value="1" {{ old('medical') == 1 ? 'selected' : '' }}>Done</option>
                                  <option value="2" {{ old('medical') == 2 ? 'selected' : '' }}>Fit</option>
                                  <option value="3" {{ old('medical') == 3 ? 'selected' : '' }}>Unfit</option>
                                  <option value="4" {{ old('medical') == 4 ? 'selected' : '' }}>N/A</option>
                                  <option value="5" {{ old('medical') == 5 ? 'selected' : '' }}>Problem</option>
                            </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Passport Receive Date<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="date" name="received" class="form-control d-inline-block inline_setup" value="{{ old('received') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Trade <span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="dynamic-option-creation" name="tradeId" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Trade</option>
                                  @foreach($all_visa_trade as $trade)
                                  <option value="{{ $trade->id }}" {{ old('tradeId') == $trade->id ? 'selected' : '' }}>{{ $trade->visatrade_name }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Destination Country<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="countryForWork" class="form-control d-inline-block inline_setup maximum-search-length" name="countryFor">
                                    <option selected="selected">Select Destination Country</option>
                                @foreach($all_country as $country)
                                  <option value="{{ $country->id }}" {{ old('countryFor') == $country->id ? 'selected' : '' }}>{{ $country->countryname }}</option>
                                @endforeach
                                </select>                        
                            </div>
                        </div>

                    </div>
                    <div class="profile-personal-info">
                        <div class="row mb-2">
                            <div class="col-12">
                                <h4 class="f-w-500 text-center">Documents Information</h4>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Police Clearance Certificate<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="pc" class="form-control d-inline-block inline_setup" placeholder="Enter Police Clearance Certificate Info" value="{{ old('pc') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">License<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="license" class="form-control d-inline-block inline_setup" placeholder="Enter Driving License" value="{{ old('license') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Training Certificate<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="tc" class="form-control d-inline-block inline_setup" placeholder="Enter Training Certificate Info" value="{{ old('tc') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Certificate<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="certificate" class="form-control d-inline-block inline_setup" placeholder="Enter Certificate Info" value="{{ old('certificate') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Musaned<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="musaned" class="form-control d-inline-block inline_setup" placeholder="Enter Musaned Info" value="{{ old('musaned') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Finger<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <input type="text" name="finger" class="form-control d-inline-block inline_setup" placeholder="Enter Finger Info" value="{{ old('finger') }}">
                            </div>
                        </div>
                    </div>
                    <div class="profile-personal-info">
                        <div class="row mb-2">
                            <div class="col-12">
                                <h4 class="f-w-500 text-center">Passport Information</h4>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Father Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="father" class="form-control d-inline-block inline_setup" placeholder="Enter Father Name" value="{{ old('father') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Mother Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="mother" class="form-control d-inline-block inline_setup" placeholder="Enter Mother Name" value="{{ old('mother') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Spouse Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="spouse" class="form-control d-inline-block inline_setup" placeholder="Enter Spouse Name" value="{{ old('spouse') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Passport Issue Date<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="date" name="passportIssue" class="form-control d-inline-block inline_setup" value="{{ old('passportIssue') }}" max="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Passport Type<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <span class="form-check d-inline-block mr-2">
                                    <input type="radio" name="passportType" value="5" {{ old('passportType') == 5 ? 'checked' : '' }} class="form-check-input">5 Years
                                </span>
                                <span class="form-check d-inline-block mr-2">
                                    <input type="radio" name="passportType" value="10" {{ old('passportType') == 10 ? 'checked' : '' }} class="form-check-input">10 Years
                                </span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">NID Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="nid" class="form-control d-inline-block inline_setup" placeholder="Enter NID Number" value="{{ old('nid') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Date of Birth<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="date" name="dateOfBirth" class="form-control d-inline-block inline_setup" value="{{ old('dateOfBirth') }}" max="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Marital Status<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <span class="form-check d-inline-block mr-2">
                                    <input type="radio" name="maritalStatus" value="1" {{ old('maritalStatus') == 1 ? 'checked' : '' }} class="form-check-input">Single
                                </span>
                                <span class="form-check d-inline-block mr-2">
                                    <input type="radio" name="maritalStatus" value="2" {{ old('maritalStatus') == 2 ? 'checked' : '' }} class="form-check-input">Married
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
                                    <option value="{{ $issue->id }}" {{ old('issuePlaceId') == $issue->id ? 'selected' : '' }}>{{ $issue->issuePlace }}</option>
                                @endforeach
                                </select>                        
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
                    </div>
                    <div class="profile-personal-info">
                        <div class="row mb-2">
                            <div class="col-12">
                                <h4 class="f-w-500 text-center">Embassy Information</h4>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Mofa Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="mofa" class="form-control d-inline-block inline_setup" placeholder="Enter Mofa Number" value="{{ old('mofa') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Customer Religion<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <span class="form-check d-inline-block mr-2">
                                    <input type="radio" name="religion" value="Islam" {{ old('religion') == "Islam" ? 'checked' : '' }} class="form-check-input">Muslim
                                </span>
                                <span class="form-check d-inline-block mr-2">
                                    <input type="radio" name="religion" value="Non Muslim" {{ old('religion') == "Non Muslim" ? 'checked' : '' }} class="form-check-input">Non Muslim
                                </span>
                            </div>
                        </div>
                        {{-- <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Customer Age<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="age" class="form-control d-inline-block inline_setup" placeholder="Enter Customer Age" value="{{ old('age') }}">
                            </div>
                        </div> --}}
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Visa Type<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="visatype" class="form-control d-inline-block inline_setup select2-width-50" name="visaTypeId">
                                    <option>Select Visa Type</option>
                                    @foreach($all_visa_type as $visa_type)
                                  <option value="{{ $visa_type->id }}" {{ old('visaTypeId') == $visa_type->id ? 'selected' : '' }}>{{ $visa_type->visatype_name }}</option>
                                @endforeach
                                </select>                        
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Visa No<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="visa" name="visaId" class="form-control d-inline-block inline_setup customize-result">
                                  <option selected="selected">Select Visa No</option>
                                @foreach($all_visa as $visa)
                                    @php
                                        $remainingVisa = isset($visaCounts[$visa->id]) ? $visa->delegated_visa - $visaCounts[$visa->id] : 0;
                                        $remainingVisaText = $remainingVisa >= 0 ? $remainingVisa : 0;
                                        $isDisabled = $remainingVisa <= 0 ? 'disabled' : '';
                                    @endphp
                                    <option value="{{ $visa->id }}" {{ old('visaId') == $visa->id ? 'selected' : '' }} {{ $isDisabled }}>
                                        {{ $visa->visano_en .' - ('. $remainingVisaText .')' .' - '. $visa->occupation_ar .' - '. $visa->occupation_en }}
                                    </option>
                                @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Embassy Submission Date<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="date" name="submissionDate" class="form-control d-inline-block inline_setup" value="{{ old('submissionDate') }}" min="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                    <div class="profile-personal-info">
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
                            <button type="submit" name="add" class="form-control inline_setup btn submitbtn text-uppercase">Add Customer</button>
                            <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.customer.insertOnce') }}">Back</a>
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
                $.get("{{ route('admin.customer.getDiv') }}", {country_id:countryId}, function(data){
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
                $.get("{{ route('admin.customer.getDist') }}", {division_id:divisionId, country_id:countryId}, function(data){
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
                $.get("{{ route('admin.customer.getPs') }}", {district_id:districtId, division_id:divisionId, country_id:countryId}, function(data){
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