@extends('admin.master')

@section('main-content')
<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Submission Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Details</a></li>
        </ol>
    </div>
</div>
@include('admin.includes.alert')
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Submission Information Details</h4>
            </div>
            <div class="card-body">

                <div class="content_panel mb-2">
                    <h4 class="mb-4 basic_headline">Submission Information</h4>
                    <form action="" class="form-group" method="POST" enctype="multipart/form-data">
                        <div class="row">
                        <!--Tab slider End-->
                            <div class="col-xl-9 col-sm-12">
                                <div class="product-detail-content">
                                    <!--Product details-->
                                    <div class="new-arrival-content pr">
                                        <div class="row mb-2">
                                            <div class="col-3">
                                                <h5 class="f-w-500">Submission Date<span class="pull-right">:</span></h5>
                                            </div>
                                            <div class="col-9"><span>{{ date('d-M-Y', strtotime($submission_single_data[0]->submissionDate)) }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-3">
                                                <h5 class="f-w-500">Office Name<span class="pull-right">:</span></h5>
                                            </div>
                                            <div class="col-9"><span>{{ Auth::user()->title }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-3">
                                                <h5 class="f-w-500">Office License<span class="pull-right">:</span></h5>
                                            </div>
                                            <div class="col-9"><span>{{ Auth::user()->license }}</span>
                                            </div>
                                        </div>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </form>

                    <a class="tranprint back_button" href="{{ route('admin.submission') }}">Back</a>

                    <h4 class="mb-4 basic_headline">All Customer</h4>
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 700px">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Office SL</th>
                                    <th>Name</th>
                                    <th>Passport No.</th>
                                    <th>Visa No.</th>
                                    <th>Hijri Year</th>
                                    <th>Ordinal No.</th>
                                    <th>Type</th>
                                    <th>Agent</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                    @php
                      $i=1;
                    @endphp
                    @foreach ($submission_customers as $customer)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $customer->customersl }}</td>
                                    <td>{{ $customer->cusFname .' '. $customer->cusLname }}</td>
                                    <td>{{ $customer->passportNo }}</td>
                                    <td>{{ $customer->visano_en }}</td>
                                    <td>{{ $customer->visaYear }}</td>
                                    <td>{{ $customer->ordinal }}</td>
                                    <td>
                                      @if($customer->submissionType == 1)
                                        {{ __('New Submission') }}
                                        @elseif($customer->submissionType == 2)
                                        {{ __('Visa Extension') }}
                                        @elseif($customer->submissionType == 3)
                                        {{ __('Visa Renew') }}
                                        @elseif($customer->submissionType == 4)
                                        {{ __('Visa Reissue') }}
                                        @elseif($customer->submissionType == 5)
                                        {{ __('Replacement') }}
                                        @elseif($customer->submissionType == 6)
                                        {{ __('Cancel') }}
                                        @else
                                        {{ __('N/A') }}
                                      @endif
                                    </td>
                                    <td>{{ $customer->agentname .' '. $customer->agentsl }}</td>
                                    <td>
                                      @if($customer->status == 1)
                                        {{ __('Active') }}
                                        @elseif($customer->status == 0)
                                        {{ __('Inactive') }}
                                      @endif
                                    </td>
                                    <td>
                                        <a class="view_option" href="#customerView{{ $customer->id }}" data-toggle="modal"><i class="fas fa-eye"></i><span>View Details</span></a>
                                        <a class="edit_option" href="{{ route('admin.submission.editStatement', ['id'=>$customer->id]) }}"><i class="fas fa-edit"></i><span>Update Customer List</span></a>
                                @if($customer->emblist == 1)
                                      <a class="delete_option" href="#removeSubmission{{ $customer->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Remove From List</span></a>
                                @endif
                                    </td>
                            @include('admin.client.submission.submission_view')
                            @include('admin.client.submission.submission_remove')
                                </tr>
                    @endforeach
                            </tbody>
                        </table>
                    </div> 
                </div>
                <div class="content_panel">
                    <div class="mybtn">
                        <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.submission.edit', ['id'=>$submission_single_data[0]->id]) }}">Update</a>
                        <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.submission') }}">Back</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection