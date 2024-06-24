<div class="col-xl-12 col-lg-12">
    <div class="card card_line">
        <div class="card-header card_headline">
           <h4 class="card-title headline">Passport Copy of <strong>{{ $customer_single_data[0]->cusFname .' '. $customer_single_data[0]->cusLname }}</strong></h4>
        </div>
        <div class="card-body">
            <h4 class="mb-4 basic_headline">Passport Copy</h4>
            <div class="profile-uoloaded-post border-bottom-1 pb-5">
                <div class="row">
                    <div class="col-xl-12 col-sm-12">
                    <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="first">
                                <img class="img-fluid" src="{{ (!empty($customer_single_data[0]->passportCopy)) ? url('public/admin/uploads/customer/'.$customer_single_data[0]->passportCopy) : url('public/admin/assets/images/avatar.png') }}" alt="">  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mybtn">
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.customer.editPassportCopy', ['id'=>$customer_single_data[0]->id]) }}">Update Passport Copy</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.customer') }}">Back</a>
            </div>
        </div>
    </div>
</div>