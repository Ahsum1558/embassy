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
            <p>Congratulations on being part of the team ! The whole company welcomes you and we look forward to a successful journey with you !
                @if(Auth::check() && (Auth::user()->title === NULL || Auth::user()->license === NULL || Auth::user()->title_bn === NULL || Auth::user()->license_bn === NULL || Auth::user()->title_ar === NULL || Auth::user()->license_ar === NULL))
                <a href="{{ route('admin.profile.create') }}" class="text-info text-uppercase font-weight-bold">Please fill out the Office Information</a>
            @endif
            </p>
        </div>
        <div class="row">
          <div class="col-xl-11 text-center m-auto">
            <div class="card">
                <div class="card-body p-4 slider_area">
                    <div class="bootstrap-carousel">
                        <div data-ride="carousel" class="carousel slide" id="carouselExampleCaptions">
                            <ol class="carousel-indicators">
                                @foreach($all_slider as $index => $slider)
                                    <li data-slide-to="{{ $index }}" data-target="#carouselExampleCaptions" class="{{ $index == 0 ? 'active' : '' }}"></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach($all_slider as $index => $slider)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <a href="{{ $slider->img_url }}">
                                            <img alt="" class="d-block w-100 img_slider" src="{{ url('public/admin/uploads/slider/'.$slider->slide_img) }}">
                                        </a>
                                        <div class="d-none d-block slider_option">
                                            <h5 class="slider_head">{{ $slider->slide_head }}</h5>
                                            <a class="slider_text" href="{{ $slider->des_url }}">{{ Str::limit($slider->slide_des, 400) }}</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <a data-slide="prev" href="#carouselExampleCaptions" class="carousel-control-prev"><span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span></a>
                            <a data-slide="next" href="#carouselExampleCaptions" class="carousel-control-next"><span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span></a>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>
@endsection