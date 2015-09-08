@extends('layouts.base')

@section('body')
    @include('elements.flash')
    <div class="ui divider section hidden"></div>

    <div id="main-content">
        <a href="{{ url('/') }}">
            <h2 class="ui header center aligned">
                {{ config('site.title') }}
            </h2>
        </a>

        <div class="ui divider section hidden"></div>
        <div class="ui centered stackable grid">
            <div class="column seven wide center aligned">
                @yield('content')
            </div>
        </div>

    </div>
@endsection
