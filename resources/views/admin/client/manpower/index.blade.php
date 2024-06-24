@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customers</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Manpower Info</a></li>
        </ol>
    </div>
</div>
@include('admin.includes.alert')
<div class="mybtn">
    <a href="{{ route('admin.manpower.create') }}" class="btn submitbtn mb-2 form-control inline_setup text-uppercase">Add New Manpower Date</a>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Manpower Information</h4>
            </div>
            <div class="card-body">
        
                <div class="default-tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home"><i class="la la-home mr-2"></i>Manpower Date</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#message"><i class="la la-pencil-square-o mr-2"></i>BMET Payment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#othertab"><i class="la la-laptop mr-2"></i>Customer in Embassy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile"><i class="las la-list mr-2"></i>Customer in Manpower</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#contact"><i class="las la-save mr-2"></i>Print</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#wordFile"><i class="las la-file-word mr-2" aria-hidden="true"></i>Word File</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#oldManpower"><i class="la la-sticky-note mr-2"></i>Old Manpower</a>
                        </li>
                        
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="home" role="tabpanel">
                            <div class="pt-4 content_panel">
                                @include('admin.client.manpower.manpower_list')
                            </div>
                        </div>

                        <div class="tab-pane fade" id="message">
                            <div class="pt-4 content_panel">
                                @include('admin.client.manpower.bmet_payment')
                            </div>
                        </div>

                        <div class="tab-pane fade" id="othertab">
                            <div class="pt-4 content_panel">
                                @include('admin.client.manpower.customer_embassy')
                            </div>
                        </div>

                        <div class="tab-pane fade" id="profile">
                            <div class="pt-4 content_panel">
                                @include('admin.client.manpower.customer_list')
                            </div>
                        </div>

                        <div class="tab-pane fade" id="contact">
                            <div class="pt-4 content_panel">
                                @include('admin.client.manpower.print_file')
                            </div>
                        </div>

                        <div class="tab-pane fade" id="wordFile">
                            <div class="pt-4 content_panel">
                                @include('admin.client.manpower.manpower_word_file')
                            </div>
                        </div>

                        <div class="tab-pane fade" id="oldManpower">
                            <div class="pt-4 content_panel">
                                @include('admin.client.manpower.manpower_list_old')
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection