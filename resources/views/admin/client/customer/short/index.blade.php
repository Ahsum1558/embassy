@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Customer Short</a></li>
        </ol>
    </div>
</div>
@include('admin.includes.alert')
<div class="mybtn">
    <a href="{{ route('admin.customer.createShort') }}" class="btn submitbtn mb-2 form-control inline_setup text-uppercase">Add New Customer With Short</a>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">All Customer Info</h4>
            </div>
            <div class="card-body">
              <h4 class="mb-4 basic_headline">Customer Info</h4>
              <div class="table-responsive">
                  <table id="example" class="display" style="min-width: 700px">
                      <thead>
                          <tr>
                              <th>SL</th>
                              <th>Serial</th>
                              <th>Name</th>
                              <th>Passport No.</th>
                              <th>Medical</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php
                          $i=1;
                        @endphp
                      @foreach($all_customer as $customer)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $customer->customersl }}</td>
                            <td>{{ $customer->cusFname .' '. $customer->cusLname }}</td>
                            <td>{{ $customer->passportNo }}</td>
                            <td>
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
                            </td>
                            <td>
                              @if($customer->status == 1)
                                {{ __('Active') }}
                                @elseif($customer->status == 0)
                                {{ __('Inactive') }}
                              @endif
                            </td>
                            <td>
                              <a class="view_option" href="{{ route('admin.customer.show', ['id'=>$customer->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
                            @if($customer->value == 0)
                              <a class="edit_option bg-success" href="{{ route('admin.customer.document', ['id'=>$customer->id]) }}"><i class="fas fa-pencil"></i><span>Add Documents</span></a>
                            @elseif($customer->value == 1)
                              <a class="edit_option bg-info" href="{{ route('admin.customer.passport', ['id'=>$customer->id]) }}"><i class="fas fa-pencil"></i><span>Add Passport Info</span></a>
                            @elseif($customer->value == 2)
                              <a class="edit_option bg-danger" href="{{ route('admin.customer.embassy', ['id'=>$customer->id]) }}"><i class="fas fa-pencil"></i><span>Add Embassy Info</span></a>
                            @endif
                            <a class="edit_option" href="{{ route('admin.customer.editShort', ['id'=>$customer->id]) }}"><i class="fas fa-edit"></i><span>Update Primary Short</span></a>
                            <a class="edit_option bg-success" href="{{ route('admin.customer.editDocs', ['id'=>$customer->id]) }}"><i class="fas fa-edit"></i><span>Update Documents</span></a>
                            <a class="edit_option bg-info" href="{{ route('admin.customer.editInfoShort', ['id'=>$customer->id]) }}"><i class="fas fa-edit"></i><span>Update Passport Info Short</span></a>
                            <a class="edit_option bg-primary" href="{{ route('admin.customer.editAddress', ['id'=>$customer->id]) }}"><i class="fas fa-edit"></i><span>Update Address Info Short</span></a>
                            @if($customer->value >= 3)
                              <a class="view_option" target="_blank" href="{{ route('admin.customer.print', ['id'=>$customer->id]) }}"><i class="fa fa-print"></i><span>Print</span></a>
                            @endif
                              <a class="delete_option" href="#delCustomer{{ $customer->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Delete</span></a>
                            </td>
                @include('admin.client.customer.short.customer_modal')
                        </tr>
               @endforeach
                      </tbody>
                  </table>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection