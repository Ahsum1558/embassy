@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">User Licenses</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Extension</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Extension Info</h4>
            </div>
            <div class="card-body">
@include('super.includes.alert')
                <form action="{{ route('super.operator.storeExtension', ['id'=>$users_payment->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <!--Tab slider End-->
                    <div class="col">
                        <div class="product-detail-content">
                            <!--Product details-->
                            <div class="new-arrival-content pr">
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Payment Type<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
            <select id="transType" name="trans_system" class="form-control d-inline-block inline_setup">
                <option value="">Select Payment Type</option>
                <option value="cash" {{ old('trans_system', $users_payment->trans_system) == 'cash' ? 'selected' : '' }}>Cash</option>
                <option value="bank" {{ old('trans_system', $users_payment->trans_system) == 'bank' ? 'selected' : '' }}>Bank</option>
                <option value="nagad" {{ old('trans_system', $users_payment->trans_system) == 'nagad' ? 'selected' : '' }}>Nagad</option>
                <option value="bkash" {{ old('trans_system', $users_payment->trans_system) == 'bkash' ? 'selected' : '' }}>Bkash</option>
                <option value="rocket" {{ old('trans_system', $users_payment->trans_system) == 'rocket' ? 'selected' : '' }}>Rocket</option>
            </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Payment Data<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="payment_data" class="form-control d-inline-block inline_setup" value="{{ $users_payment->payment_data }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Amount<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="trans_amount" class="form-control d-inline-block inline_setup" value="{{ $users_payment->trans_amount }}"></span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">User Type<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
    <select id="adminType" name="type" class="form-control d-inline-block inline_setup">
        <option value="">Select Type</option>
        <option value="approve" {{ old('type', $users_payment->type) == 'approve' ? 'selected' : '' }}>Approve</option>
        <option value="pending" {{ old('type', $users_payment->type) == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="disable" {{ old('type', $users_payment->type) == 'disable' ? 'selected' : '' }}>Disable</option>
    </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">User Level<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
    <select id="adminRole" name="role" class="form-control d-inline-block inline_setup">
        <option value="">Select Level</option>
        <option value="admin" {{ old('role', $users_payment->role) == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="author" {{ old('role', $users_payment->role) == 'author' ? 'selected' : '' }}>Author</option>
        <option value="editor" {{ old('role', $users_payment->role) == 'editor' ? 'selected' : '' }}>Editor</option>
        <option value="contributor" {{ old('role', $users_payment->role) == 'contributor' ? 'selected' : '' }}>Contributor</option>
        <option value="user" {{ old('role', $users_payment->role) == 'user' ? 'selected' : '' }}>User</option>
    </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Payment Date<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><input type="date" name="trans_date" class="form-control d-inline-block inline_setup" value="{{ $users_payment->trans_date }}" max="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">User Expiry Date<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><input type="date" name="userExpiry" class="form-control d-inline-block inline_setup" value="{{ $users_payment->userExpiry }}" min="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Status <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                    <select id="status" name="status" class="form-control d-inline-block inline_setup">
                                        <option value="">Select Status</option>
                                        <option value="active" {{ $users_payment->status === 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ $users_payment->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-3"></div>
                                    <div class="col-9 mybtn">
                                        <button type="submit" name="update" class="form-control inline_setup btn submitbtn text-uppercase">Extend</button>
                                        <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('super.operator.show', ['id'=>$users_payment->id]) }}">Back</a>
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