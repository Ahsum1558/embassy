@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customers</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Submission Info</a></li>
        </ol>
    </div>
</div>
@include('admin.includes.alert')
<div class="mybtn">
    <a href="{{ route('admin.submission.create') }}" class="btn submitbtn mb-2 form-control inline_setup text-uppercase">Add New Submission Date</a>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Submission Information</h4>
            </div>
            <div class="card-body">
        
                <div class="default-tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home"><i class="la la-home mr-2"></i>Embassy List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile"><i class="las la-list mr-2"></i>Customer Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#contact"><i class="las la-save mr-2"></i>Print</a>
                        </li>
                        
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="home" role="tabpanel">
                            <div class="pt-4 content_panel">
                                @include('admin.client.submission.embassy_list')
                            </div>
                        </div>

                        <div class="tab-pane fade" id="profile">
                            <div class="pt-4 content_panel">
                                @include('admin.client.submission.customer_list')
                            </div>
                        </div>

                        <div class="tab-pane fade" id="contact">
                            <div class="pt-4 content_panel">
                                @include('admin.client.submission.print_file')
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection