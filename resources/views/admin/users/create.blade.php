@extends('admin.layouts.col-3-1')

@section('content-left')
    <div class="ui container">
        <div class="ui segment very padded">

            {!! Form::open([
                'method' => 'post',
                'route' => ['admin.users.store'],
                'class' => 'ui form'
            ]) !!}

            <div class="field required">
                <label>@lang('users.name')</label>
                {!! Form::text('name', old('name')) !!}
            </div>
            <div class="field required">
                <label>@lang('users.email')</label>
                {!! Form::text('email', old('email')) !!}
            </div>
            <div class="field required">
                <label>@lang('users.password')</label>
                <div class="ui right labeled input">
                    {!! Form::text('password', old('password'), ['id' => 'password']) !!}
                    <button class="ui label" type="button" onclick="document.getElementById('password').setAttribute('value', Math.random().toString(36).substr(2,8))">Generate</button>
                </div>
            </div>

            <div class="field required">
                <label>@lang('users.status')</label>
                {!! Form::select('status', \App\Enum\UserStatus::values(), old('status'), ['class' => 'ui dropdown']) !!}
            </div>

            <div class="ui divider hidden"></div>
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" name="send_account_information" {{ request()->old('send_account_information')?'checked':'' }}>
                    <label>@lang('users.send_account_information_via_email')</label>
                </div>
            </div>
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" name="must_change_password" {{ request()->old('must_change_password')?'checked':'' }}>
                    <label>@lang('users.change_password_on_first_login')</label>
                </div>
            </div>
            <div class="ui divider hidden"></div>

            <button class="ui button primary" type="submit" name="submit" value="1">@lang('button.save')</button>
            <a href="{{ route('admin.users.index') }}" class="ui button">@lang('button.cancel')</a>
            {!! Form::close() !!}

        </div>
    </div>
@endsection
