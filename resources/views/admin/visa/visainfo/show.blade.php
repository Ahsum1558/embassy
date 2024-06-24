@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Visa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Visa Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Details</a></li>
        </ol>
    </div>
</div>

<div class="row">

{{-- Visa Information --}}  
@include('admin.visa.visainfo.show_visa')

{{-- Customer Information --}}  
@include('admin.visa.visainfo.show_customer')

</div>
@endsection