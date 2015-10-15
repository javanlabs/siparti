@extends('layouts.frontend')

@section('content')

    <div class="ui divider hidden"></div>

    <div class="ui container">
        <h2 class="ui header"><img class="ui image avatar" src="{{ Avatar::data($user->present('name')) }}" alt=""> {{ $user->present('name') }}</h2>
        <div class="ui hidden divider"></div>
        <div class="ui tabular menu top attached">
            <a class="item {{ (request()->segment(2) == 'profile')?'active':'' }}" href="{{ url('my/profile') }}">@lang('users.menu.profile')</a>
            <a class="item {{ (request()->segment(2) == 'email')?'active':'' }}" href="{{ url('my/email') }}">@lang('users.menu.email')</a>
            <a class="item {{ (request()->segment(2) == 'password')?'active':'' }}" href="{{ url('my/password') }}">@lang('users.menu.password')</a>
        </div>
        <div class="ui segment bottom attached" data-tab="first">
            <div class="ui segment basic padded">
                @yield('content-my')
            </div>
        </div>
    </div>
@endsection
