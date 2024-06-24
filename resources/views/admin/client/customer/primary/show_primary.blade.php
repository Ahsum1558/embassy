<div class="col-xl-12 col-lg-12">
    <div class="card card_line">
        <div class="card-header card_headline">
           <h4 class="card-title headline">Information Details of <strong>{{ $customer_single_data[0]->cusFname .' '. $customer_single_data[0]->cusLname }}</strong></h4>
        </div>
        <div class="card-body">
            <h4 class="mb-4 basic_headline">Primary Info</h4>
            <div class="profile-uoloaded-post border-bottom-1 pb-5">
                <div class="row">
                    <div class="col-xl-3 ">
                    <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="first">
                                <img class="img-fluid img_user rounded-circle" src="{{ (!empty($customer_single_data[0]->photo)) ? url('public/admin/uploads/customer/'.$customer_single_data[0]->photo) : url('public/admin/assets/images/avatar.png') }}" alt="">  
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-9 col-sm-12">
                        <div class="profile-personal-info">
                        
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Serial Number<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $customer_single_data[0]->customersl }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Ref Book No.<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $customer_single_data[0]->bookRef }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Customer Name<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $customer_single_data[0]->cusFname .' '. $customer_single_data[0]->cusLname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Passport Number<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $customer_single_data[0]->passportNo }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Delegate<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $customer_single_data[0]->agentname .' '. $customer_single_data[0]->agentsl }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Gender <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>
                                    @if($customer_single_data[0]->gender == 1)
                                    {{ __('Male') }}
                                    @elseif($customer_single_data[0]->gender == 2)
                                    {{ __('Female') }}
                                    @else
                                    {{ __('Other') }}
                                    @endif
                                </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Phone Number<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $customer_single_data[0]->phone }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Place of Birth <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $customer_single_data[0]->districtname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Medical <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>
                                    @if($customer_single_data[0]->medical == 1)
                                    {{ __('Done') }}
                                    @elseif($customer_single_data[0]->medical == 2)
                                    {{ __('Fit') }}
                                    @elseif($customer_single_data[0]->medical == 3)
                                    {{ __('Unfit') }}
                                    @elseif($customer_single_data[0]->medical == 4)
                                    {{ __('N/A') }}
                                    @elseif($customer_single_data[0]->medical == 5)
                                    {{ __('Problem') }}
                                    @endif
                                </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Medical Update<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>
                                    @if($customer_single_data[0]->medical_update == 1)
                                    {{ __('Medical Updated') }}
                                    @elseif($customer_single_data[0]->medical_update == 0)
                                    {{ __('Medical Not Updated') }}
                                    @endif
                                </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Trade<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $customer_single_data[0]->visatrade_name }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Destination Country<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9">
                                    <span>
                                    @if(isset($customer_single_data[0]->destination_country))
                                        {{ $customer_single_data[0]->destination_country }}
                                    @else
                                        {{ __('Saudi Arabia') }}
                                    @endif                              
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Passport Received<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ date('d-M-Y', strtotime($customer_single_data[0]->received)) }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Customer Ref.<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $customer_single_data[0]->receiver }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Status<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>
                                    @if($customer_single_data[0]->status == 1)
                                        {{ __('Active') }}
                                        @elseif($customer_single_data[0]->status == 0)
                                        {{ __('Inactive') }}
                                    @endif
                                </span>
                                </div>
                            </div>
                           
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Created At<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ date('d-M-Y', strtotime($customer_single_data[0]->created_at)) }}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="mybtn">
            @if($customer_single_data[0]->rateValue == 0)
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.customer.rate', ['id'=>$customer_single_data[0]->id]) }}">Add Working Rate</a>
            @endif
            @if($customer_single_data[0]->value == 0)
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.customer.document', ['id'=>$customer_single_data[0]->id]) }}">Add Documents</a>
            @endif
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.customer.edit', ['id'=>$customer_single_data[0]->id]) }}">Update</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.customer.editBook', ['id'=>$customer_single_data[0]->id]) }}">Update Book Referance</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.customer.editPassportNo', ['id'=>$customer_single_data[0]->id]) }}">Update Passport No.</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.customer.editImage', ['id'=>$customer_single_data[0]->id]) }}">Update Image</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.customer.editShort', ['id'=>$customer_single_data[0]->id]) }}">Update Short</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.customer') }}">Back</a>
            </div>
            
        </div>
    </div>
</div>