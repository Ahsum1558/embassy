@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">User Licenses</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Extension</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Update Extension Info</h4>
            </div>
            <div class="card-body">
@include('super.includes.alert')
                <form action="{{ route('super.operator.updateExtension', ['id'=>$extension_info->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <!--Tab slider End-->
                    <div class="col">
                        <div class="product-detail-content">
                            <!--Product details-->
                            <div class="new-arrival-content pr">
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">User Expiry Date<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><input type="date" name="userExpiry" class="form-control d-inline-block inline_setup" value="{{ $extension_info->userExpiry }}" min="{{ date('Y-m-d') }}">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Amount<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><input type="text" name="trans_amount" class="form-control d-inline-block inline_setup" value="{{ $extension_info->trans_amount }}">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">User Type<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
    <select id="adminType" name="type" class="form-control d-inline-block inline_setup">
        <option value="">Select Type</option>
        <option value="approve" {{ old('type', $extension_info->type) == 'approve' ? 'selected' : '' }}>Approve</option>
        <option value="pending" {{ old('type', $extension_info->type) == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="disable" {{ old('type', $extension_info->type) == 'disable' ? 'selected' : '' }}>Disable</option>
    </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Status<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                    <select id="status" name="status" class="form-control d-inline-block inline_setup">
                                      <option>Select Status</option>
                            @if($extension_info->status == 1)
                                      <option selected="selected" value="1">Active</option>
                                      <option value="0">Inactive</option>
                              @elseif($extension_info->status == 0)
                                      <option selected="selected" value="0">Inactive</option>
                                      <option value="1">Active</option>
                              @endif
                                    </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3"></div>
                                    <div class="col-9 mybtn">
                                        <button type="submit" name="update" class="form-control inline_setup btn submitbtn text-uppercase">Update</button>
                                        <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('super.operator.show', ['id'=>$payment_info->id]) }}">Back</a>
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