@foreach ($manpower_payment as $payment)
<style>
    #paymentTable {
  border-collapse: collapse;
  width: 100%;
}

#paymentTable th, #paymentTable td {
  border: 1px solid black;
  padding: 8px;
  text-align: center;
}

#paymentTable th {
  background-color: #fff;
}
</style>
<div class="col-12">
    <div class="card card_line">
        <div class="card-header card_headline">
            <h4 class="card-title headline">Income Tax, Welfare Insurance, Smart Card Details</h4>
        </div>
        <div class="card-body">
            <a class="tranprint back_button" href="{{ route('admin.manpower') }}">Back</a>
            <h4 class="mb-4 basic_headline">All Manpower Payment</h4>
            <table id="paymentTable" style="min-width: 700px">
                <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Per Person</th>
                        <th>Total Customer</th>
                        <th>Amount</th>
                        <th>Pay Order No.</th>
                        <th>Pay Order Date</th>
                        <th>Bank</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>Income Tax</td>
                        <td>{{ $payment->incomeTax / $payment->customerNumber }}</td>
                        <td rowspan="3">{{ $payment->customerNumber }}</td>
                        <td>{{ $payment->incomeTax }}</td>
                        <td>{{ $payment->incomeTaxNo }}</td>
                        <td>{{ date('d-M-Y', strtotime($payment->incomeTaxDate)) }}</td>
                        <td>{{ $payment->taxPayBank }}</td>
                        <td>
                          @if($payment->status == 1)
                            {{ __('Active') }}
                            @elseif($payment->status == 0)
                            {{ __('Inactive') }}
                          @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Welfare Insurance</td>
                        <td>{{ $payment->welfareInsurance / $payment->customerNumber }}</td>
                        <td>{{ $payment->welfareInsurance }}</td>
                        <td>{{ $payment->welfareInsuranceNo }}</td>
                        <td>{{ date('d-M-Y', strtotime($payment->welfareInsuranceDate)) }}</td>
                        <td>{{ $payment->insurancePayBank }}</td>
                        <td>
                          @if($payment->status == 1)
                            {{ __('Active') }}
                            @elseif($payment->status == 0)
                            {{ __('Inactive') }}
                          @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Smart Card</td>
                        <td>{{ $payment->smartCard / $payment->customerNumber }}</td>
                        <td>{{ $payment->smartCard }}</td>
                        <td>{{ $payment->smartCardNo }}</td>
                        <td>{{ date('d-M-Y', strtotime($payment->smartCardDate)) }}</td>
                        <td>{{ $payment->smartPayBank }}</td>
                        <td>
                          @if($payment->status == 1)
                            {{ __('Active') }}
                            @elseif($payment->status == 0)
                            {{ __('Inactive') }}
                          @endif
                        </td>
                    </tr>
        
                </tbody>
            </table>
            <div class="mybtn pt-3">
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.manpower.editPayment', ['id'=>$payment->id]) }}">Update Payment Info</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.manpower.editTax', ['id'=>$payment->id]) }}">Update Tax Pay Order No.</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.manpower.editInsurance', ['id'=>$payment->id]) }}">Update Insurance Pay Order No.</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.manpower.editCard', ['id'=>$payment->id]) }}">Update Card Pay Order No.</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="#delPayment{{ $payment->id }}" data-toggle="modal">Delete</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.manpower') }}">Back</a>
            </div>
            @include('admin.client.manpower.payment_modal')

        </div>
    </div>
</div>
@endforeach