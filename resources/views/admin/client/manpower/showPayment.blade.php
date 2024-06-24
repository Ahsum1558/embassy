@extends('admin.master')

@section('main-content')
<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Manpower Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Payment Details</a></li>
        </ol>
    </div>
</div>
@include('admin.includes.alert')
<div class="row">


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
            <h4 class="card-title headline">Income Tax, Welfare Insurance, Smart Card Details of <strong>({{ date('d-M-Y', strtotime($bmet_display[0]->manpowerDate)) }})</strong></h4>
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
                        <td>{{ $bmet_display[0]->incomeTax / $bmet_display[0]->customerNumber }}</td>
                        <td rowspan="3">{{ $bmet_display[0]->customerNumber }}</td>
                        <td>{{ $bmet_display[0]->incomeTax }}</td>
                        <td>{{ $bmet_display[0]->incomeTaxNo }}</td>
                        <td>{{ date('d-M-Y', strtotime($bmet_display[0]->incomeTaxDate)) }}</td>
                        <td>{{ $bmet_display[0]->taxPayBank }}</td>
                        <td>
                          @if($bmet_display[0]->status == 1)
                            {{ __('Active') }}
                            @elseif($bmet_display[0]->status == 0)
                            {{ __('Inactive') }}
                          @endif
                        </td>
                    </tr>

                    <tr>
                        <td>Welfare Insurance</td>
                        <td>{{ $bmet_display[0]->welfareInsurance / $bmet_display[0]->customerNumber }}</td>
                        <td>{{ $bmet_display[0]->welfareInsurance }}</td>
                        <td>{{ $bmet_display[0]->welfareInsuranceNo }}</td>
                        <td>{{ date('d-M-Y', strtotime($bmet_display[0]->welfareInsuranceDate)) }}</td>
                        <td>{{ $bmet_display[0]->insurancePayBank }}</td>
                        <td>
                          @if($bmet_display[0]->status == 1)
                            {{ __('Active') }}
                            @elseif($bmet_display[0]->status == 0)
                            {{ __('Inactive') }}
                          @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Smart Card</td>
                        <td>{{ $bmet_display[0]->smartCard / $bmet_display[0]->customerNumber }}</td>
                        <td>{{ $bmet_display[0]->smartCard }}</td>
                        <td>{{ $bmet_display[0]->smartCardNo }}</td>
                        <td>{{ date('d-M-Y', strtotime($bmet_display[0]->smartCardDate)) }}</td>
                        <td>{{ $bmet_display[0]->smartPayBank }}</td>
                        <td>
                          @if($bmet_display[0]->status == 1)
                            {{ __('Active') }}
                            @elseif($bmet_display[0]->status == 0)
                            {{ __('Inactive') }}
                          @endif
                        </td>
                    </tr>
        
                </tbody>
            </table>
            <div class="mybtn pt-3">
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.manpower.editPayment', ['id'=>$bmet_display[0]->id]) }}">Update Payment Info</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.manpower.editTax', ['id'=>$bmet_display[0]->id]) }}">Update Tax Pay Order No.</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.manpower.editInsurance', ['id'=>$bmet_display[0]->id]) }}">Update Insurance Pay Order No.</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.manpower.editCard', ['id'=>$bmet_display[0]->id]) }}">Update Card Pay Order No.</a>
                <a class="btn submitbtn mb-2 form-control inline_setup pull-right text-uppercase" href="{{ route('admin.manpower') }}">Back</a>
            </div>

        </div>
    </div>
</div>

</div>
@endsection