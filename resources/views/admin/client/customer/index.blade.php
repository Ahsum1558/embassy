@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Customer Info</a></li>
        </ol>
    </div>
</div>
@include('admin.includes.alert')
<div class="mybtn">
    <a href="{{ route('admin.customer.create') }}" class="btn submitbtn mb-2 form-control inline_setup text-uppercase">Add New Customer</a>
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
                              <th>Book Ref</th>
                              <th>Name</th>
                              <th>Passport No.</th>
                              <th>Delegate</th>
                              <th>Trade</th>
                              <th>Medical</th>
                              <th>Destination</th>
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
                            <td>{{ $customer->bookRef }}</td>
                            <td>{{ $customer->cusFname .' '. $customer->cusLname }}</td>
                            <td>{{ $customer->passportNo }}</td>
                            <td>{{ $customer->agentname .' '. $customer->agentsl }}</td>
                            <td>{{ $customer->visatrade_name }}</td>
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
                            <td>{{ $customer->destination_country }}</td>
                            <td>
                              @if($customer->status == 1)
                                {{ __('Active') }}
                                @elseif($customer->status == 0)
                                {{ __('Inactive') }}
                              @endif
                            </td>
                            <td>
                              <a class="view_option" href="{{ route('admin.customer.show', ['id'=>$customer->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
                            @if($customer->status == 1)
                              <a class="edit_option bg-warning" href="#inActiveId{{ $customer->id }}" data-toggle="modal"><i class="fas fa-caret-square-down"></i><span>Set Inactive</span></a>
                            @elseif($customer->status == 0)
                              <a class="edit_option" href="#activeId{{ $customer->id }}" data-toggle="modal"><i class="fas fa-caret-square-up"></i><span>Set Active</span></a>
                            @endif
                            @if($customer->value == 0)
                              <a class="edit_option bg-success" href="{{ route('admin.customer.document', ['id'=>$customer->id]) }}"><i class="fas fa-pencil"></i><span>Add Documents</span></a>
                            @elseif($customer->value == 1)
                              <a class="edit_option bg-info" href="{{ route('admin.customer.passport', ['id'=>$customer->id]) }}"><i class="fas fa-pencil"></i><span>Add Passport Info</span></a>
                            @elseif($customer->value == 2)
                              <a class="edit_option bg-danger" href="{{ route('admin.customer.embassy', ['id'=>$customer->id]) }}"><i class="fas fa-pencil"></i><span>Add Embassy Info</span></a>
                            @endif
                            @if($customer->value >= 3)
                              <a class="view_option" target="_blank" href="{{ route('admin.customer.print', ['id'=>$customer->id]) }}"><i class="fa fa-print"></i><span>Print</span></a>
                            @endif
                              <a class="delete_option" href="#delCustomer{{ $customer->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Delete</span></a>
                            </td>
                @include('admin.client.customer.primary.customer_modal')
                @include('admin.client.customer.primary.customer_active')
                @include('admin.client.customer.primary.customer_inactive')
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