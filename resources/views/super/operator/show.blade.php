@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">User Licenses</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">License Details</a></li>
        </ol>
    </div>
</div>

<div class="row">
    {{-- User Information --}}  
@include('super.operator.show_user_info')
    {{-- License Information in English --}}  
@include('super.operator.show_license_info')
    {{-- License Information in Bengali --}}  
@include('super.operator.show_licensebn_info')
{{-- License Information in Arabic --}}  
@include('super.operator.show_licensear_info')
{{-- License Approval Information --}}  
@include('super.operator.show_approval_info')
{{-- License Payment Information --}}  
@include('super.operator.show_payment_info')

</div>


@endsection