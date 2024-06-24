@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Delegate</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Delegate Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Details</a></li>
        </ol>
    </div>
</div>

<div class="row">
    {{-- Delegate Information --}}  
@include('admin.client.delegate.show_delegate_info')
    {{-- Customers Information --}}  
@include('admin.client.delegate.show_customer_info')

</div>
@endsection