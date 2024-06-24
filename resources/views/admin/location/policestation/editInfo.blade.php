@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Location</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Police Station</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Info</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Update Info of {{ $upzila_data_info[0]->policestationname }}</h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
                <form action="{{ route('admin.policestation.updateInfo', ['id'=>$upzila_data_info[0]->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <!--Tab slider End-->
                    <div class="col">
                        <div class="product-detail-content">
                            <!--Product details-->
                            <div class="new-arrival-content pr">

                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Country Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                    <select id="select" name="countryId" class="form-control d-inline-block inline_setup disabling-options">
                                      <option>Select Country</option>
                                    @foreach($all_country as $country)
                                      <option value="{{ $country->id }}" {{ $upzila_data_info[0]->countryId == $country->id ? 'selected' : '' }}>{{ $country->countryname }}</option>
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
                                      <option value="{{ $division->id }}" {{ $upzila_data_info[0]->divisionId == $division->id ? 'selected' : '' }}>{{ $division->divisionname }}</option>
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
                                      <option value="{{ $district->id }}" {{ $upzila_data_info[0]->districtId == $district->id ? 'selected' : '' }}>{{ $district->districtname }}</option>
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
                                          <option>Select Type</option>
                                @if($upzila_data_info[0]->status == 1)
                                          <option selected="selected" value="1">Active</option>
                                          <option value="0">Inactive</option>
                                  @elseif($upzila_data_info[0]->status == 0)
                                          <option selected="selected" value="0">Inactive</option>
                                          <option value="1">Active</option>
                                  @endif
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-3"></div>
                                    <div class="col-9 mybtn">
                                        <button type="submit" name="updateInfo" class="form-control inline_setup btn submitbtn text-uppercase">Update</button>
                                        <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.policestation.show', ['id'=>$upzila_data_info[0]->id]) }}">Back</a>
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
@include('admin.includes.loader')
<style>#overlay .loader{display: none;} </style>
<script>
    $(document).ready(function(){
        $('#select').change(function() {
            var countryId = $(this).val();
            if(countryId){
                $('#overlay .loader').show();
                $.get("{{ route('admin.policestation.get') }}", {country_id:countryId}, function(data){
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
                $.get("{{ route('admin.policestation.getDistrict') }}", {division_id:divisionId, country_id:countryId}, function(data){
                    $('#overlay .loader').hide();
                    console.log(data);
                    $('#id_label_single').empty().html(data);
                });
            }else{
                $('#id_label_single').empty().html('<option value="">Select District</option>');
            }
        });

    });
</script>
@endsection