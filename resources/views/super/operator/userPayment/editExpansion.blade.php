@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">User Licenses</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Expansion</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Update Expansion Info</h4>
            </div>
            <div class="card-body">
@include('super.includes.alert')
                <form action="{{ route('super.operator.updateExpansion', ['id'=>$expansion_data->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <!--Tab slider End-->
                    <div class="col">
                        <div class="product-detail-content">
                            <!--Product details-->
                            <div class="new-arrival-content pr">
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Payment Date<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><input type="date" name="trans_date" class="form-control d-inline-block inline_setup" value="{{ $expansion_data->trans_date }}" max="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Payment Data<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="payment_data" class="form-control d-inline-block inline_setup" value="{{ $expansion_data->payment_data }}"></span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Payment Type<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
            <select id="transType" name="trans_system" class="form-control d-inline-block inline_setup">
                <option value="">Select Payment Type</option>
                <option value="cash" {{ old('trans_system', $expansion_data->trans_system) == 'cash' ? 'selected' : '' }}>Cash</option>
                <option value="bank" {{ old('trans_system', $expansion_data->trans_system) == 'bank' ? 'selected' : '' }}>Bank</option>
                <option value="nagad" {{ old('trans_system', $expansion_data->trans_system) == 'nagad' ? 'selected' : '' }}>Nagad</option>
                <option value="bkash" {{ old('trans_system', $expansion_data->trans_system) == 'bkash' ? 'selected' : '' }}>Bkash</option>
                <option value="rocket" {{ old('trans_system', $expansion_data->trans_system) == 'rocket' ? 'selected' : '' }}>Rocket</option>
            </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3"></div>
                                    <div class="col-9 mybtn">
                                        <button type="submit" name="update" class="form-control inline_setup btn submitbtn text-uppercase">Update</button>
                                        <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('super.operator.show', ['id'=>$expansion_info->id]) }}">Back</a>
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