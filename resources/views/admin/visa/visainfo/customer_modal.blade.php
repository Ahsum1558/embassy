<div id="customerView{{ $customer->id }}" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Customer Details</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Customer Details</h4>
            </div>
            <div class="card-body">
                <form action="" class="form-group" method="POST" enctype="multipart/form-data">
                    <div class="row">
                    <div class="col-xl-3 ">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="first">
                            <img class="img-fluid img_user rounded-circle" src="{{ (!empty($customer->photo)) ? url('public/admin/uploads/customer/'.$customer->photo) : url('public/admin/assets/images/avatar.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <!--Tab slider End-->
                    <div class="col-xl-9 col-sm-12">
                        <div class="product-detail-content">
                            <!--Product details-->
                            <div class="new-arrival-content pr">
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Full Name <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $customer->cusFname .' '. $customer->cusLname }}</span>
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Office SL <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $customer->customersl }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Referance Book Number <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $customer->bookRef }}</span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Passport No.<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $customer->passportNo }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Mobile <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $customer->phone }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Medical<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>
                                    @if($customer->medical == 1)
                                    {{ __('Done') }}
                                    @elseif($customer->medical == 2)
                                    {{ __('Fit') }}
                                    @elseif($customer->medical == 3)
                                    {{ __('Unfit') }}
                                    @elseif($customer->medical == 4)
                                    {{ __('N/A') }}
                                    @elseif($customer->medical == 5)
                                    {{ __('Problem') }}
                                    @endif
                                    </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer mybtn">
                <button type="button" class="form-control inline_setup btn submitbtn text-uppercase w-25" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
 </div>
</div>