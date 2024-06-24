@extends('admin.master')

@section('main-content')

 @include('admin.includes.alert')

<div class="dashboard_area card_line">
  <div class="card">
    <div class="card-header card_headline border-bottom-0">
        <h4 class="card-title headline">Dashboard</h4>
    </div>
    <div class="dashboard_sum">
      <div class="das_headeing">
        Welcome To <strong>{{ Auth::user()->title }}</strong>
        <span class="pull-right">
            @if(strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d')))
                <strong class="bg-white text-danger delete_option">Expired</strong>
            @else
                Expire on <strong>{{ date('F j, Y', strtotime(Auth::user()->userExpiry)) }}</strong>
            @endif
        </span>
      </div>
      <div class="deposit_sum page-titles p-0 m-0">
        <div class="welcome-text welcome_area">
            <h4>
              <strong>{{ Auth::user()->name }}</strong> Welcome back !
              <span class="pull-right">
                @if(Auth::user()->type == 'approve')
                  <strong class="bg-success text-white view_option">{{ __('Approved') }}</strong>
                    @elseif(Auth::user()->type == 'pending')
                  <strong class="bg-warning text-white edit_option">{{ __('Pending') }}</strong>
                    @elseif(Auth::user()->type == 'disable')
                  <strong class="bg-danger text-white delete_option">{{ __('Disabled') }}</strong>
                @endif
              </span>
            </h4>
        </div>
        <div class="row welcome_content mr-1 ml-1">
          <p>Congratulations on being part of the team ! The whole company welcomes you and we look forward to a successful journey with you !</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection