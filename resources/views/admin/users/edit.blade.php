@extends('admin.layouts.col-3-1')

@section('content-left')
    <div class="ui container">
        <h2 class="ui header"><img class="ui image avatar" src="{{ $user->present('avatar') }}" alt=""> {{ $user->present('name') }}</h2>
        <div class="ui hidden divider"></div>
        <div class="ui tabular menu top attached">
            <a class="item {{ (request()->segment(2) == 'profile')?'active':'' }}" href="{{ route('admin.profile.edit', $user['id']) }}">@lang('users.menu.profile')</a>
            <a class="item {{ (request()->segment(2) == 'account')?'active':'' }}" href="{{ route('admin.account.edit', $user['id']) }}">@lang('users.menu.account')</a>
            <a class="item {{ (request()->segment(2) == 'password')?'active':'' }}" href="{{ route('admin.password.edit', $user['id']) }}">@lang('users.menu.password')</a>
            <a class="item {{ (request()->segment(2) == 'role')?'active':'' }}" href="{{ route('admin.role.edit', $user['id']) }}">@lang('users.menu.role')</a>
        </div>
        <div class="ui segment bottom attached" data-tab="first">
            <div class="ui segment basic padded">
                @yield('content-user-edit')
            </div>
        </div>
    </div>
@endsection
