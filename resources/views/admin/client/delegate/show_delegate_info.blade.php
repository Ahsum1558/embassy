<div class="col-xl-12 col-lg-12">
    <div class="card card_line">
        <div class="card-header card_headline">
           <h4 class="card-title headline">Delegate Info Details of {{ $delegate_single_data[0]->agentname }}</h4>
        </div>
        <div class="card-body">
            <h4 class="mb-4 basic_headline">Delegate Info</h4>
            <div class="profile-uoloaded-post border-bottom-1 pb-5">
                <div class="row">
                    <div class="col-xl-3 ">
                    <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="first">
                                <img class="img-fluid img_user rounded-circle" src="{{ (!empty($delegate_single_data[0]->photo)) ? url('public/admin/uploads/delegate/'.$delegate_single_data[0]->photo) : url('public/admin/assets/images/avatar.png') }}" alt="">  
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-9 col-sm-12">
                        <div class="profile-personal-info">
                        
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Serial Number<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $delegate_single_data[0]->agentsl }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Ref Book No.<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $delegate_single_data[0]->agentbook }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Delegate Name<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $delegate_single_data[0]->agentname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Care Of<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $delegate_single_data[0]->father }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">NID Number<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $delegate_single_data[0]->nid }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Office Name<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $delegate_single_data[0]->office }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Office Address<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $delegate_single_data[0]->officeLocation }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Phone Number<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $delegate_single_data[0]->phone }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">E-Mail Address<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $delegate_single_data[0]->email }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Date Of Birth<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ date('d-M-Y', strtotime($delegate_single_data[0]->dateOfBirth)) }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Gender <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>
                                    @if($delegate_single_data[0]->gender == 1)
                                    {{ __('Male') }}
                                    @elseif($delegate_single_data[0]->gender == 2)
                                    {{ __('Female') }}
                                    @else
                                    {{ __('Other') }}
                                    @endif
                                </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Bank Account No.<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $delegate_single_data[0]->accountNo }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Bank Name<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $delegate_single_data[0]->bankname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Bank Branch<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $delegate_single_data[0]->bankbranch }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Home Address<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $delegate_single_data[0]->address }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Upzila <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $delegate_single_data[0]->policestationname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">District <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $delegate_single_data[0]->districtname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">City <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $delegate_single_data[0]->cityname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Division <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $delegate_single_data[0]->divisionname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Country <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $delegate_single_data[0]->countryname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Zipcode<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $delegate_single_data[0]->zipcode }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Description<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $delegate_single_data[0]->description }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Status<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>
                                    @if($delegate_single_data[0]->status == 1)
                                        {{ __('Active') }}
                                        @elseif($delegate_single_data[0]->status == 0)
                                        {{ __('Inactive') }}
                                    @endif
                                </span>
                                </div>
                            </div>
                           
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Created At<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ date('d-M-Y', strtotime($delegate_single_data[0]->created_at)) }}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="mybtn">
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.delegate.edit', ['id'=>$delegate_single_data[0]->id]) }}">Update</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.delegate.editBook', ['id'=>$delegate_single_data[0]->id]) }}">Update Book Referance</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.delegate.editEmail', ['id'=>$delegate_single_data[0]->id]) }}">Update E-Mail</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.delegate.editImage', ['id'=>$delegate_single_data[0]->id]) }}">Update Image</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.delegate') }}">Back</a>
            </div>
        </div>
    </div>
</div>