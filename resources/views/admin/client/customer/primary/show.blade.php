@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Details</a></li>
        </ol>
    </div>
</div>

<div class="row">

{{-- Primary Information --}}  
@include('admin.client.customer.primary.show_primary')

{{-- Working Rate Information --}}
@include('admin.client.customer.primary.show_rate')

{{-- Documents Information --}}
@include('admin.client.customer.primary.show_documents')

{{-- Passport Information --}}
@include('admin.client.customer.primary.show_passport')

{{-- Embassy Information --}}
@include('admin.client.customer.primary.show_embassy')

{{-- Stamping Information --}}
@include('admin.client.customer.primary.show_stamping')

{{-- Stamping Information --}}
@include('admin.client.customer.primary.show_passport_copy')

</div>
@endsection