@extends('super.home')

@section('super-content')

 @include('super.includes.alert')

<div class="dashboard_area card_line">
  <div class="card">
    <div class="card-header card_headline border-bottom-0">
        <h4 class="card-title headline">Dashboard</h4>
    </div>
    <div class="dashboard_sum">
      <div class="das_headeing">Welcome To Admin Panel</div>
      <div class="deposit_sum page-titles p-0 m-0">
        <div class="welcome-text welcome_area">
            <h4><strong>{{ Auth::guard('super')->user()->fullname }}</strong> Welcome back !</h4>
        </div>
        <div class="row welcome_content mr-1 ml-1">
          <p>Congratulations on being part of the team ! The whole company welcomes you and we look forward to a successful journey with you !</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection