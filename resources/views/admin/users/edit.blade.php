@extends('admin.layouts.col-3-1')

@section('content-left')
    <div class="ui container">
        <h2 class="ui header"><i class="icon user"></i> {{ $user['name'] }}</h2>
        <div class="ui hidden divider"></div>
        <div class="ui tabular menu top attached">
            <a class="item {{ (request()->segment(2) == 'profile')?'active':'' }}" href="{{ route('admin.profile.edit', $user['id']) }}">Edit Profil</a>
            <a class="item {{ (request()->segment(2) == 'account')?'active':'' }}" href="{{ route('admin.account.edit', $user['id']) }}">Akun</a>
            <a class="item {{ (request()->segment(2) == 'password')?'active':'' }}" href="{{ route('admin.password.edit', $user['id']) }}">Ganti Password</a>
        </div>
        <div class="ui segment bottom attached" data-tab="first">
            <div class="ui segment basic padded">
                @yield('content-user-edit')
            </div>
        </div>
    </div>
@endsection
