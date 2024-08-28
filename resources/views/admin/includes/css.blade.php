@php
    $id = Auth::user()->id;
    $userData = App\Models\User::find($id);
    $themes = [
        'default' => 'default.css',
        'dark' => 'dark.css',
        'gray' => 'gray.css',
        'bright' => 'bright.css',
        'pink' => 'pink.css',
        'blue' => 'blue.css',
        'blue_light' => 'blue_light.css',
        'brown' => 'brown.css',
        'green' => 'green.css',
        'purple' => 'purple.css',
        'violet' => 'violet.css',
        'mint' => 'mint.css',
    ];
    $themeCss = $themes[$userData->theme] ?? $themes['default'];
@endphp
<link href="{{ asset('public/admin/assets/theme/' . $themeCss) }}" rel="stylesheet">

{{-- @if($userData->theme == 'default')
    <link href="{{ asset('public/admin/assets/theme/default.css') }}" rel="stylesheet">
@elseif($userData->theme == 'blue')
    <link href="{{ asset('public/admin/assets/theme/blue.css') }}" rel="stylesheet">
@elseif($userData->theme == 'blue_light')
    <link href="{{ asset('public/admin/assets/theme/blue_light.css') }}" rel="stylesheet">
@elseif($userData->theme == 'brown')
    <link href="{{ asset('public/admin/assets/theme/brown.css') }}" rel="stylesheet">
@elseif($userData->theme == 'green')
    <link href="{{ asset('public/admin/assets/theme/green.css') }}" rel="stylesheet">
@elseif($userData->theme == 'purple')
    <link href="{{ asset('public/admin/assets/theme/purple.css') }}" rel="stylesheet">
@elseif($userData->theme == 'violet')
    <link href="{{ asset('public/admin/assets/theme/violet.css') }}" rel="stylesheet">
@elseif($userData->theme == 'dark')
    <link href="{{ asset('public/admin/assets/theme/dark.css') }}" rel="stylesheet">
@elseif($userData->theme == 'mint')
    <link href="{{ asset('public/admin/assets/theme/mint.css') }}" rel="stylesheet">
@endif --}}