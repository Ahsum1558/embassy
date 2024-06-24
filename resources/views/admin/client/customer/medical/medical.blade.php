@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customers</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Medical Info</a></li>
        </ol>
    </div>
</div>
@include('admin.includes.alert')
<div class="row">
    <div class="col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Medical Information</h4>
            </div>
            <div class="card-body">
        
                <div class="default-tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home"><i class="la la-home mr-2"></i>Primary Customer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile"><i class="las la-list mr-2"></i>MC Done</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#contact"><i class="la la-sticky-note mr-2"></i>MC Fit</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#mcUpdate"><i class="las la-save mr-2"></i>MC Updated</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#message"><i class="la la-pencil-square-o mr-2"></i>MC Problem</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#othertab"><i class="la la-laptop mr-2"></i>MC Unfit</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="home" role="tabpanel">
                            <div class="pt-4 content_panel">
                                @include('admin.client.customer.medical.medical_primary')
                            </div>
                        </div>

                        <div class="tab-pane fade" id="profile">
                            <div class="pt-4 content_panel">
                                @include('admin.client.customer.medical.medical_done')
                            </div>
                        </div>

                        <div class="tab-pane fade" id="contact">
                            <div class="pt-4 content_panel">
                                @include('admin.client.customer.medical.medical_fit')
                            </div>
                        </div>

                        <div class="tab-pane fade" id="mcUpdate">
                            <div class="pt-4 content_panel">
                                @include('admin.client.customer.medical.medical_update')
                            </div>
                        </div>

                        <div class="tab-pane fade" id="message">
                            <div class="pt-4 content_panel">
                                @include('admin.client.customer.medical.medical_problem')
                            </div>
                        </div>

                        <div class="tab-pane fade" id="othertab">
                            <div class="pt-4 content_panel">
                                @include('admin.client.customer.medical.medical_unfit')
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection