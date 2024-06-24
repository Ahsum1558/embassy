<div class="col-xl-12 col-lg-12">
    <div class="card card_line">
        <div class="card-header card_headline">
           <h4 class="card-title headline">Office Payment Information</h4>
        </div>
        <div class="card-body">
            @include('super.includes.alert')
            <h4 class="mb-4 basic_headline">Payment Info</h4>
            <div class="profile-uoloaded-post border-bottom-1 pb-5">
                <div class="row">
                    <div class="col-xl-12 col-sm-12">
                        <div class="profile-personal-info">
                            <a class="tranprint back_button" href="{{ route('super.operator') }}">Back</a>
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 700px">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Payment Date</th>
                                            <th>Expiry Date</th>
                                            <th>Transaction No.</th>
                                            <th>System</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            @php
                              $i=1;
                            @endphp
                            @foreach ($payments_info as $payment)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>
                                              @if($payment->trans_date != NULL)
                                                {{ date('d-M-Y', strtotime($payment->trans_date)) }}
                                                @else
                                                {{ __('N/A') }}
                                              @endif
                                            </td>
                                            <td>
                                              @if($payment->userExpiry != NULL)
                                                {{ date('d-M-Y', strtotime($payment->userExpiry)) }}
                                                @else
                                                {{ __('N/A') }}
                                              @endif
                                            </td>
                                            <td>{{ $payment->payment_data }}</td>
                                            <td>
                                                @if($payment->trans_system == 'cash')
                                                  {{ __('Cash') }}
                                                @elseif($payment->trans_system == 'bank')
                                                  {{ __('Bank') }}
                                                @elseif($payment->trans_system == 'nagad')
                                                  {{ __('Nagad') }}
                                                @elseif($payment->trans_system == 'bkash')
                                                  {{ __('Bkash') }}
                                                @elseif($payment->trans_system == 'rocket')
                                                  {{ __('Rocket') }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($payment->type == 'approve')
                                                  {{ __('Approved') }}
                                                    @elseif($payment->type == 'pending')
                                                  {{ __('Pending') }}
                                                    @elseif($payment->type == 'disable')
                                                  {{ __('Disabled') }}
                                                @endif
                                            </td>
                                            <td>{{ $payment->trans_amount }}</td>
                                            <td>
                                              @if($payment->status == 1)
                                                {{ __('Active') }}
                                                @elseif($payment->status == 0)
                                                {{ __('Inactive') }}
                                              @endif
                                            </td>
                                            <td>
                                                <a class="view_option" href="{{ route('super.operator.editExtension', ['id'=>$payment->id]) }}"><i class="fas fa-edit"></i><span>Update Extension</span></a>
                                                <a class="edit_option" href="{{ route('super.operator.editExpansion', ['id'=>$payment->id]) }}"><i class="fas fa-edit"></i><span>Update Expansion</span></a>
                                                <a class="delete_option" href="#delPayment{{ $payment->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Delete</span></a>
                                            </td>
                    @include('super.operator.userPayment.payment_modal')
                                        </tr>
                            @endforeach
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>