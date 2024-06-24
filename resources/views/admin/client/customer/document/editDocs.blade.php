@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Documents</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">
                    Update Documents of <strong>{{ $customer_edit_docs->cusFname .' '. $customer_edit_docs->cusLname }}</strong>
                </h4>
            </div>
            <div class="card-body">
                @include('admin.includes.alert')
                @foreach ($docs_edit as $docs)
                <form action="{{ route('admin.customer.updateDocs', ['id' => $docs->customerId]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="product-detail-content">
                                <div class="new-arrival-content pr">
                                    <!-- Refactor the code into a loop -->
                                    @foreach ([
                                        'Police Clearance Certificate' => 'pc',
                                        'License' => 'license',
                                        'Training Certificate' => 'tc',
                                        'Certificate' => 'certificate',
                                        'Musaned' => 'musaned',
                                        'Finger' => 'finger',
                                    ] as $label => $name)
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">{{ $label }}<span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9">
                                            <span><input type="text" name="{{ $name }}" class="form-control d-inline-block inline_setup" value="{{ $docs->$name }}"></span>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                    <div class="row mb-2">
                                        <div class="col-3"></div>
                                        <div class="col-9 mybtn">
                                            <button type="submit" name="update" class="form-control inline_setup btn submitbtn text-uppercase">Update</button>
                                            <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.customer.show', ['id' => $customer_edit_docs->id]) }}">Back</a>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3"></div>
                                        <div class="col-9 mybtn">
                                            <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.customer.insertShort') }}">Back To Short Field</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection