@extends('admin.master')

@section('main-content')

 @include('admin.includes.alert')
<div class="dashboard_area card_line">
    <div class="card">
        <div class="card-header card_headline border-bottom-0">
            <h4 class="card-title headline">Age Calculator</h4>
        </div>
        <div class="dashboard_sum">
            <div class="deposit_sum page-titles p-0 m-0">
                <div class="row welcome_content mr-1 ml-1">
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('admin.calculateAge') }}" class="form-group" method="GET">
                                <div class="profile-personal-info">
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Date of Birth<span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="date" name="dob" class="form-control d-inline-block inline_setup" value="{{ old('dob') }}" max="{{ date('Y-m-d') }}"></div>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3"></div>
                                    <div class="modal-footer col-9 mybtn">
                                        <button type="submit" name="calculate" class="form-control inline_setup btn submitbtn text-uppercase w-auto">Calculate</button>
                                    </div>
                                </div>
                                @if (isset($ageResult))
                                    {{ $ageResult }}
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection