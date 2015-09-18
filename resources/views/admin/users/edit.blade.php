@extends('admin.layouts.base')
@section('content')
    <div class="ui container">
        <h2 class="ui header">Edit User</h2>

        <div class="ui tabular menu top attached">
            <a class="item active" data-tab="profile"><i class="icon user"></i> {{ $user['name'] }}</a>
        </div>
        <div class="ui segment bottom attached" data-tab="first">
            {!! Form::open([
                'method' => 'put',
                'route' => ['admin.users.update', $user['id']],
                'class' => 'ui form'
            ]) !!}

            <h3 class="ui header">Account</h3>

            <div class="field">
                <label>@lang('user.name')</label>
                {!! Form::text('name', old('name', $user['name'])) !!}
            </div>
            <div class="field">
                <label>@lang('user.email')</label>
                {!! Form::text('email', old('email', $user['email'])) !!}
            </div>
            {{--<div class="field">--}}
            {{--<label for="fruit">@lang('user.roles')</label>--}}

            {{--<div class="inline fields">--}}
            {{--@foreach($roles as $key=>$value)--}}
            {{--<div class="field">--}}
            {{--<div class="ui checkbox">--}}
            {{--@if(old("roles[{$key}]", $user->hasRole($key)))--}}
            {{--{!! Form::checkbox("roles[{$key}]", $key, true) !!}--}}
            {{--@else--}}
            {{--{!! Form::checkbox("roles[{$key}]", $key) !!}--}}
            {{--@endif--}}
            {{--<label>{{ $value }}</label>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--@endforeach--}}
            {{--</div>--}}
            {{--</div>--}}
            <div class="field">
                <label>@lang('user.status')</label>
                {!! Form::select('status', \App\Enum\UserStatus::values(), old('status', $user['status']), ['class' => 'ui dropdown']) !!}
            </div>

            <h3 class="ui header">Profile</h3>

            <div class="field">
                <label>@lang('user.bio')</label>
                {!! Form::textarea('bio', old('bio', $user['profile']['bio']), ['rows' => 3]) !!}
            </div>

            <div class="field">
                <label>@lang('user.timezone')</label>
                {!! Form::select('timezone', $timezones, old('timezone', $user['profile']['timezone']), ['class' => 'ui dropdown']) !!}
            </div>

            <div class="ui divider hidden"></div>
            <button class="ui button primary" type="submit" name="submit" value="1">@lang('action.save')</button>
            <a href="{{ route('admin.users.index') }}" class="ui button">@lang('action.cancel')</a>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
