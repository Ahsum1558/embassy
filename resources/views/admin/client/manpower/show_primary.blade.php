<div class="col-12">
    <div class="card card_line">
        <div class="card-header card_headline">
            <h4 class="card-title headline">Manpower Information Details of <strong>({{ date('d-M-Y', strtotime($manpower_single_data[0]->manpowerDate)) }})</strong></h4>
        </div>
        <div class="card-body">
            <h4 class="mb-4 basic_headline">Manpower Information</h4>
            <form action="" class="form-group" method="POST" enctype="multipart/form-data">
                <div class="row">
                <!--Tab slider End-->
                    <div class="col-xl-9 col-sm-12">
                        <div class="product-detail-content">
                            <!--Product details-->
                            <div class="new-arrival-content pr">
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Manpower Date<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ date('d-M-Y', strtotime($manpower_single_data[0]->manpowerDate)) }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Notesheet<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $manpower_single_data[0]->putupSl }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Destination Country<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $manpower_single_data[0]->countrynamebn }}</span>
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
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">License Expiry<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ date('d-M-Y', strtotime(Auth::user()->licenseExpiry)) }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Office Address<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ Auth::user()->address }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Proprietor<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ Auth::user()->proprietor }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Proprietor Title<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ Auth::user()->proprietortitle }}</span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Office Name Arabic<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ Auth::user()->title_ar }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Office License Arabic<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ Auth::user()->license_ar }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Office Address Arabic<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ Auth::user()->address_ar }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Proprietor Arabic<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ Auth::user()->proprietor_ar }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Proprietor Title Arabic<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ Auth::user()->proprietortitle_ar }}</span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Office Name Bengali<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ Auth::user()->title_bn }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Office License Bengali<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ Auth::user()->license_bn }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Office Address Bengali<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ Auth::user()->address_bn }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Proprietor Bengali<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ Auth::user()->proprietor_bn }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Proprietor Title Bengali<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ Auth::user()->proprietortitle_bn }}</span>
                                    </div>
                                </div>

                            </div>
                            
                        </div>
                    </div>
                </div>
            </form>

            <div class="mybtn">
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.manpower.edit', ['id'=>$manpower_single_data[0]->id]) }}">Update Info</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.manpower.editDate', ['id'=>$manpower_single_data[0]->id]) }}">Update Date</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.manpower.editNotesheet', ['id'=>$manpower_single_data[0]->id]) }}">Update Notesheet No.</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.manpower') }}">Back</a>
            </div>                
        </div>
    </div>
</div>