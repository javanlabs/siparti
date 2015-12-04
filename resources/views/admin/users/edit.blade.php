@extends('admin.layouts.base')

@section('content')
    <section class="ui container page">
        <div class="ui centered grid">
            <div class="ten wide column">
                <div class="ui segment fitted">
                    <div class="ui segment basic very padded">
                        <h2 class="ui header"><span>Edit</span> Pengguna</h2>
                        <h2 class="ui header">
                            <img class="ui image avatar" src="{{ $user->present('avatar') }}" alt=""> {{ $user->present('name') }}
                        </h2>
                    </div>
                    <div class="ui hidden divider"></div>
                    <div class="ui tabular menu top attached">
                        <a class="item {{ (request()->segment(2) == 'profile')?'active':'' }}" href="{{ route('admin.profile.edit', $user['id']) }}">@lang('users.menu.profile')</a>
                        <a class="item {{ (request()->segment(2) == 'account')?'active':'' }}" href="{{ route('admin.account.edit', $user['id']) }}">@lang('users.menu.account')</a>
                        <a class="item {{ (request()->segment(2) == 'password')?'active':'' }}" href="{{ route('admin.password.edit', $user['id']) }}">@lang('users.menu.password')</a>
                        <a class="item {{ (request()->segment(2) == 'role')?'active':'' }}" href="{{ route('admin.role.edit', $user['id']) }}">@lang('users.menu.role')</a>
                    </div>
                    <div class="ui segment bottom attached very padded" data-tab="first">
                        @yield('content-user-edit')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
