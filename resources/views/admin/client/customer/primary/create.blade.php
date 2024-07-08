@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer Info</a></li>
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
                <form action="{{ route('admin.customer.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                     @csrf
                    <div class="profile-personal-info">
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
                                <select id="select" name="agentId" class="form-control d-inline-block inline_setup disabling-options">
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
                                <select id="id_label_single" name="birthPlace" class="form-control d-inline-block inline_setup select2-with-label-single js-states">
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
                                <select id="single-select" name="tradeId" class="form-control d-inline-block inline_setup">
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
                                <select id="countryForWork" class="form-control d-inline-block inline_setup select2-width-50" name="countryFor">
                                    <option selected="selected">Select Destination Country</option>
                                @foreach($all_country as $country)
                                  <option value="{{ $country->id }}" {{ old('countryFor') == $country->id ? 'selected' : '' }}>{{ $country->countryname }}</option>
                                @endforeach
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
                            <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.customer') }}">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection