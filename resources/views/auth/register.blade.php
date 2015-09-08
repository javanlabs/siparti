@extends('layouts.auth')

@section('content')

    <div class="ui segment very padded">

        <a href="{{ url('/oauth/facebook') }}" class="ui facebook button"><i class="facebook icon"></i> Daftar Dengan Facebook</a>
        <div class="ui divider horizontal section">Atau</div>

        <form class="ui form" method="POST" action="{{ url('/auth/register') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="ui fluid">
                <div class="ui field left icon input big">
                    <input type="text" name="name" placeholder="@lang('user.name')" value="{{ old('name') }}">
                    <i class="user icon"></i>
                </div>
                <div class="ui field left icon input big">
                    <input type="email" name="email" placeholder="@lang('user.email')" value="{{ old('email') }}">
                    <i class="mail icon"></i>
                </div>
                <div class="ui field left icon input big">
                    <input type="password" name="password" placeholder="@lang('user.password')">
                    <i class="lock icon"></i>
                </div>
                <button type="submit" class="ui big button fluid">@lang('action.register')</button>
            </div>
        </form>
    </div>
    Sudah punya akun? <a href="{{ url('auth/login') }}">Login Disini</a>

@endsection
