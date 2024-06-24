@php
    $id = Auth::guard('super')->user()->id;
    $superData = App\Models\Super::find($id);
@endphp
@if($superData->theme == 'default')
    <link href="{{ asset('public/admin/assets/theme/default.css') }}" rel="stylesheet">
@elseif($superData->theme == 'blue')
    <link href="{{ asset('public/admin/assets/theme/blue.css') }}" rel="stylesheet">
@elseif($superData->theme == 'blue_light')
    <link href="{{ asset('public/admin/assets/theme/blue_light.css') }}" rel="stylesheet">
@elseif($superData->theme == 'brown')
    <link href="{{ asset('public/admin/assets/theme/brown.css') }}" rel="stylesheet">
@elseif($superData->theme == 'green')
    <link href="{{ asset('public/admin/assets/theme/green.css') }}" rel="stylesheet">
@elseif($superData->theme == 'purple')
    <link href="{{ asset('public/admin/assets/theme/purple.css') }}" rel="stylesheet">
@elseif($superData->theme == 'violet')
    <link href="{{ asset('public/admin/assets/theme/violet.css') }}" rel="stylesheet">
@elseif($superData->theme == 'dark')
    <link href="{{ asset('public/admin/assets/theme/dark.css') }}" rel="stylesheet">
@elseif($superData->theme == 'mint')
    <link href="{{ asset('public/admin/assets/theme/mint.css') }}" rel="stylesheet">
@endif