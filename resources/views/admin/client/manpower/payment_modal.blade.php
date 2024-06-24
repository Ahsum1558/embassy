<!-- Delete -->
<div id="delPayment{{ $payment->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Manpower Payment</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-center">Are you sure you want to Delete !</h5>
                <h4 class="text-center">Tax Number - {{ $payment->incomeTaxNo }}</h4>
                <h4 class="text-center">Tax Payment Date - {{ date('d-M-Y', strtotime($payment->incomeTaxDate)) }}</h4>
                <h4 class="text-center">Insurance Number - {{ $payment->welfareInsuranceNo }}</h4>
                <h4 class="text-center">Insurance Payment Date - {{ date('d-M-Y', strtotime($payment->welfareInsuranceDate)) }}</h4>
                <h4 class="text-center">Card Number - {{ $payment->smartCardNo }}</h4>
                <h4 class="text-center">Smart Card Payment Date - {{ date('d-M-Y', strtotime($payment->smartCardDate)) }}</h4>
            </div>
            <div class="modal-footer mybtn">
                <button type="button" class="form-control inline_setup btn submitbtn text-uppercase" data-dismiss="modal">Close</button>
                <a href="{{ route('admin.manpower.delete', ['id'=>$payment->id]) }}" class="form-control inline_setup btn submitbtn text-uppercase">Delete</a>
            </div>
        </div>
    </div>
</div>