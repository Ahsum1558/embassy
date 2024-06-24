<div class="col-xl-12 col-lg-12">
    <div class="card card_line">
        <div class="card-header card_headline">
           <h4 class="card-title headline">Office Approval Information</h4>
        </div>
        <div class="card-body">
            <h4 class="mb-4 basic_headline">Approval Information</h4>
            <div class="profile-uoloaded-post border-bottom-1 pb-5">
                <div class="row">
                    <div class="col-xl-12 col-sm-12">
                        <div class="profile-personal-info">
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Last Payment Reference<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->payment_data }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Last Payment Amount<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->trans_amount }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Last Payment Date<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>
                                    @if($profile_data[0]->trans_date !== NULL)
                                        {{ date('d-M-Y', strtotime($profile_data[0]->trans_date)) }}
                                    @else
                                        {{ __('N/A') }}
                                    @endif
                                </span>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">User Expiry Date<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9">
                                    @php
                                        $expiryDate = strtotime($profile_data[0]->userExpiry);
                                        $currentDate = strtotime(date('Y-m-d'));
                                    @endphp
                                    <span>
                                    @if($profile_data[0]->userExpiry !== NULL)
                                        {{ date('d-M-Y', $expiryDate) }}
                                    @else
                                        {{ __('N/A') }}
                                    @endif
                                        @if ($expiryDate < $currentDate)
                                        <strong class="bg-danger text-white delete_option">{{ __('Expired') }}</strong>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Payment Type<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9">
                                    <span>
                                    @if($profile_data[0]->trans_system == 'cash')
                                      {{ __('Cash') }}
                                    @elseif($profile_data[0]->trans_system == 'bank')
                                      {{ __('Bank') }}
                                    @elseif($profile_data[0]->trans_system == 'nagad')
                                      {{ __('Nagad') }}
                                    @elseif($profile_data[0]->trans_system == 'bkash')
                                      {{ __('Bkash') }}
                                    @elseif($profile_data[0]->trans_system == 'rocket')
                                      {{ __('Rocket') }}
                                    @endif
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">User Type<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9">
                                    <span>
                                    @if($profile_data[0]->type == 'approve')
                                      <strong class="bg-success text-white view_option">{{ __('Approved') }}</strong>
                                        @elseif($profile_data[0]->type == 'pending')
                                      <strong class="bg-warning text-white edit_option">{{ __('Pending') }}</strong>
                                        @elseif($profile_data[0]->type == 'disable')
                                      <strong class="bg-danger text-white delete_option">{{ __('Disabled') }}</strong>
                                    @endif
                                </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">User Level<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9">
                                    <span>
                                      @if($profile_data[0]->role == 'admin')
                                        {{ __('Admin') }}
                                        @elseif($profile_data[0]->role == 'author')
                                        {{ __('Author') }}
                                        @elseif($profile_data[0]->role == 'editor')
                                        {{ __('Editor') }}
                                        @elseif($profile_data[0]->role == 'contributor')
                                        {{ __('Contributor') }}
                                        @elseif($profile_data[0]->role == 'user')
                                        {{ __('User') }}
                                      @endif
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Status<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>
                                    @if($profile_data[0]->status == 'active')
                                        {{ __('Active') }}
                                        @elseif($profile_data[0]->status == 'inactive')
                                        {{ __('Inactive') }}
                                    @endif
                                </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Created At<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ date('d-M-Y', strtotime($profile_data[0]->created_at)) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @php
            $expiryDate = strtotime($profile_data[0]->userExpiry);
            $currentDate = strtotime(date('Y-m-d'));
            $threeDaysBefore = strtotime('5 days', $currentDate);
        @endphp
        @if ($expiryDate <= $threeDaysBefore || $profile_data[0]->type == 'pending' || $profile_data[0]->type == 'disable')
            <div class="mybtn">
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.profile.extension') }}">Extension</a>
            </div>
        @endif
        </div>
    </div>
</div>